<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(2);
        return view('articles.index')->with('articles',$articles);
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required|max:2400',
        ],[
            'title.required' => 'Enter a descriptive title',
            'body.required' => 'The content field is required',
        ]);
        if ($request->hasFile('image')) {
          $file = $request->file('image')->getClientOriginalName();
          $name = $file.'.'.time();
          $path = $request->file('image')->storeAs('articles',$name,'public');
        }else {
            $name = 'noimage';
        }
        $xy = new Article();
        $xy->title = Str::of($request->input('title'))->ucfirst()->trim();
        $xy->body = Str::of($request->input('body'))->ucfirst()->trim();
        $xy->user_id = Auth::user()->id;
        $xy->image = $name;
        $save =  $xy->save();
        if ($save) {
          return redirect('/home')->with('success','You successfully created an article');
        }else {
            return back()->with('fail','Something went wrong, try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $article  = Article::find($id);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $article  = Article::find($id);
        return view('articles.edit', compact('article'));
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
            'title' => 'required',
            'body' => 'required|max:2400',
        ],[
            'title.required' => 'Enter a descriptive title',
            'body.required' => 'The content field is required',
        ]);
        if ($request->hasFile('image')) {
          $file = $request->file('image')->getClientOriginalName();
          $name = $file.'.'.time();
          $path = $request->file('image')->storeAs('articles',$name,'public');
        }else {
            $name = 'noimage';
        }
        $article = Article::find($id);
        $article->title = Str::of($request->input('title'))->ucfirst()->trim();
        $article->body = Str::of($request->input('body'))->ucfirst()->trim();
        $article->user_id = Auth::user()->id;

            if ($request->hasFile('image')) {

                $article->image = $name;
            }
        $article->save();

          return redirect('/home')->with('success','You successfully created an article');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if (Auth::user()->id === $article->user->id) {
           Storage::delete('/storage/articles/'.$article->image);
           $article->delete();

        }
        else {
            return back()->with('fail','Article was not created by you');
        }
        return redirect('/home')->with('success','You successfully delete the article');
    }
}
