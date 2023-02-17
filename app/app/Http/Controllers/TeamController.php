<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Game;

use App\Like;

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
        $query = User::where('id', '!=', Auth::id());
        if ($request->keyword != "") {
            $query->where('area', $request->keyword);
        }
        $users = $query->get();

        return view('teams.index')->with(['users' => $users]);
    }

    public function profile(Request $request)
    {
        $user = User::query();
        $applyList = $this->applyList($user);
        $appliedList = $this->appliedList($user);
        $matchingList = $this->matchingList($user);
        $likeList = $this->likeList($user);

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
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
     * 申し込んだ相手
     */
    public function applyList($applyUser)
    {
        $applykey = Game::where('status', 0)->where('user_id', Auth::id())->get()->toArray();
        if ($applykey) {
            foreach ($applykey as $key) {
                $applyUser->orWhere('id', $key['game_id']);
            }
            $applyUser = $applyUser->get()->toArray();
        } else {
            $applyUser = "";
        }
        return $applyUser;
    }

    /**
     * 申し込まれた相手
     */
    public function appliedList($appliedUser)
    {
        $appliedkeys = Game::where('status', 0)->where('game_id', Auth::id())->get()->toArray();
        if ($appliedkeys) {
            foreach ($appliedkeys as $key) {
                $appliedUser->orWhere('id', $key['user_id']);
            }
            $appliedUser = $appliedUser->get()->toArray();
        } else {
            $appliedUser = "";
        }
        return $appliedUser;
    }

    /**
     * マッチングリスト
     */
    public function matchingList($user)
    {
        $keys = Game::where('status', 1)->where(function ($query) {
            $query->where('game_id', Auth::id())
                ->orWhere('user_id', Auth::id());
        })->get()->toArray();
        if ($keys) {
            foreach ($keys as $key) {
                $user->where('id', '!=', Auth::id())->where(function ($query) use ($key) {
                    $query->where('id', $key['user_id'])->orWhere('id', $key['game_id']);
                });
            }
            $user = $user->get()->toArray();
        } else {
            $user = "";
        }
        return $user;
    }


    /**
     * いいねリスト
     */
    public function likeList($user)
    {
        $keys = Like::where('user_id', Auth::id())->get()->toArray();
        if ($keys) {
            foreach ($keys as $key) {
                $user->orWhere('id', $key['like_id']);
            }
            $user = $user->get()->toArray();
        } else {
            $user = "";
        }
        return $user;
    }
}
