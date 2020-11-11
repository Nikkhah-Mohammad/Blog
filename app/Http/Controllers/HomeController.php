<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class HomeController extends Controller
{
   
    public function index()
    {
        $list = Article::where(['delete'=>0])
        ->paginate(3);
        return view('welcome',['list'=>$list]);
    }


    public function call(){
        return view('call');
    }


    public function getArticle($id){
          
        if($article =Article::where(['id'=>$id,'delete'=>0])->first()){
            $article->view = $article->view+1;
            $article->save();
            return view('show_article',['article'=>$article]);

        }else{
            abort('404');
        }
    }

    public function about(){
        return view('about');
    }

    public function search(Request  $request)
    {
        // title , content 
         $search = $request->search;
         $listss = Article::where('title','LIKE',"%{$search}%")
         ->orwhere('content','LIKE',"%{$search}%")->paginate(6);
         return view('welcome',['list'=>$listss]);

    }

  
}
