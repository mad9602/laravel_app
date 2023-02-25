<?php

namespace App\Http\Controllers;

use App\User;
use App\Game;
use App\Opponents;
use App\DelCount;


use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function user_delete($id)
    {
        $user = User::find($id);
        $delcount = DelCount::where('user_id', $id);

        $user->delete();

        $delcount->delete();

        return redirect()->route('teams.index');
    }
}
