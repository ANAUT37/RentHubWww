<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowedSearch;
use Illuminate\Support\Facades\Auth;


class FollowedSearchController extends Controller
{

    public function get($user_id){
        $data = FollowedSearch::getUserFollowed($user_id);
        return response()->json($data);
    }
    public static function isSearchFollowed($user_id,$category,$location){
        $data = FollowedSearch::where('user_id',$user_id)->where('category',$category)->where('address',$location)->first();
        if($data){
            return 1;
        }else{
            return 0;
        }
    }
    public static function toggleFollow(Request $request)
    {
        $user_id = Auth::user()->id;
        $isFollowed = $request->input('isFollowed');
        $category=$request->input('category');
        $address=$request->input('address');
        $existingFollow = FollowedSearch::where('user_id', $user_id)
            ->where('category',$category)->where('address',$address)
            ->first();

        if ($isFollowed == 1) {
            if (!$existingFollow) {
                $followed = new FollowedSearch();
                $followed->user_id = $user_id;
                $followed->address = $address;
                $followed->category=$category;
                $followed->save();
            }
        } else {
            if ($existingFollow) {
                $existingFollow->delete();
            }
        }
        return response()->json(['success' => true]);
    }
}
