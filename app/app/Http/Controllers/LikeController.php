<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        if ($request->input('like_product') == 1) {
            //ステータスが0のときはデータベースに情報を保存
            Like::create([
                'like_id' => $request->input('like_id'),
                'user_id' => Auth::id(),
            ]);
            //ステータスが1のときはデータベースに情報を削除
        } elseif ($request->input('like_product')  == 0) {
            Like::where('like_id', "=", $request->input('like_id'))
                ->where('user_id', "=", Auth::id())
                ->delete();
        }
        return  $request->input('like_product');
    }
}
