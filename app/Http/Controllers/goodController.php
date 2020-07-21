<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Good;

class goodController extends Controller
{
    //
    public function goodstatechange(Request $request)
    {
        //レコードの検索（条件：user_idとspeech_idが両方とも一致すること）
        $user = Auth::User();
        $good_state = Good::where('speechID',$request->speechID)
            -> where('user_id',$user->id)
            -> first();
        //レコードが存在する場合の処理
        if ($good_state) {
            //条件:DBに登録されている状態と送信された状態が同じか違うか
            //式１:対象のレコードを削除
            //式２:対象のレコードの状態を更新
            $good_state->status == $request->state ? $good_state->delete() : $good_state->update(['status' => $request->state]);
        }
        //レコードが存在しない場合の処理
        else {
            $good_state = Good::Create([
                'user_id' => $user->id,
                'status' => $request->state,
                'speechID' => $request->speechID,
                'legislator_name' => $request->speaker,
                'speech' => $request->speech
            ]);
        }
        
        return redirect()->route('detail',['issueID' => $request->issueID]);
        
    }
    
    public function ajaxupdate(Request $request) {
        
        $user = Auth::User();
        //レコードの検索（条件：user_idとspeech_idが両方とも一致すること）
        $good_state = Good::where('speechID', $request->speechID)
            -> where('user_id',$user->id)
            -> first();
        //レコードが存在する場合の処理
        if ($good_state) {
            //条件:DBに登録されている状態と送信された状態が同じか違うか
            //式１:対象のレコードを削除
            //式２:対象のレコードの状態を更新
            //$good_state->status == $request->status ? $good_state->delete() : $good_state->update(['status' => $request->status]);
            
            if ($good_state->status == $request->status) {
                $good_state->users()->detach($user->id);
                $good_state->delete();
            } else {
                $good_state->update(['status' => $request->status]);
            }
        }
        //レコードが存在しない場合の処理
        else {
            $good_state = Good::Create([
                'user_id' => $user->id,
                'status' => $request->status,
                'speechID' => $request->speechID,
                'legislator_name' => $request->speaker,
                'speech' => $request->speech
            ]);
            $good_state->latest()->first();
            $good_state->users()->attach($user->id);
        }
        
        //$good_state->users()->sync();
        
        return response(\Illuminate\Http\Response::HTTP_OK);
    }
}
