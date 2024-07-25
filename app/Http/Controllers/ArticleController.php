<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{


public function _construct(){
    $this->middleware('auth')->except('index', 'show','search');
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id','DESC')
                ->paginate(config('pagination.articles',10));

        $total = Article::count();

        return view('articles.list', ['articles'=>$articles, 'total'=>$total]);
    }


    public function search(Request $request, $titulo = null, $tema = null){

        #Toma los valores que llegan para titulo y tema 
        #Pueden llegar via URL o via Query STRING 
        #Por defecto le asignameros ''
        $titulo = $titulo ?? $request->input('titulo', '');
        $tema = $tema ?? $request->input('tema', '');


        #Recupera los resultados, se añade titulo y tema al paginador
        #Para que mantenga el filtro al pasar de página
        $articles = Article::where('titulo', 'like', "%$titulo%")
                    ->where('tema', 'like', "%$tema%")
                    ->paginate(config('paginator.articles',5))
                    ->appends(['titulo' => $titulo, 'tema' => $tema]);
                    
        
        return view('articles.list', [

            'articles' => $articles,
            'titulo' => $titulo,  # Para rellenar el input 'titulo'
            'tema' => $tema # Para rellenar 'tema'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
    

        $request->validate([
            'titulo' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'texto' => 'required|string|max:5000',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048',
        ]);

        $datos = $request->all();
        # El valor por defecto para la imagen será NULL
        $datos +=['imagen' => NULL];

        
        # Recuperación de la imagen
        if($request->hasFile('imagen')){
                # Sube la imagen al directorio indicado en el fichero de config
                $ruta = $request->file('imagen')->store('images/articles');

                

                # Nos quedamos solo con el nombre del ficheropara añadirlo a la base de datos
                $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }

        $datos['user_id'] = $request->user()->id; 

        $article = Article::create($datos);

        return redirect()->route('articles.show', $article->id)
            ->with('success', "La noticia $article->titulo se ha añadido correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.show', ['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Article $article)
    {
        
        return view('articles.update',['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $datos = $request->only('titulo', 'tema' , 'texto');
        


        if($request->hasFile('imagen')){
            # Marcamos la imagen antigua para ser borrada si el update va bien
            if($article->imagen)
                $aBorrar = config('filesystems.articlesImageDir') . $article->imagen;

            # Sube la imagen al directorio indicado en el fichero de config
            
            $imagenNueva = $request->file('imagen')->store(config('filesystems.articlesImageDir'));

            # Nos quedamos solo con el nombre de fichero para añadirlo a la BBDD
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);

        }

        # En caso de que nos pidan eliminar la imagen
        if($request->filled('eliminarimagen') && $article->imagen){
            $datos['imagen'] = NULL;
            $aBorrar = config('filesystems.articlesImageDir') . '/' . $article->imagen;
        }

        # Al actualizar debemos tener en cuenta varias cosas:
        if($article->update($datos)){
            if(isset($aBorrar))
                Storage::delete($aBorrar);  # Borramos foto antigua
        }else{ # Si algo falla
            if(isset($imagenNueva))
                Storage::delete($imagenNueva); # Borramos la foto nueva    
        }

        # Carga la misma vista y muestra el mensaje de éxito
        return back()->with('success', "Noticia $article->titulo $article->modelo actualizada satisfactoriamente");
    }

    


    public function delete($id){
        $article = Article::findOrFail($id);
        return view('articles.delete', ['article' => $article]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return redirect('articles')
            ->with('success', "La noticia $article->titulo, ha sido eliminada");
    }
}
