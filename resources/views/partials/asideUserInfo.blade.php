    <?$userInfoData = getUserData($mem_id)?>
    <h4 class="header-title">{{ $userInfoData->mem_nick }}</h2>

    <hr />

    <div class="row">
        <div class="col-md-12 col-xs-12 px-4">
            <div class="form-group row" id="paymentData">
                <label class="col-md-4 col-form-label ">RESELLER ID</label>
                <div class="col-md-8 col-xs-9">
                  <p class="form-control-static mt-1 mb-1">
                    {{ $userInfoData->recom_id }} &nbsp&nbsp
                    <?$resellerData = getResellerInfo($userInfoData->recom_id);?>
                    @if($resellerData != null)
                    <strong>{{ $resellerData->company }}
                    ({{ $resellerData->mem_name }}, {{ $resellerData->cellno }}, {{ $resellerData->phoneno }})
                    </strong>
                    @endif
                  </p>

                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">고객 ID</label>
                <input type="text" class="form-control col-md-8" id="mem_id" name="mem_id" value="{{ $userInfoData->mem_id }}">
                <div class="col-md-12 col-xs-9">
                    <div class="form-inline">
                        <div class="input-group">
                            <input class="btn btn-primary waves-effect wave-light btn-xs mr-1 col-md-3" type="button" value="회원로그인" onclick="getMemberInfo({!! json_encode($userInfoData->idx)!!})">
                            <input class="btn btn-info waves-effect btn-xs mr-1 col-md-3" type="button" value="주문내역" onclick="goToAppsOrderList()">
                            <input class="btn btn-info waves-effect btn-xs mr-1 col-md-3" type="button" value="결제내역" onclick="goToAppsPaymentList()">
                            <input class="btn btn-success waves-effect btn-xs mr-1 col-md-3" type="button" value="앱 관리">
                            <input class="btn btn-warning waves-effect btn-xs mr-1 col-md-3" type="button" value="프로모션 발급">
                            <input class="btn btn-danger waves-effect btn-xs mr-1 col-md-3" type="button" value="ID 변경">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">새 비밀번호</label>
                <div class="col-md-8 col-xs-9">
                  <div class="form-inline">
                      <div class="input-group">
                          <input type="password" class="form-control mr-1" id="new_passwd" name="new_passwd" value="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">새 비밀번호 확인</label>
                <div class="col-md-8 col-xs-9">
                    <div class="form-inline">
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_passwd_confirm" name="new_passwd_confirm" value="">
                            <input class="btn btn-info waves-effect btn-xs " type="button" value="비밀번호 초기화 메일발송">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">업체명</label>
                <div class="col-md-8 col-xs-9">
                  <div class="form-inline">
                      <div class="input-group">
                          <input type="text" class="form-control" id="mem_nick" name="mem_nick" value="{{ $userInfoData->mem_nick }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">대표자명</label>
                <div class="col-md-8 col-xs-9">
                  <div class="form-inline">
                      <div class="input-group">
                          <input type="text" class="form-control" id="ceo_name" name="ceo_name"  value="{{ $userInfoData->ceo_name }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">담당자명</label>
                <div class="col-md-8 col-xs-9">
                  <div class="form-inline">
                      <div class="input-group">
                          <input type="text" class="form-control" id="mem_name" name="mem_name" value="{{ $userInfoData->mem_name }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">연락처</label>
                <div class="col-md-8 col-xs-9">
                  <div class="form-inline">
                      <div class="input-group">
                          <input type="text" class="form-control" id="cellno" name="cellno" value="{{ $userInfoData->cellno }}">
                          <input class="btn btn-info waves-effect btn-xs ml-1" type="button" value="SMS 보내기">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">만료알림 연락처</label>
                <div class="col-md-8 col-xs-9">
                  <div class="form-inline">
                      <div class="input-group">
                          <input type="text" class="form-control" id="phoneno" name="phoneno" value="{{ $userInfoData->phoneno }}">
                          <input class="btn btn-info waves-effect btn-xs ml-1" type="button" value="SMS 보내기">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">이메일</label>
                <div class="col-md-8 col-xs-9">
                  <div class="form-inline">
                      <div class="input-group">
                          <input type="text" class="form-control" id="mem_email" name="mem_email" value="{{ $userInfoData->mem_email }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">로그정보</label>
                <div class="col-md-8 col-xs-9">
                    <div class="form-inline">
                        <p class="input-group">
                            <p class="form-control-static mt-1 mb-1">
                                로그정보
                            </p>
                        <p>
                    </div>
                </div>
            </div>
            <!-- form end -->
            <button type="button" class="btn btn-sm btn-inverse waves-effect w-md waves-light float-right">
              <i class="mdi mdi-account"></i><span>회원정보 수정</span>
            </button>
        </div>
