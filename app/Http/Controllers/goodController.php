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
        $good_state_exists = $good_state -> exists();
        //レコードが存在する場合の処理
        if ($good_state_exists) {
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
}
