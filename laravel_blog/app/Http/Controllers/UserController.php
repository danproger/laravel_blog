<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        // $user = User::find($user_id);
        $arts = DB::select("SELECT * FROM `articles` WHERE `user_id` = " . $user_id . " ORDER BY `id` DESC");
        return view('user')->with('articles', $arts);
    }
}
