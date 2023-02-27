<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Game;

use App\Opponents;

use App\Like;

use App\DelCount;

use Illuminate\Support\Facades\Auth;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Like::select('like_id')->where('user_id', Auth::id())->get();
        // $like = Like::select('like_id')->where('user_id', Auth::id())->get();
        $like = new Like;
        $query = User::where('id', '!=', Auth::id());
        $area = $request->area;
        $team = $request->team;
        if ($area != '') {
            $query->where('area', 'like', "%{$area}%");
            // dd($query->get());
        }
        if ($team != '') {
            $query->where(function ($q) use ($team) {
                $q->orWhere('team', 'like', "%{$team}%");
            });
        }
        $users = $query->get();
        $user = Auth::user();
        if ($user->role === 0 && isset($user->role)) {
            return redirect('/games');
        } else {
            return view('teams.index')->with(['users' => $users, 'like' => $like]);
        }
    }

    public function profile(Request $request)
    {
        $applyList = $this->applyList();
        $appliedList = $this->appliedList();
        $matchingList = $this->matchingList();
        $likeList = $this->likeList();


        return view('teams.profile')->with([
            'applyList' => $applyList,
            'appliedList' => $appliedList,
            'matchingList' => $matchingList,
            'likeList' => $likeList,
            'flg' => $request->flg
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::find($request->id);

        return view('host.del_count', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $del_count = new DelCount;
        $del_count->report = $request->report;
        $del_count->user_id = $request->id;
        $del_count->save();

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

        return view('teams.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('teams.edit')->with(['user' => $user]);
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
        $user = User::find($id);
        $image = $request->file('image');
        if ($image) {
            $image = request()->file('image');
            request()->file('image')->storeAs('', $image, 'public');
            $user->image = $image;
        }
        $user->name = $request->name;
        $user->team = $request->team;
        $user->email = $request->email;
        $user->area = $request->area;
        $user->body = $request->body;

        $user->save();

        return redirect('/profile');
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

    /**
     * 申し込んだ相手 status=0
     */
    public function applyList()
    {
        return Game::where('status', 0)->where('user_id', Auth::id())->get();
    }

    /**
     * 申し込まれた相手 status=0
     * マッチングリスト status=1
     */
    public function appliedList()
    {
        return Opponents::where('user_id', Auth::id())->whereHas('game', function ($q) {
            $q->where('status', 0);
        })->get();
    }

    public function matchingList()
    {
        return Opponents::where('user_id', Auth::id())->whereHas('game', function ($q) {
            $q->where('status', 1);
        })->get();
    }

    /**
     * いいねリスト
     */
    public function likeList()
    {

        return Like::where('user_id', Auth::id())->get();
    }
}
