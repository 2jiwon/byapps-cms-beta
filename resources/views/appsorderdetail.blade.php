@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('appsorderdetail') }}

    <div class="row">
        <!-- col-sm-12 start -->
        <div class="col-sm-12">
        <!-- card -->
        <div class="card">
            <!-- cardbody start -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">

                        @if ($appsOrderData)
                        <h4><strong>{{ $appsOrderData->app_name }}</strong></h4>
                        @else
                        <h4><strong>데이터가 없습니다.</strong></h4>
                        @endif

                        <hr />

                    </div>

                    <div class="col-md-12 col-xs-12 px-4">
                        <form method="POST" action="">
                        <input type="hidden" name="idx" value="1"/>

                        <div class="form-group row" id="paymentData">
                            <label class="col-md-2 col-form-label ">주문번호</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1">{{ $appsOrderData->order_id }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-md-2 col-form-label">주문일</label>
                                <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ date("Y-m-d", $appsOrderData->reg_time) }}</p>
                                </div>
                            </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Process</label>
                            <div class="col-md-10 col-xs-9">
                              @php
                                $app_process = array("주문취소","접수","주문확인","개발진행","앱등록","서비스중지","서비스해지","","취소요청","접수대기");
                              @endphp
                            <p class="form-control-static mt-1 mb-1">{{ $app_process[$appsOrderData->app_process] }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">RESELLER ID</label>
                            <div class="col-md-10 col-xs-9">
                              <p class="form-control-static mt-1 mb-1">{{ $appsOrderData->recom_id }}

                                  @if ($resellerData)
                                  <strong>{{ $resellerData->company }}
                                  (담당자: {{ $resellerData->mem_name }}, 연락처: {{ $resellerData->cellno }}, {{ $resellerData->phoneno }})
                                  </strong>
                                  @endif
                              </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">회원 ID</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>&nbsp;&nbsp;{{ $appsOrderData->mem_id }}
                                  <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="회원정보" onclick="setUserInfo('{!! $appsOrderData->mem_id !!}')">
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">업체명</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1">{{ $appsOrderData->app_company }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">신청자명</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1">{{ $appsOrderData->order_name }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">연락처</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>&nbsp;&nbsp;{{ $appsOrderData->cellno }}
                                  <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="sms보내기">
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">이메일</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1">{{ $appsOrderData->email }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">결제정보</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>
                                  &nbsp;&nbsp;{{ $appsOrderData->pay_way }} (손효연, 승인번호: 0, 승인날짜: 2019/11/07 [18:22])
                                  <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="결제내역">
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">신청경로</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>&nbsp;&nbsp;전화영업 </p>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. Category</label>
                            <div class="col-md-10 col-xs-9">
                                <select name="pm_content" id="" class="form-control">
                                <option value="">기타</option>
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Service Type</label>
                            <div class="col-md-10 col-xs-9">
                            <label class="radio-inline">
                                <input type="radio" class=" mt-1 mb-1" name="option_ilban" checked="" value="">
                                일반
                            </label>
                            &nbsp;
                            <label class="radio-inline">
                                <input type="radio" class=" mt-1 mb-1" name="option_lite" value="">
                                라이트
                            </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. OS</label>
                            <div class="col-md-10 col-xs-9">
                            <label class="radio-inline mt-1 mb-1">
                                <input type="radio" name="android" checked="" value="">
                                안드로이드
                            </label>
                            &nbsp;
                            <label class="radio-inline mt-1 mb-1">
                                <input type="radio" name="ios" checked="" value="">
                                아이폰
                            </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. Name</label>
                            <div class="col-md-10 col-xs-9">
                                <input type="text" class="form-control" value="{{ $appsOrderData->app_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. URL</label>
                            <div class="col-md-10 col-xs-9">
                                <input type="text" class="form-control" value="{{ $appsOrderData->app_home_url }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. URL</label>
                            <div class="col-md-10 col-xs-9">
                                <a href="javascript:void(0);">앱아이콘</a>,
                                <a href="javascript:void(0);">스플래쉬</a>,
                                <a href="javascript:void(0);">탭메뉴</a>,
                                <a href="javascript:void(0);">로고</a>,
                                <a href="javascript:void(0);">그래픽</a>
                                <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="변경등록">
                                <input class="btn btn-info waves-effect btn-xs mr-1" type="button" value="android변환">
                                <input class="btn btn-success waves-effect btn-xs" type="button" value="ios변환">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">고객센터</label>
                            <div class="col-md-10 col-xs-9">
                                <input type="text" class="form-control" value="{{ $appsOrderData->call_no }}">
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-2 col-form-label">영수증정보</label>
                            <div class="col-md-10 col-xs-9">
                                <textarea id="receipt" name="receipt" class="form-control" rows="5">미발행</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-2 col-form-label">앱소개</label>
                            <div class="col-md-10 col-xs-9">
                                <textarea id="receipt" name="receipt" class="form-control" rows="5">{{ $appsOrderData->app_intro }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 text-center">
                            <button type="submit" class="btn btn-info mx-auto">변경하기</button>
                        </div>
                    </form>
                </div>
            </div><!--row end-->
            </div>
            <!-- col-md-12 -->

            </div>
            <!-- card end -->
        </div>
        <!-- cardbody end -->
    </div>
    <!-- row end -->
</div>
<!-- container-fluid end -->
@endsection

@section('script')
@endsection
