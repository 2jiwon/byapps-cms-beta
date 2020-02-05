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

                        <div class="row">
                        <div class="col-md-12 col-xs-12 px-4">
                            <!-- form start -->

                            <input type="hidden" name="order_id" value="">
                            <input type="hidden" name="reg_time" value="">
                            <input type="hidden" name="app_name" value="">


                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">회원ID</label>
                                <div class="col-md-10 col-xs-9">
                                    <div class="form-inline">
                                        <!-- <p class="input-group"> -->
                                            <input class="form-control input-sm" type="text" value="">
                                        <!-- </p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">결제구분</label>
                                <div class="col-md-10 col-xs-9 form-inline mt-2">
                                    <div class="radio radio-success mr-2">
                                        <label>
                                            <input type="radio" name="service_type" value="biz">
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;에임드
                                        </label>
                                    </div>
                                    <div class="radio radio-info mr-2">
                                        <label>
                                            <input type="radio" name="service_type" value="lite">
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;리타쿠
                                        </label>
                                    </div>
                                    <div class="radio radio-warning mr-2">
                                        <label>
                                            <input type="radio" name="service_type" value="tester">
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;아이폰 추가개발
                                        </label>
                                    </div>
                                    <div class="radio radio-danger mr-2">
                                        <label>
                                            <input type="radio" name="service_type" value="tester">
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;기타
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                            <label class="col-md-2 col-form-label">결제내역</label>
                                <div class="col-md-10 col-xs-9">
                                    <input class="form-control input-sm" type="text" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">결제금액</label>
                                <div class="col-md-10 col-xs-9">
                                    <div class="form-inline">
                                        <p class="input-group">
                                          <input class="form-control input-sm" type="number" value="">원
                                        <p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 col-xs-9 offset-md-2">
                                    <button type="submit" class="btn btn-light btn-sm float-right ml-1">취소</button>
                                    <button type="submit" class="btn btn-info btn-sm float-right">등록</button>
                                </div>
                            </div>

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
