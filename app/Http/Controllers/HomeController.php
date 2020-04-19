<?php

namespace App\Http\Controllers;

use App\Http\Models\click108;
use App\Http\Models\click108_info;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Factory|View
     */
    public function index()
    {
        $today = Carbon::now()->toDateString();

        $id = click108::query()->select('id')->where('date',$today)->orderByDesc('id')->first();

        $click108 = click108_info::with(['type108', 'name', 'main'])
            ->where('click108_id', $id->id)
            ->get();

        $result = [];

        foreach ($click108 as $value){
            $info = [$value->star , $value->info];
            $result[$value->name->click108_name][$value->type108->click108_type] = $info;
        }

        return view('home' , compact('result' , 'today'));
    }
}
