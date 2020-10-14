<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;

use App\Http\Controllers\Controller;

use App\movie;

use App\categoria;


use Illuminate\Support\Facades\Storage;
class MovieController extends Controller
{


    public function __construct(){

        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = movie::orderBy('id','DESC')->where('user_id', auth()->user()->id)->paginate();
//dd($movies);
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = categoria::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.movies.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieStoreRequest $request)
    {
        $movie= movie::create($request->all());

        //image

        if($request->file('file')){

            $path= Storage::disk('public')->put('image',$request->file('file'));

            $movie->fill(['file'=>asset($path)])->save();
        }

        return redirect()->route('themovies.edit',$movie->id)->with('info','Pelicula agrega Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = movie::find($id);

        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categorias = categoria::orderBy('name', 'ASC')->pluck('name', 'id');
      

        $movie = movie::find($id);

        return view('admin.movies.edit', compact('movie','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieUpdateRequest $request, $id)
    {
        $movie = movie::find($id);
$movie->fill($request->all())->save();



        //image

        if($request->file('file')){

            $path= Storage::disk('public')->put('image',$request->file('file'));

            $movie->fill(['file'=>asset($path)])->save();
        }

return redirect()->route('movies.update',$movie->id)->with('info','Pelicula Actualizada Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        movie::find($id)->delete();
        return back()->with('info', 'Pelicula eliminada Correctamente');
    }
}
