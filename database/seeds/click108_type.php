<?php

use Illuminate\Database\Seeder;

class click108_type extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp = [];

        foreach (['整體運勢' , '愛情運勢' , '事業運勢' , '財運運勢'] as $value){
            $temp[] = [
                'click108_type'=>$value
            ];
        }

        DB::table('click108_types')->insert($temp);
    }
}
