<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Goutte;
use App\Paraliament;
use App\Legislator;
use App\Constituency;
use App\Speaker_group;

class legislatorscraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     
     const paraliament = [
         'representative' => 'https://democracy.minibird.jp/',
         'councilor' => 'https://democracy.minibird.jp/councillors.php'
     ];
     
    protected $signature = 'command:legislatorscraping';

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $url = self::paraliament["representative"];
        $data = $this -> communication($url);
        
        dump($url);
        dd($data);
        //Log::info(print_r($data,true));
        
    }
    
    private function communication($url)
    {
        $client = new Goutte\Client();
        $html = $client->request('GET',$url);
        
        //dd($html);
        
        $i = 0;
        $data = null;
        $html = $html->filter("table#table1 tbody");
        //$html = $html->filter("tbody");
        Log::debug($html->text());
        dd();
        //Arr::forget($html,".title");
        //$html = $html->forget(".title");
        $html = $html->each(function($tr) {
            $tr->filter("td")->each(function($td) {
                $human = array($i => $td->filter('a')->first()->text());
                $data = array_merge($data,$human);
            });
            $i++;
        });
        
        return $data;
    }
    
}
