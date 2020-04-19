<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class click108Cron extends Command
{
    private $click108Service;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:click108';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get click108 web info';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->click108Service = app('click108');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
//     * @return mixed
//     * @throws ChildNotFoundException
//     * @throws CircularException
//     * @throws CurlException
//     * @throws NotLoadedException
//     * @throws StrictException
     */
    public function handle()
    {
        $initArray = $this->click108Service->getType();

        $getResponse = $this->click108Service->getHTMLResponse() ;

        //獲得12星座URL
        $multipleURLs = $this->click108Service->getMultipleUrls($getResponse);

        //獲得12星座的解析
        $details = $this->click108Service->getMultipleDetails($multipleURLs);

        $result = [];

        //ETL 12 星座
        //key = 星座ID
        //keyName = 運勢ID
        foreach ($details as $key => $detail){
            $tmp = $detail->find('p');
            $i = 1;
            foreach ($tmp as $k => $value){
                $mod = $k % 2;
                $keyName = $initArray->get($i)->id;
                if ($mod === 0){
                    $title = $this->click108Service->getTitle($value->innerHtml);
                    $result[$key][$keyName]['title'] = $title;
                    $result[$key][$keyName]['star'] = substr_count($title , '★');
                }else{
                    $result[$key][$keyName]['info'] = $this->click108Service->getInfo($value->text());
                    $i++;
                }
            }
        }

        $insertData = $this->click108Service->createClick108($result);

        if (!$insertData){
            Log::error("Insert data error");
        }

        return;
    }
}
