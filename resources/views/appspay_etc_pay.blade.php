@extends('layouts.default')

@section('content')

<div class="container-fluid">

  <p>별도결제</p>

  <div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">

        <!-- card -->
        <div class="card">
            <!-- cardbody start -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">

                        @if ($message = Session::get('success'))
                        <div class="row justify-content-end">
                            <div class="col-3 col-align-self-end alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>
                                toastr.success("{{ $message }}");
                                </strong>
                            </div>
                        </div>
                        @endif

                        @if ($errors->any())
                          @foreach ($errors->all() as $error)
                        <div class="row justify-content-end">
                            <div class="col-3 col-align-self-end alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>

                                    {{ $error }}

                                </strong>
                            </div>
                        </div>
                        @endforeach
                        @endif

                        <div class="row">
                        <div class="col-md-12 col-xs-12 px-4">
                          <!-- form start -->

                          {!! Form::open(array('route' => ['add_etc_pay'], 'method' => 'post')) !!}

                          @csrf

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">회원ID</label>
                                <div class="col-md-10 col-xs-9">
                                    <div class="form-inline">
                                        <input class="form-control input-sm" type="text" name="mem_id" id="mem_id" value="" required>
                                        <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="검색" onclick="goSearch();">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">결제구분</label>
                                <div class="col-md-10 col-xs-9 form-inline mt-2">
                                    <div class="radio radio-success mr-2">
                                        <label>
                                            <input type="radio" name="pay_type" value="6" required>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;에임드
                                        </label>
                                    </div>
                                    <div class="radio radio-info mr-2">
                                        <label>
                                            <input type="radio" name="pay_type" value="5" checked>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;리타쿠
                                        </label>
                                    </div>
                                    <div class="radio radio-warning mr-2">
                                        <label>
                                            <input type="radio" name="pay_type" value="3">
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;아이폰 추가개발
                                        </label>
                                    </div>
                                    <div class="radio radio-danger mr-2">
                                        <label>
                                            <input type="radio" name="pay_type" value="4">
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;기타
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                            <label class="col-md-2 col-form-label">결제내역</label>
                                <div class="col-md-10 col-xs-9">
                                    <input class="form-control input-sm" type="text" value="" name="app_name" id="appName" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">결제금액</label>
                                <div class="col-md-10 col-xs-9">
                                    <div class="form-inline">
                                        <p class="input-group">
                                          <input class="form-control input-sm" type="number" name="amount" value="" id="amount" required>원
                                        <p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="pay_term" style="display:none;">
                                <label class="col-md-2 col-form-label">서비스기간</label>
                                <div class="col-md-10 col-xs-9 form-inline mt-2">
                                    <div class="radio radio-success mr-2">
                                        <label>
                                            <input type="radio" name="pay_term" value="30">
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;1개월
                                        </label>
                                    </div>
                                    <div class="radio radio-info mr-2">
                                        <label>
                                            <input type="radio" name="pay_term" value="180">
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;6개월
                                        </label>
                                    </div>
                                    <div class="radio radio-warning mr-2">
                                        <label>
                                            <input type="radio" name="pay_term" value="365">
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;12개월
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 col-xs-9 offset-md-2">
                                    <button type="button" class="btn btn-light btn-sm float-right ml-1" onclick="goBack()">취소</button>
                                    <button type="submit" class="btn btn-info btn-sm float-right">등록</button>
                                </div>
                            </div>

                            {!! Form::close() !!}
                          <!-- form end -->
                        </div>

                        </div><!--row end-->
                    </div>
                        <!-- col-md-12 -->
                </div>
                    <!-- row end -->
            </div>
            <!-- cardbody end -->
        </div>
        <!-- card end -->
    </div>
  </div>
</div>
@endsection

@toastr_css
@toastr_js
@toastr_render

@section('script')
<script>
$(document).ready(function() {
    $("input[name=pay_type]").change(function() {
      var radioValue = $(this).val();

      if (radioValue == "6") {
        console.log("aimd");
        $("#pay_term").show();
      } else {
        $("#pay_term").hide();
      }

      if (radioValue == "3") {
        console.log("ios");
        document.getElementById("appName").value = "아이폰 추가개발";
        document.getElementById("amount").value = "99000";
      } else {
        document.getElementById("appName").value = "";
        document.getElementById("amount").value = "";
      }
    })
});

// function etc_add(obj) {
//    var request = new FormData(obj);
//    console.log(request);
//    $.ajax({
//      url: 'add_etc_pay',
//      type: 'POST',
//      data: request,
//      success: function(response) {
//        console.log(response);
//      }
//    })
// }

function goSearch() {
  sidebarOpen();
  $("input[name=search]").focus();
}

function goBack() {
  history.back();
}
</script>
@endsection
