<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $colmus;

    public function __construct(){
        $this->colmus = ['mem_name','reg_time','comment','mmid','pidx'];
    }

    public function __invoke(){
        if(request()->ajax()){
            $data = \App\Comment
                ::orderBy('reg_time','desc')
                ->whereRaw('1=2');
            $appData = \App\AppsData::find(request()->input('idx'), ['order_id','app_id','mem_id']);
            $mmid = request()->input('mmid');

            if(($mmid == 'all' || $mmid == 'payment') && $appData->order_id != null){
                $data->orwhere(function($query) use ($appData){
                    $subQuery = \App\AppsPaymentData
                        ::whereRaw('order_id = \''.$appData->order_id.'\'')
                        ->select('idx')
                        ->limit(1)
                        ->toSql();
                    $query->where('mmid','payment');
                    $query->where('pidx',\DB::raw('('.$subQuery.')'));
                });
            }

            if(($mmid == 'all' || $mmid == 'order') && $appData->order_id != null){
                $data->orwhere(function($query) use ($appData){
                    $subQuery = \App\AppsOrderData
                        ::whereRaw('order_id = \''.$appData->order_id.'\'')
                        ->select('idx')
                        ->limit(1)
                        ->toSql();
                    $query->where('mmid','order');
                    $query->where('pidx',\DB::raw('('.$subQuery.')'));
                });
            }

            if(($mmid == 'all' || $mmid == 'new_update')){
                $data->orwhere(function($query) use ($appData){
                    $subQuery = \App\AppsUpdateData
                        ::whereRaw('app_id = \''.$appData->app_id.'\'')
                        ->select(\DB::raw("'('||group_concat(idx separator ',')||')'"))
                        ->groupby('app_id')
                        ->limit(1)
                        ->toSql();
                    $query->where('mmid','update');
                    $query->where('pidx',\DB::raw('('.$subQuery.')'));
                });
            }

            if(($mmid == 'all' || $mmid == 'apps') && $appData->mem_id != null)
                $data->orwhere('pidx',request()->input('idx'));

            if(($mmid == 'all' || $mmid == 'myqna')){
                $data->orwhere(function($query) use ($appData){
                    $subQuery = \App\MyqnaData
                        ::whereRaw('mem_id = \''.$appData->mem_id.'\'')
                        ->select(\DB::raw("'('||group_concat(idx separator ',')||')'"))
                        ->groupby('mem_id')
                        ->limit(1)
                        ->toSql();
                    $query->where('mmid','myqna');
                    $query->where('pidx',\DB::raw('('.$subQuery.')'));
                });
            }

            if(($mmid == 'all' || $mmid == 'ma')){
                $data->orwhere(function($query) use ($appData){
                    $subQuery = \App\MAData
                        ::whereRaw('ma_id = \''.$appData->app_id.'\'')
                        ->select('idx')
                        ->limit(1)
                        ->toSql();
                    $query->where('mmid','order');
                    $query->where('pidx',\DB::raw('('.$subQuery.')'));
                });
            }
            // return $data->toSql();
            return $data->get($this->colmus);
        }
    }

    public function send(){
        $data = request()->only(['comment']);
        $data['pidx'] = request()->input('idx');
        $data['mmid'] = request()->input('commentSendMode');
        $data['pmid'] = request()->user()->email;
        $data['mem_name'] = request()->user()->mem_name;
        $data['mem_id'] = request()->user()->user_id;
        $data['reg_time'] = time();
        return \App\Comment::find(\App\Comment::insertGetId($data),$this->colmus);
    }
}
