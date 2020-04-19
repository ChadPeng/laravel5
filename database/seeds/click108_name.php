<?php

use Illuminate\Database\Seeder;

class click108_name extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = [];

        foreach (['水瓶座' , '雙魚座' , '牡羊座' , '金牛座' , '雙子座' , '巨蟹座' , '獅子座' , '處女座' , '天秤座' , '天蠍座' , '射手座' , '摩羯座'] as $value){
            $temp[] = [
                'click108_name'=>$value
            ];
        }

        DB::table('click108_names')->insert($temp);
    }
}
