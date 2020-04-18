<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $initArray = [0 => 'all' , 1 => 'love' , 2 => 'career' , 3 => 'fortune'];
        $getResponse = $this->click108Service->getHTMLResponse() ;

        //獲得12星座URL
        $multipleURLs = $this->click108Service->getMultipleUrls($getResponse);

        //獲得12星座的解析
        $details = $this->click108Service->getMultipleDetails($multipleURLs);

        $result = [];

        //ETL 12 星座
        foreach ($details as $key => $detail){
            $tmp = $detail->find('p');
            $i = 0;
            foreach ($tmp as $k => $value){
                $mod = $k % 2;
                $keyName = $initArray[$i];
                if ($mod === 0){
                    $title = $this->click108Service->getTitle($value->innerHtml);
                    $result[$key][$keyName]['title'] = $title;
                    $result[$key][$keyName]['start'] = substr_count($title , '★');
                }else{
                    $result[$key][$keyName]['info'] = $this->click108Service->getInfo($value->text());
                    $i++;
                }
            }
        }

        return;
    }
}
