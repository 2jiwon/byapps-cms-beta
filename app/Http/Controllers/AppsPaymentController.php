<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AppsPaymentData;
use App\AppsOrderData;
use App\Comment;
use App\UserInfo;
use App\RetakuData;
use App\ServicePointData;

use Yajra\Datatables\Datatables;
use Session;

class AppsPaymentController extends Controller
{
    public function create(Request $request)
    {
      //dd($request);
      $userData = UserInfo::where('mem_id', $request->mem_id)->first();
      if ($userData == null) {
         toastr()->error('일치하는 회원아이디 정보가 없습니다', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);
         return back();
      }

      if($request->pay_type =="3") $apps_type="+iOS";
  		elseif($request->pay_type =="4") $apps_type="기타";
  		elseif($request->pay_type =="5") $apps_type="retaku";
  		elseif($request->pay_type =="6") $apps_type="aimd";

      $order_id = "";
      if ($request->pay_type == 5) $order_id = "RK";
      elseif ($request->pay_type == 6) $order_id = "AM";
      $order_id .= time();

      $term = 0;
      if ($request->pay_type == 6)
      $term = $request->pay_term;

      // 결제관리 테이블에 저장
      $etcPaymentData = new AppsPaymentData;
      $etcPaymentData->mem_id = $request->mem_id;
      $etcPaymentData->order_id = $order_id;
      $etcPaymentData->recom_id = 'byapps';
      $etcPaymentData->process = 0;
      $etcPaymentData->pay_type = $request->pay_type;
      $etcPaymentData->apps_type = $apps_type;
      $etcPaymentData->app_name = $request->app_name;
      $etcPaymentData->term = $term;
      $etcPaymentData->start_time = 0;
      $etcPaymentData->end_time = 0;
      $etcPaymentData->amount = $request->amount;
      $etcPaymentData->reg_time = time();
      $etcPaymentData->save();

      // 댓글 등록
      $idx = $etcPaymentData->idx;
      $commentData = new Comment;
      $commentData->mmid = 'payment';
      $commentData->pidx = $idx;
      $commentData->pmid = $request->mem_id;
      $commentData->mem_id = request()->user()->user_id;
      $commentData->mem_name = request()->user()->mem_name;
      $commentData->comment = '별도결제등록';
      $commentData->reg_time = time();
      $commentData->save();

      if ($commentData->idx != null) {
        toastr()->success('별도결제 등록완료', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);
        return redirect()->back();
      }

      return back();
    }

    public function getIndex()
    {
        return view('paylist');
    }

    public function getAppsPaymentData(Request $request)
    {
	    $app_process = array("미결제","카드결제","결제오류","결제취소");
      $pay_type = [
        '0' => '신규',
        '1' => '연장',
        '3' => '추가',
        '4' => '기타',
        '5' => '충전'
      ];

      if (isset($request->pay_type) && $request->pay_type >= 0) {
        $appsPaymentData = AppsPaymentData::select('idx',
                                                   'app_name',
                                                   'pay_type',
                                                   'term',
                                                   'amount',
                                                   'start_time',
                                                   'end_time',
                                                   'reg_time')
                                            ->where('pay_type', $request->pay_type);
      } else {
        $appsPaymentData = AppsPaymentData::select('idx',
                                                   'app_name',
                                                   'pay_type',
                                                   'term',
                                                   'amount',
                                                   'start_time',
                                                   'end_time',
                                                   'reg_time');
      }

      return Datatables::of($appsPaymentData)
              ->setRowId(function($appsPaymentData) {
                return $appsPaymentData->idx;
              })
              ->editColumn('pay_type', function($eloquent) use ($pay_type){
                return $pay_type[$eloquent->pay_type];
              })
              ->editColumn('amount', '{{ number_format($amount)." 원" }}')
              ->editColumn('term', function($eloquent) {
                 if (empty($eloquent->start_time)) {
                   return $eloquent->term." 일 (미정)";
                 } else {
                   return $eloquent->term." 일 (".date("Y-m-d", $eloquent->start_time)." ~ ".date("Y-m-d", $eloquent->end_time).")";
                 }
              })
              ->rawColumns([ 'term' ])
              ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
              ->orderColumn('reg_time', 'reg_time $1')
              ->make(true);
    }

    public function getSingleData($idx)
    {
      $appsPaymentData = AppsPaymentData::where('idx', $idx)->first();

      return view('appspaydetail')->with('appsPaymentData', $appsPaymentData);
    }

    public function update(Request $request, $idx)
    {
      $appsPaymentData = AppsPaymentData::where('idx', $idx)->first();

      $appsPaymentData->receipt = $request->input('receipt');
      $appsPaymentData->save();

      //Session::flash('success', '업데이트 성공');
      toastr()->success('업데이트 성공', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

      return redirect()->back();
    }

    public function getAppsOrderIdx()
    {
      $memId = $_POST['mem_id'];
      $idx = AppsOrderData::where('mem_id', '=', $memId)->first();

      return $idx;
    }

    public function getAppsPaymentIdx()
    {
      $memId = $_POST['mem_id'];
      $idx = AppsPaymentData::where('mem_id', '=', $memId)->first();

      return $idx;
    }
}
