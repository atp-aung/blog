<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // return Article::all();
        $articles = Article::with('category')->get();
       // $articles = Article::with('category:id,name')->get();
        return response()->json(['articles' => $articles]);                     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //     
        $article = new Article();
    $article->title = $request->input('title');
    $article->body = $request->input('body');
    $article->category_id = $request->input('category_id');
    $article->save();

 $articleId = $article->getKey();
    // Load the category details
    $category = Category::find($request->input('category_id'));

    $articleData = [
        'id' => $articleId,
        'title' => $article->title,
        'body' => $article->body,
        'category' => [
            'id' => $category->id,
            'name' => $category->name,
            // Add other category fields if needed
        ],              
    ];
    
    return response()->json(['newArtFacts' => $articleData], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        //
        //return Article::find($id);
        $article = Article::findOrFail($id);
        $article->load('category'); 
        $articleData = [
            'id' => $article->id,
            'title' => $article->title,
            'body' => $article->body,
            'category' => [
                'id' => $article->category->id,
                'name' => $article->category->name,
                // Add other category fields if needed
            ],              
        ];
        return response()->json(['detail' => $articleData]);        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
        $article = Article::find($id);
        $article->delete();
        return Article::all();
    }
}
