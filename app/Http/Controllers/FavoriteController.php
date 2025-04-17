<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'favoriteable_id'   => 'required|integer',
            'favoriteable_type' => 'required|string',
        ]);

        $user = Auth::user();
        $fav = Favorite::where([
            ['user_id',            $user->id],
            ['favoriteable_id',    $request->favoriteable_id],
            ['favoriteable_type',  $request->favoriteable_type],
        ])->first();

        if ($fav) {
            $fav->delete();
            return response()->json(['success' => true, 'action' => 'removed']);
        }

        Favorite::create([
            'user_id'            => $user->id,
            'favoriteable_id'    => $request->favoriteable_id,
            'favoriteable_type'  => $request->favoriteable_type,
        ]);

        return response()->json(['success' => true, 'action' => 'added']);
    }
}
