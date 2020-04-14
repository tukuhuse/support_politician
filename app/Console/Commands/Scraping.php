<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Paraliament;
use App\Legislator;
use App\Constituency;
use App\Speaker_group;
use App\Legislator_history;
use Goutte;

class Scraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scraping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function schedule(Schedule $schedule) {
        $schedule->command('command:scraping')->daily();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //各議会の人数を格納
        $capacity=array(480,245);
        
        //テーブルの初期化
        Speaker_group::truncate();
        Constituency::truncate();
        Legislator::truncate();
        
        $client = new Goutte\Client();
        $paraliament = Paraliament::firstOrCreate(['name' => '衆議院']);
        $paraliament = Paraliament::firstOrCreate(['name' => '参議院']);
        
        //衆議院と参議院で2回回す
        for($i=1;$i<=2;$i++) {
            
            //他サイトから情報取得
            $url='http://seiji.kpi-net.com/api/?type=' . $i . '&count=' . $capacity[$i-1] . '&format=json';
            $json=$client->request('GET', $url)->filter('p')->text();
            $data=json_decode($json,true);
            
            //取得した情報をデータベースへ
            foreach($data as $legislator) {
                //speaker_groupテーブルへ新規データのみ格納
                $speaker_groups = Speaker_group::firstOrCreate(['name' => $legislator["seitou"]]);
                $speaker_groups = Speaker_group::where('name',$legislator["seitou"])->first();
                
                //constituencyテーブルへ新規データのみ格納
                $constituencies = Constituency::firstOrCreate(['name' => $legislator["area"]]);
                $constituencies = Constituency::where('name',$legislator["area"])->first();
                
                //legislatorテーブルへデータ格納
                $legislators = Legislator::create([
                    'name' => $legislator["name"],
                    'birthday' => $legislator["birth"],
                    'gikai_id' => $i,
                    'constituency_id' => $constituencies["id"],
                    'speaker_group_id' => $speaker_groups["id"],
                    'url' => $legislator["link"]
                    ]);
            }
        }
    }
    
    //生年月日を文字列から日付型に変更する関数
    private function normalizeDate( $inStr ) {
    // 年月日の各パーツを分割する
        preg_match( "/([0-9]*)年([0-9]*)月([0-9]*)日/", $inStr, $data );
        if ( Count( $data ) != 4 ) {
            return $inStr;
        }
     
        // 先頭0埋めでYYYYMMDD形式の日付文字列に変換する
        $outStr = sprintf( "%04.4d%02.2d%02.2d", $data[1], $data[2], $data[3] );
     
        return $outStr;
    }
}
