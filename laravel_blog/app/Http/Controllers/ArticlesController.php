<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // $articles = Article::all();
        $articles = Article::orderBy('id', 'desc')->simplePaginate(12);
        return view('articles/index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('articles/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:8|max:190',
            'text' => 'required|min:10',
            'main_image' => 'nullable|image|max:1999'
        ]);

        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image')->getClientOriginalName();
            $img_name_clear = pathinfo($file, PATHINFO_FILENAME);
            $ext = $request->file('main_image')->getClientOriginalExtension();
            $img_name = $img_name_clear . "_" . time() . "." . $ext;
            $path = $request->file('main_image')->storeAs('public/images', $img_name);
        } else
            $img_name = "noimage.png";

        $article = new Article();
        $article->title = $request->input('title');
        $article->text = $request->input('text');
        $article->user_id = auth()->user()->id;
        $article->image = $img_name;
        $article->save();

        return redirect('/articles')->with('success', 'Статья была успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $art = Article::find($id);
        $comments = DB::select("SELECT * FROM `comments` WHERE `article_id` = " . $id . " ORDER BY `id` DESC");
        return view('articles/show_art')->with(['article' => $art, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $art = Article::find($id);

        if ($art->user_id != auth()->user()->id)
            return redirect('articles')->with('error', 'Вы не авторизованы на сайте!');

        return view('articles/edit')->with('article', $art);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:8|max:190',
            'text' => 'required|min:10',
            'new_image' => 'max:1999'
        ]);

        if ($request->hasFile('new_image')) {
            $file = $request->file('new_image')->getClientOriginalName();
            $img_name_clear = pathinfo($file, PATHINFO_FILENAME);
            $ext = $request->file('new_image')->getClientOriginalExtension();
            $img_name = $img_name_clear . "_" . time() . "." . $ext;
            $path = $request->file('new_image')->storeAs('public/images', $img_name);
        }

        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->text = $request->input('text');

        if ($request->hasFile('new_image')) {
            if ($article->image != "noimage.png")
                Storage::delete('public/images/' . $article->image);

            $article->image = $img_name;
        }

        $article->save();

        return redirect('/articles/' . $id)->with('success', 'Статья была успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if ($article->user_id != auth()->user()->id)
            return redirect('articles')->with('error', 'Вы не авторизованы на сайте!');

        if ($article->image != "noimage.png")
            Storage::delete('public/images/' . $article->image);

        $article->delete();
        return redirect('/articles')->with('success', 'Статья была успешно удалена!');
    }

    public function comment (Request $request, $art_id) {
        $this->validate($request, [
            'comment_text' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->article_id = $art_id;
        $comment->text = $request->input('comment_text');
        $comment->author = auth()->user()->name;
        $comment->save();

        return redirect('/articles/' . $comment->article_id)->with('success', 'Комментарий был успешно добален!');
    }

    public function delete_comment ($id) {
        $comment = Comment::find($id);

        if ($comment->author != auth()->user()->name)
            return redirect('/articles/' . $comment->article_id)->with('error', 'Вы не авторизованы на сайте!');

        $comment->delete();
        return redirect('/articles/' . $comment->article_id)->with('success', 'Комментарий был успешно удален!');
    }
}
