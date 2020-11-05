<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
	public function index(){
        if(request('tag')){
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        }else{
            $articles = Article::latest()->get();
        }

    	return view('articles.index', ['articles' => $articles]);
    }

    public function show(Article $article){
    	return view('articles.show', ['article' => $article]);
    }

    public function create(){
    	return view('articles.create',[
            'tags'=>Tag::all()
        ]);
    }

    public function store(){
    	// Article::create(request()->validate([
    	// 	'title' => 'required',
    	// 	'excerpt' => 'required',
    	// 	'body' => 'required',
     //        //'tags' => 'exists:tags,id'

     //    ]));
     //    $article->user_id  = 1;

        request()->validate([
        'title' => 'required',
        'body' => 'required',
        'excerpt' => 'required',
        'tags' => 'exists:tags,id'
        ]);
        
        $article = new Article;

        $article->title = request('title');
        $article->body = request('body');
        $article->excerpt= request('excerpt');
        $article->user_id = 1;
        $article->save();

        $article->tags()->attach(request('tags'));
    	return redirect('/articles');
    }

    public function edit(Article $article){
    	return view('articles.edit', ['article' => $article]);
    }

    public function update(Article $article){
			$article->update(request()->validate([
    		'title' => 'required',
    		'excerpt' => 'required',
    		'body' => 'required',
    	]));

    	return redirect($article->path());
    }
}
