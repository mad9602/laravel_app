<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use  Illuminate\Support\Facades\Auth;

use App\Game;
use App\Opponents;
use App\DelCount;
use Carbon\Carbon;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = DelCount::orderBy('user_id', 'asc')->select('user_id')->groupBy('user_id')->get();

        return view('host.index_host')->with(['query' => $query]);
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
        $opponents = new Opponents;
        $opponents->charange_text = $request->body;
        $opponents->user_id = $request->id;
        $opponents->save();

        $games = new Game;
        $games->opponents_id = $opponents->id;
        $games->user_id = Auth::id();
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
        $user = User::find($id);


        return view('user.acount')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
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
        if ($request->has('accept')) {
            $games = Game::find($id);
            $games->status = 1;
            $games->save();
            return redirect('/profile?flg=1');
        }
        if ($request->has('refuse')) {
            $games = Game::find($id);
            $games->status = 2;
            $games->save();
            return redirect('/teams');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $user = User::find($id);
        // $delcount = DelCount::where('user_id', $id);

        // $user->delete();

        // $delcount->delete();

        return redirect()->route('teams.index');
    }
}
