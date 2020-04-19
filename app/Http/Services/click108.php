<?php

namespace App\Http\Services;

use PHPHtmlParser\Dom;

class click108 extends BaseService
{
    public $url;
    private $dom;
    private $repository;

    const mainClass = '.STAR12_BOX';
    const todayClass = '.TODAY_CONTENT';

    function __construct()
    {
        $this->url = env('CLICK108_URL' , 'http://astro.click108.com.tw/');
        $this->dom = new Dom;
        $this->repository = app('click108Repository');
    }

    public function getHTMLResponse($url = ""){
        $url = ($url === "") ? $this->url : $url;
        return $this->GuzzleHttp("get" , $url);
    }

    public function getMultipleUrls($response){
        $this->dom->load($response);
        $contents = $this->dom->find(self::mainClass , 0);

        //取出底下的星座
        return $contents->find('a');
    }

    public function getMultipleDetails($multipleURLs){
        $name = $this->getName();
        $detail = [];
        foreach ($multipleURLs as $multipleURL){
            //取得URL獲得每個星座的詳細資訊
            $split = explode('RedirectTo=' , $multipleURL->getAttribute('href'));
            $title = $multipleURL->getAttribute('title');
            $titleKey = $name->get($title);
            $detailURL = $this->getHTMLResponse(urldecode($split[1]));
            $detailURL = trim($detailURL, "\xEF\xBB\xBF");
            $this->dom->load(mb_convert_encoding($detailURL,'HTML-ENTITIES','utf-8'));

            $id = ($titleKey) ? $titleKey->id : '0';
            $detail[$id] = $this->dom->find(self::todayClass , 0); ;
        }
        return $detail;
    }

    public function getInfo($text){
        return mb_convert_encoding($text,'utf-8' , 'HTML-ENTITIES');
    }

    public function getTitle($text){
        $tmp = $this->dom->load($text);
        return str_replace("：","",mb_convert_encoding($tmp->find('span' , 0)->text(),'utf-8' , 'HTML-ENTITIES'));
    }

    public function addMainData(){
        return $this->repository->addMainData();
    }

    public function getType(){
        return $this->repository->getType();
    }

    public function getName(){
        return $this->repository->getName();
    }

    public function createClick108($result){
        return $this->repository->createClick108($result);
    }
}
