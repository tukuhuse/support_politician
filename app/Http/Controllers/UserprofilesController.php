<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Comment;
use App\Constituency;
use App\Legislator;
use App\Speaker_group;
use App\UserLegislator;
use App\UserSpeakergroup;
use App\Good;

class UserprofilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::all();
        return view('usersprofile.index', ['users' => $users ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
        $user=User::find($id);
        $legislator=UserLegislator::where('user_id',$user->id)->first();
        $speaker_group=UserSpeakergroup::where('user_id',$user->id)->first();
        $comments=Comment::where('user_id',$user->id)->get();
        $goods=Good::where('user_id',$user->id)->where('status',1)->get();
        $bads=Good::where('user_id',$user->id)->where('status',2)->get();
        return view('usersprofile.show', ['user'=>$user,'legislator'=>$legislator,'speaker_group'=>$speaker_group,'goods'=>$goods,'bads'=>$bads,'comments'=>$comments]);
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
        $user=User::find($id);
        $constituencies=Constituency::all()->pluck('name','id');
        $legislators=Legislator::all()->pluck('name','id');
        $speaker_groups=Speaker_group::all()->pluck('name','id');
        $comments=Comment::where('user_id',$user->id)->get();
        
        //フォームの初期値
        $legislator=UserLegislator::where('user_id',$user->id)->pluck('legislator_id');
        $speaker_group=UserSpeakergroup::where('user_id',$user->id)->pluck('speaker_group_id');
        
        return view('usersprofile.edit', 
        ['user'=>$user,'userlegislator'=>$legislator,'userspeakergroup'=>$speaker_group,
        'constituencies'=>$constituencies,'legislators'=>$legislators,'speaker_group'=>$speaker_groups,'comments'=>$comments]);
        
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
        $user=User::find($id);
        //選挙区の情報を保存
        $user->constituency_id = $request->constituency_id;
        $user->save();
        
        //応援している政党の情報を更新
        if (is_null($request->speaker_group_id)) $userspeakergroup=UserSpeakergroup::where(['user_id'=>$user->id])->delete();
        else {
            $userspeakergroup=UserSpeakergroup::updateOrCreate(
                ['user_id'=>$user->id],
                ['user_id'=>$user->id,'speaker_group_id'=>$request->speaker_group_id]
            );
        }
        
        //応援している議員の情報を更新
        if (is_null($request->legislator_id)) $userlegislator=UserLegislator::where(['user_id'=>$user->id])->delete();
        else {
            $userlegislator=UserLegislator::updateOrCreate(
                ['user_id'=>$user->id],
                ['user_id'=>$user->id,'legislator_id'=>$request->legislator_id]
            );
        }
        
        return redirect("/users/" . $id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
