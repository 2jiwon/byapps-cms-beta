@extends('layouts.default')

@section('content')
<style>
.input-group-text {
  font-size: 11px;
}
</style>

@if (Auth::user())
<div class="container-fluid">

<div class="sortable">

      @foreach ($home_layouts as $layout)
        @if ($layout == 'layout1')
        <li class="ui-state-default one card" id="layout1">
            <div class="cal_box">
                <div class="card-title m-2">
                    <i class="fi-menu"></i> 주문요청현황
                    <button class="btn float-right" type="button" data-toggle="collapse" data-target="#salesList" aria-expanded="true" aria-controls="salesList"><i class="dripicons-chevron-down"></i></button>
                </div>
            </div>

            @include('components.status')
        </li>

      @elseif ($layout == 'layout2')
      <li class="ui-state-default card" id="layout2">
          <div class="cal_box">
              <div class="card-title m-2">
                  <i class="fi-menu"></i> 통계
                  <button class="btn float-right" type="button" data-toggle="collapse" data-target="#allLank" aria-expanded="true" aria-controls="allLank">
                    <i class="dripicons-chevron-down"></i>
                  </button>
              </div>
          </div>

          <!-- 기간조회 -->
          <div class="card-title">
            <div class="row justify-content-md-center mb-5">

              <div class="col-md-9">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">통계기간</span>
                  </div>
                  <input type="text" id="start_date_chart" name="start_date_chart" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
                  <div class="input-group-append">
                    <span class="input-group-text">부터</span>
                  </div>
                  <input type="text" id="end_date_chart" name="end_date_chart" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
                  <div class="input-group-append">
                    <span class="input-group-text">까지</span>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a href="javascript:void(0)" onclick="stat_chartDateTerm(7)">일주일</a>
                    </span>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a href="javascript:void(0)" onclick="stat_chartDateTerm(30)">1개월</a>
                    </span>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a href="javascript:void(0)" onclick="stat_chartDateTerm(90)">3개월</a>
                    </span>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a href="javascript:void(0)" onclick="stat_chartDateTerm(180)">6개월</a>
                    </span>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a id="getDate" href="javascript:void(0)" onclick="showEntireChart($('#start_date_chart').val(), $('#end_date_chart').val())"><i class="entypo-chart-bar"></i> 보기</a>
                    </span>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- 기간조회 End -->

          @include('components.chart')
        </li>

      @elseif ($layout == 'layout3')
      <li class="ui-state-default card" id="layout3">
          <div class="cal_box">
              <div class="card-title m-2">
                  <i class="fi-menu"></i> 매출 통계표
                  <button class="btn float-right" type="button" data-toggle="collapse" data-target="#allLank" aria-expanded="true" aria-controls="allLank">
                    <i class="dripicons-chevron-down"></i>
                  </button>
              </div>
          </div>

          <!-- 기간조회 -->
          <div class="card-title">
            <div class="row justify-content-md-center mb-5">

              <div class="col-md-9">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">통계기간</span>
                  </div>
                  <input type="text" id="start_date_table" name="start_date_table" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
                  <div class="input-group-append">
                    <span class="input-group-text">부터</span>
                  </div>
                  <input type="text" id="end_date_table" name="end_date_table" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
                  <div class="input-group-append">
                    <span class="input-group-text">까지</span>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a href="javascript:void(0)" onclick="stat_tableDateTerm(7)">일주일</a>
                    </span>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a href="javascript:void(0)" onclick="stat_tableDateTerm(30)">1개월</a>
                    </span>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a href="javascript:void(0)" onclick="stat_tableDateTerm(90)">3개월</a>
                    </span>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a href="javascript:void(0)" onclick="stat_tableDateTerm(180)">6개월</a>
                    </span>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a href="javascript:void(0)" onclick="showEntireTable(day1, day2)"><i class="entypo-chart-bar"></i> 보기</a>
                    </span>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- 기간조회 End -->

          <!-- <div class="dragbox_hover row collapse show" id="allLank"> -->
          <div class="dragbox_hover collapse show p-3" id="allLank">
              <!-- 매출 통계 표 -->
              <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                  <tr>
                      <th colspan="2" rowspan="2">구분</th>
                      <th colspan="3">이번주</th> <th colspan="3">지난주</th> <th colspan="3">증감수</th>
                  </tr>
                  <tr>
                      <th>전체</th> <th>유료</th> <th>무료</th>
                      <th>전체</th> <th>유료</th> <th>무료</th>
                      <th>전체</th> <th>유료</th> <th>무료</th>
                  </tr>
                  <tr>
                      <th rowspan="2">이용수</th>
                      <th>플랫폼</th>
                      <td> </td> <td></td> <td></td>
                      <td> </td> <td></td> <td></td>
                      <td> </td> <td></td> <td></td>
                  </tr>
                  <tr>
                      <th>MA</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              </div>
          </div>

      </li>

      @elseif ($layout == 'layout4')
      <li class="ui-state-default one card" id="layout4">
          <div class="cal_box">
              <div class="card-title m-2">
                  <i class="fi-menu"></i> 만료예정업체
                  <button class="btn float-right" type="button" data-toggle="collapse" data-target="#endList" aria-expanded="true" aria-controls="endList">
                    <i class="dripicons-chevron-down"></i>
                  </button>
              </div>
          </div>

          @include('components.expiredlist')

      </li>
      @endif
  @endforeach
</div>

<!-- Pages -->

</div>
@endif

@endsection
