@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('appdetail') }}

    <div class="row">
        <!-- col-sm-12 start -->
        <div class="col-sm-12">
        <!-- card -->
        <div class="card">
            <!-- cardbody start -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>
                            <strong>{{ $appData->app_name }}</strong>
                        </h4>
                        <hr/>
                    </div>

                <div class="col-md-12 col-xs-12 px-4">
                    <form method="POST" onsubmit="return modify(this)">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Process</label>
                            <div class="col-md-6 col-xs-9">
                                <select name="app_process" class="form-control input-sm">
                                    <option value="" >선택해 주세요</option>
                                    <option value="1"{!! $appData->app_process == 1 ? 'selected' : '' !!}> 개발준비중</option>
                                    <option value="2"{!! $appData->app_process == 2 ? 'selected' : '' !!}> 개발진행중</option>
                                    <option value="3"{!! $appData->app_process == 3 ? 'selected' : '' !!}> 심사중</option>
                                    <option value="4"{!! $appData->app_process == 4 ? 'selected' : '' !!}> 등록거부</option>
                                    <option value="5"{!! $appData->app_process == 5 ? 'selected' : '' !!}> 재심사중</option>
                                    <option value="6"{!! $appData->app_process == 6 ? 'selected' : '' !!}> 등록대기</option>
                                    <option value="7"{!! $appData->app_process == 7 ? 'selected' : '' !!}> 등록완료</option>
                                    <option value="8"{!! $appData->app_process == 8 ? 'selected' : '' !!}> 서비스중지</option>
                                    <option value="10"{!! $appData->app_process == 10 ? 'selected' : '' !!}> 서비스유효</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label ">등록일</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> {{ $appData->reg_time }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label ">주문번호</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> {{ $appData->order_id }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">회원 ID</label>
                            <div class="col-md-10 col-xs-9">
                                <span class="form-control-static mt-1 mb-1 d-p-inline"> <i class="fa fa-user"></i>&nbsp;&nbsp; {{ $appData->mem_id }} </span>
                                <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" onclick="getMemberInfo('{!! $appData->mem_id !!}')">회원정보</button>
                                <button class="btn btn-info waves-effect btn-xs mr-1" type="button" >Transfer</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">CAFE24 App</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> - </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">APP ID</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $appData->app_id }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Service Type</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2">
                                <div class="radio radio-success mr-2">
                                    <label>
                                        <input type="radio" name="service_type" value="biz"{!! $appData->service_type == 'biz' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;일반
                                    </label>
                                </div>
                                <div class="radio radio-info mr-2">
                                    <label>
                                        <input type="radio" name="service_type" value="lite"{!! $appData->service_type == 'lite' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;라이트
                                    </label>
                                </div>
                                <div class="radio radio-warning mr-2">
                                    <label>
                                        <input type="radio" name="service_type" value="tester"{!! $appData->service_type == 'tester' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;테스터
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App OS</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2">
                                <div class="checkbox checkbox-success mr-2">
                                    <label>
                                        <input type="checkbox" name="app_os_type[]" value="android"{!! $appData->app_os_type == 'android' || $appData->app_os_type == 'both' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;안드로이드
                                    </label>
                                </div>
                                <div class="checkbox checkbox-info mr-2">
                                    <label>
                                        <input type="checkbox" name="app_os_type[]" value="ios"{!! $appData->app_os_type == 'ios' || $appData->app_os_type == 'both' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;아이폰
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Byapps ver</label>
                            <div class="col-md-1 col-xs-9">
                                <input type="text" name="byapps_ver" class="form-control input-sm" value="{!! $appData->byapps_ver !!}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">업체명</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> {{ $appData->member->mem_nick }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">android</label>
                            <div class="col-md-6 col-xs-9 form-inline">
                                ver -
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" name="app_ver" class="form-control input-sm" value="{!! $appData->app_ver !!}" >
                                </div>
                                build -
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" name="app_build" class="form-control input-sm" value="{!! $appData->app_build !!}" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">IOS</label>
                            <div class="col-md-6 col-xs-9 form-inline">
                                ver -
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" name="app_ver_ios" class="form-control input-sm" value="{!! $appData->app_ver_ios !!}" >
                                </div>
                                build -
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" name="app_build_ios" class="form-control input-sm" value="{!! $appData->app_build_ios !!}" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. Category</label>
                            <div class="col-md-6 col-xs-9">
                                <select name="app_cate" id="" class="form-control">
                                    <option value="">선택해 주세요</option>
                                    <option value="01"{!! $appData->app_cate == 01 ? ' selected' : '' !!}> 패션/의류</option>
                                    <option value="06"{!! $appData->app_cate == 06 ? ' selected' : '' !!}> 화장품/뷰티</option>
                                    <option value="07"{!! $appData->app_cate == 07 ? ' selected' : '' !!}> 아동/유아</option>
                                    <option value="02"{!! $appData->app_cate == 02 ? ' selected' : '' !!}> 스포츠/레져</option>
                                    <option value="03"{!! $appData->app_cate == 03 ? ' selected' : '' !!}> 건강/농수산물</option>
                                    <option value="04"{!! $appData->app_cate == 04 ? ' selected' : '' !!}> 가전/가구</option>
                                    <option value="05"{!! $appData->app_cate == 05 ? ' selected' : '' !!}> 기타</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">앱설치통계</label>
                            <div class="col-md-8 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">
                                    전체: {{ $downData['total_c'] }} /
                                    오늘: {{ $downData['today_c'] }} /
                                    어제: {{ $downData['yesterday_c'] }} /
                                    평균: {{ $downData['average'] }} /
                                    최고: {{ $downData['max_c'] }} /
                                    기간: {{ $downData['time'] }} ({{ $downData['launch_date'] }}~{{ date('Y/m/d') }})
                                    <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button">버전별 설치 통계</button>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">앱이용통계</label>
                            <div class="col-md-8 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">
                                    전체: {{ number_format($useData['total_c']) }} /
                                    오늘: {{ number_format($useData['today_c']) }} /
                                    어제: {{ number_format($useData['yesterday_c']) }} /
                                    평균: {{ number_format($useData['average']) }} /
                                    최고: {{ number_format($useData['max_c']) }} /
                                    기간: {{ number_format($useData['time']) }} ({{ $useData['launch_date'] }}~{{ date('Y/m/d') }})
                                    <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button">주간통계재발송</button>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">앱매출통계</label>
                            <div class="col-md-8 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">
                                  @if($saleData != null)
                                    전체: {{ number_format($saleData['total_m']) }}
                                          ({{ number_format($saleData['total_c']) }}) /
                                    오늘: {{ number_format($saleData['today_m']) }}
                                          ({{ number_format($saleData['today_c']) }}) /
                                    어제: {{ number_format($saleData['yesterday_m']) }}
                                          ({{ number_format($saleData['yesterday_c']) }}) /
                                    평균: {{ number_format($saleData['average_m']) }}
                                          ({{ number_format($saleData['average_c']) }}) /
                                    최고: {{ number_format($saleData['max_m']) }}
                                         ({{ number_format($saleData['max_c']) }}) /
                                    기간: {{ number_format($saleData['time']) }}
                                            ({{ $saleData['launch_date'] }}~{{ date('Y/m/d') }})
                                  @endif
                                </p>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Group</label>
                            <div class="col-md-8 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $appData->server_group }}그룹 </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">GCM Key</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control input-sm" name="noti_gcm" value="{!! $appData->noti_gcm !!}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">GCM Number</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control input-sm" name="noti_gcm_num" value="{!! $appData->noti_gcm_num !!}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Google Project Id</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control input-sm" name="" value="" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Google App Id</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control input-sm" name="noti_fcm_num" value="{!! $appData->noti_fcm_num !!}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Google Api Key</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control input-sm" name="" value="" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">아이폰 인증서 .pem</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="file" accept=".pem" name="noti_ios" class="filestyle" data-buttonname="btn-secondary">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">아이폰 인증서 정보</label>
                            <div class="col-md-10 col-xs-9 form-inline">
                                비밀번호 :
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" class="form-control input-sm" name="noti_ios_cerp" value="{!! $appData->noti_ios_cerp !!}">
                                </div>
                                인증서 만료일 :
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" class="form-control input-sm" name="ios_cer_exp" value="{!! $appData->ios_cer_exp !!}">
                                </div>
                                개발자 만료일 :
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" class="form-control input-sm" name="ios_dev_exp" value="{!! $appData->ios_dev_exp !!}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">연락처</label>
                            <div class="col-md-10 col-xs-9 mt-1">
                                <span class="form-control-static"> <i class="fa fa-user"></i>&nbsp;&nbsp;{{ $appData->member->cellno }}</span>
                                <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" >sms보내기</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">이메일</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> {{ $appData->member->mem_email }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">결제정보</label>
                            <div class="col-md-10 col-xs-9 mt-1">
                                <span class="form-control-static"> <i class="fa fa-user"></i>&nbsp;&nbsp;3개월(손효연, 승인번호: 0, 승인날짜: 2019/11/07 [18:22]) </span>
                                <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button">결제내역</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">신청경로</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">전화영업 </p>
                            </div>
                        </div>

                        <div class="form-group row" id="paymentData">
                            <label class="col-md-2 col-form-label ">Push Server</label>
                            <div class="col-md-6 col-xs-9">
                                <select name="push_server" class="form-control input-sm">
                                    <option value="default">default</option>
                                    <option value="http://byapps.cafe24app.com/"{!! $appData->push_server == 'http://byapps.cafe24app.com/' ? ' selected' : '' !!}>http://byapps.cafe24app.com/</option>
                                    <option value="http://push1.cafe24app.com/"{!! $appData->push_server == 'http://push1.cafe24app.com/' ? ' selected' : '' !!}>http://push1.cafe24app.com/</option>
                                    <option value="http://byappspush2.cafe24app.com/"{!! $appData->push_server == 'http://byappspush2.cafe24app.com/' ? ' selected' : '' !!}>http://byappspush2.cafe24app.com/</option>
                                    <option value="http://byappspush3.cafe24app.com/"{!! $appData->push_server == 'http://byappspush3.cafe24app.com/' ? ' selected' : '' !!}>http://byappspush3.cafe24app.com/</option>
                                    <option value="http://byappspush4.cafe24app.com/"{!! $appData->push_server == 'http://byappspush4.cafe24app.com/' ? ' selected' : '' !!}>http://byappspush4.cafe24app.com/</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Push Token</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="token" readonly class="form-control input-sm" value="{!! $appData->token !!}">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-warning" style="height:30px">토큰생성</button>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">플랫폼 사용기간</label>
                            <div class="col-md-10 col-xs-9 form-inline">
                                <div class="col-md-2 col-xs-9 pl-0">
                                    <input type="text" name="start_time" class="form-control input-sm" value="{!! $appData->start_time !!}">
                                </div>
                                ~
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" name="end_time" class="form-control input-sm" value="{!! $appData->end_time !!}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Android URL</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="app_android_url" class="form-control input-sm" value="{!! $appData->app_android_url !!}">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-success" onclick="goLink(this)">Play Store</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">IOS URL</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="app_ios_url" class="form-control input-sm" value="{!! $appData->app_ios_url !!}">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-light" onclick="goLink(this)">App Store</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Mobile URL</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="surl" class="form-control input-sm" value="{!! $appData->surl !!}">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-inverse" onclick="goLink(this)">Mobile Home</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">PackageName</label>
                            <div class="col-md-10 col-xs-9 form-inline">
                                <div class="input-group col-md-5 col-xs-9 px-0">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-success"><i class="fa fa-android"></i> </button>
                                    </span>
                                    <input type="text" name="androi_pk" class="form-control input-sm" value="{!! $appData->packagename !!}">
                                </div>
                                <div class="input-group col-md-5 col-xs-9 px-0">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-light"><i class="fa fa-apple"></i></button>
                                    </span>
                                    <input type="text" name="bundleid" class="form-control input-sm" value="{!! $appData->bundleid !!}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Android-Vender</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="vender" class="form-control input-sm" value="{!! $appData->vender !!}">
                                    <p class="mt-1 ml-1 mb-0">(예 - com.android.vending)</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Android-Hash</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="hashkey" class="form-control input-sm" placeholder="안드로이드 무결성 검증" value="{!! $appData->hashkey !!}">
                                    <p class="mt-1 ml-1 mb-0">(자동인증: byapps_cert // 키스토어 SHA-1: keytool -printcert -file META_INF/CERT.RSA)</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Ios-Hash</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="android_hash" class="form-control input-sm" placeholder="IOS 무결성 검증" value="{!! $appData->ioshack !!}">
                                    <p class="mt-1 ml-1 mb-0">IOS 무결성 검증(sc:pl:id)</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Cafe24 Mall Id</label>
                            <div class="col-md-3 col-xs-9">
                                <input type="text" name="host_id" class="form-control input-sm" placeholder="카페24 몰아이디" value="{!! $appData->host_id !!}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Charset</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                <div class="radio radio-success mr-2">
                                    <label>
                                        <input type="radio" name="txtencode" value="utf-8"{!! $appData->txtencode == 'utf-8' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;UTF-8
                                    </label>
                                </div>
                                <div class="radio radio-info mr-2">
                                    <label>
                                        <input type="radio" name="txtencode" value="euc-kr"{!! $appData->txtencode == 'euc-kr' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;EUC-KR
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Hosting Com.</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                <div class="radio radio-primary mr-2">
                                    <label>
                                        <input type="radio" name="host_name" value="cafe24"{!! $appData->host_name == 'cafe24' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;카페24
                                    </label>
                                </div>
                                <div class="radio radio-warning mr-2">
                                    <label>
                                        <input type="radio" name="host_name" value="makeshop"{!! $appData->host_name == 'makeshop' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;메이크샵
                                    </label>
                                </div>
                                <div class="radio radio-info mr-2">
                                    <label>
                                        <input type="radio" name="host_name" value="godo"{!! $appData->host_name == 'godo' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;고도몰
                                    </label>
                                </div>
                                <div class="radio radio-inverse mr-2">
                                    <label>
                                        <input type="radio" name="host_name" value="wisa"{!! $appData->host_name == 'wisa' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;위사
                                    </label>
                                </div>
                                <div class="radio radio-inverse mr-2">
                                    <label>
                                        <input type="radio" name="host_name" value="etc"{!! $appData->host_name == 'etc' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;기타
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Lang</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" name="app_lang[]" value="ko" {!! in_array('ko',$appLang) ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;한국어
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" name="app_lang[]" value="en" {!! in_array('en',$appLang) ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;영어
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" name="app_lang[]" value="zh" {!! in_array('zh',$appLang) ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;중국어
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" name="app_lang[]" value="tw" {!! in_array('tw',$appLang) ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;대만어
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" name="app_lang[]" value="ja" {!! in_array('ja',$appLang) ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;일본어
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" name="app_lang[]" value="vi" {!! in_array('vi',$appLang) ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;베트남어
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">자동로그인</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="Y" name="auto_login"{!! $appData->auto_login == 'Y' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;자동로그인 허용
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">포인트</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="Y" name="login_point" {!! $appData->login_point == 'Y' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;출석체크
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="Y" name="push_point" {!! $appData->push_point == 'Y' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;푸쉬체크
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="Y" name="install_point" {!! $appData->install_point == 'Y' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;앱설치
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="Y" name="point_transfer_btn" {!! $appData->point_transfer_btn == 'Y' ? ' checked' : '' !!}>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;앱 포인트 수동전환
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. IMG</label>
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
                                <input type="text" class="form-control" name="cscall" value="{!! $appData->cscall !!}">
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
                                <textarea id="receipt" name="app_intro" class="form-control" rows="5">{!! $appData->app_intro !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">앱정보</label>
                            <div class="col-md-10 col-xs-9">
                                <textarea id="developer_info" name="developer_info" class="form-control" rows="5">{!! $appData->developer_info !!}</textarea>
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
<script>
    $(document).ready(function() {
        $('#developer_info').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
        });
    });
</script>
@endsection
@section('script')
<script>
    var sys = true;
    function modify(obj){
        var request = new FormData(obj);
        $('.error').remove();
        $('.is-invalid').removeClass('is-invalid');
        if(!sys) return sys;
        sys = false;
        $.ajax({
            url : location.href,
            type : 'POST',
            data : request,
            cache : false,
            contentType: false,
            processData: false,
            error : function(jqXHR, textStatus, error) {
                var errors = jqXHR.responseJSON.errors;
                var firstError = true;
                for(key in errors){
                    var input = $(`[name=${key}]`).length == 0 ? $(`[name='${key}[]']`).eq(0).closest('div') : $(`[name=${key}]`);
                    var value = errors[key];
                    if(firstError){
                        input.focus();
                        firstError = false;
                    }
                    input.addClass('is-invalid');
                    for(var i = 0 ; i < value.length ; i++){
                        var message = '';
                        var error = value[i];
                        switch (error) {
                            case 'validation.required':
                                message = '입력해 주세요.';
                                break;
                            case 'validation.after':
                                message = '시작시간 이후여햐 합니다.';
                                break;
                            case 'validation.regex':
                            case 'validation.date_format':
                                message = '형식에 맞지 않습니다.';
                                break;
                            default:
                                message = error;
                        }
                        input.parent().append(`
                            <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;" role="alert">
                                <strong>${message}</strong>
                            </span>
                        `);
                    }
                }
                sys = true;
            },
            success : function(data, jqXHR, textStatus) {
                alert('처리되었습니다');
                refreshComment();
                sys = true;
            }
        });
        return false;
    }
    function goLink(obj){
        obj = $(obj)
        var url = obj.parent().parent().find('input[type=text]').val()
        if(!url) return;
        window.open(url, "_blank");
    }

    // 사이드바 열고 고객정보 보기
    function getMemberInfo(idx) {
      console.log(idx);
      sidebarOpen();
      $('#nav-cc-tab').click();
    }
</script>
@endsection
@section('style')
    <style>
        .no-drag {-ms-user-select: none; -moz-user-select: -moz-none; -webkit-user-select: none; -khtml-user-select: none; user-select:none;}
    </style>
@endsection
