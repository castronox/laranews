<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id','DESC')
                ->paginate(config('pagination.bikes',10));

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
        $bikes = Article::where('titulo', 'like', "%$titulo%")
                    ->where('tema', 'like', "%$tema%")
                    ->paginate(config('paginator.bikes',5))
                    ->appends(['titulo' => $titulo, 'tema' => $tema]);
                    
        
        return view('bikes.list', [

            'bikes' => $bikes,
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
            'imagen' => 'nullable|string|max:255',
        ]);

        $datos = $request->all();

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
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.update',['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|integer',
            'user_id' => 'required|integer',
            'titulo' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'texto' => 'required|string|max:5000',
            'imagen' => 'nullable|string|max:255',
            'visitas' => 'nullable|integer',
            'published_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);

        $article = Article::findOrFail($id);
        $article->update($request->all()+['matriculada'=>0]);

        return back()->with('success', "La noticia ha sido modificada correctamente");
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
