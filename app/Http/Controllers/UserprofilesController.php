<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Constituency;
use App\Legislator;
use App\Speaker_group;
use App\UserLegislator;
use App\UserSpeakergroup;

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
        return view('usersprofile.show', ['user'=>$user,'legislator'=>$legislator,'speaker_group'=>$speaker_group]);
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
        
        //フォームの初期値
        $legislator=UserLegislator::where('user_id',$user->id)->pluck('legislator_id');
        $speaker_group=UserSpeakergroup::where('user_id',$user->id)->pluck('speaker_group_id');
        
        return view('usersprofile.edit', 
        ['user'=>$user,'userlegislator'=>$legislator,'userspeakergroup'=>$speaker_group,
        'constituencies'=>$constituencies,'legislators'=>$legislators,'speaker_group'=>$speaker_groups]);
        
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
        
        //とりあえずレコードが一つしかない場合
        $userlegislator=UserLegislator::updateOrCreate(
            ['user_id'=>$user->id],
            ['user_id'=>$user->id,'legislator_id'=>$request->legislator_id]);
        
        $userspeakergroup=UserSpeakergroup::updateOrCreate(
            ['user_id'=>$user->id],
            ['user_id'=>$user->id,'speaker_group_id'=>$request->speaker_group_id]);
        
        //複数ある場合は中間テーブルであるUserLegislator等のidをeditに追加
        
        
        return redirect("/users/" . $id);
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
        $user = User::find($id);
        //dd($user);
        $user->delete();
        return redirect('/');
    }
}
