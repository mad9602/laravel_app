<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use  Illuminate\Support\Facades\Auth;

use App\Game;

use Carbon\Carbon;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('games.status', ['request' => $request]);
    }

    /**
     * Store a newly created resource in storage.
     *対戦申込み
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $games = new Game;
        $games->game_id = $request->id;
        $games->user_id = Auth::id();
        $games->body = $request->body;
        $games->email = Auth::user()->email;
        $games->date = Carbon::now();

        $games->save();

        return redirect('/teams');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $games = Game::where('user_id', $id)->first();
        $games->status = 1;
        $games->save();

        return redirect('/profile?flg=1');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
