<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Movie;
use App\categoria;

class PageController extends Controller
{
    public function movies(){

        $movies = Movie::orderBy('id','DESC')->paginate(5);

        return view('web.movies',compact('movies'));
    }

    public function movie($slug){

        $movie = Movie::where('slug', $slug)->first();

        return view ('web.movie', compact('movie'));
    }

    public function categoria($slug){
        $category = Categoria::where('slug',$slug)->pluck('id')->first();
        $movies = Movie::where('category_id',$category)->orderBy('id','DESC')->paginate(5);
        return view('web.movies',compact('movies'));
    }



}
