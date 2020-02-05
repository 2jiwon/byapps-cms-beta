<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AppsData;
use App\AppsOrderData;
use App\AppsPaymentData;
use App\PromotionData;
use App\UserInfo;

class SearchContorller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
      $totalCnt = 0;
      $appsCnt = AppsData::where('app_name', 'like', '%'.request('query').'%')
                            ->orderBy('reg_time', 'desc')
                            ->count();

      $appsData = AppsData::where('app_name', 'like', '%'.request('query').'%')
                            ->orderBy('reg_time', 'desc')
                            ->take(20)
                            ->get();

      $appsPayCnt =  AppsPaymentData::where('app_name', 'like', '%'.request('query').'%')
                            ->orderBy('reg_time', 'desc')
                            ->count();

      $appsPayData = AppsPaymentData::where('app_name', 'like', '%'.request('query').'%')
                            ->orderBy('reg_time', 'desc')
                            ->take(20)
                            ->get();

      $totalCnt = $appsCnt + $appsPayCnt;

      return view('search')->with('appsData', $appsData)
                           ->with('appsPayData', $appsPayData)
                           ->with('totalCount', $totalCnt)
                           ->with('appsCnt', $appsCnt)
                           ->with('appsPayCnt', $appsPayCnt)
                           ->with('query', request('query'))
                           ->with('title', '검색 결과: '.request('query'));
    }

    public function loadMore(Request $request)
    {
      if ($request->ajax()) {
        $skip = $request->skip;
        $str = $request->str;
        $model = $request->model;
        $take = 20;

        if ($model == 'AppsData') {
          $appsData = AppsData::where('app_name', 'like', '%'.$str.'%')
                                ->orderBy('reg_time', 'desc')
                                ->skip($skip)
                                ->take($take)
                                ->get();
           return $appsData;
        }
        if ($model == 'AppsPaymentData') {
          $appsPayData = AppsPaymentData::where('app_name', 'like', '%'.$str.'%')
                                      ->orderBy('reg_time', 'desc')
                                      ->skip($skip)
                                      ->take($take)
                                      ->get();
           return $appsPayData;
        }

      } else {
         return response()->json('Direct Access Not Allowed');
      }
    }

    public function sideSearch(Request $request)
    {
      $appsData = AppsData::where('app_name', '=', request('query'))
                            ->orderBy('reg_time', 'desc')
                            ->first();

      // $mem_id = AppsData::where('app_name', '=', $appsData->app_name)
      //                     ->value('mem_id');

      $userInfo = UserInfo::where('mem_id', '=', $appsData->mem_id)
                            ->first();

      return compact('appsData','userInfo');
    }
}
