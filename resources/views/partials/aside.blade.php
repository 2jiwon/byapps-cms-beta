<script>
    if (location.href.indexOf("detail") == -1) {
       <?
        $tablist = '<a class="nav-item nav-link" id="nav-search-info-tab" data-toggle="tab"
                    href="#nav-search-info" role="tab" aria-controls="nav-search-info" aria-selected="false">
                    검색업체 정보</a>';
       ?>
    }
    var commentMode = 'all';
    var commentSendMode = {!! !isset($sendMode) ? 'null' : "'".$sendMode."'" !!};
    var refreshComment;
    var appidx = {!! request()->route()->parameter('idx') == null ? null : "'".request()->route()->parameter('idx')."'" !!};
    var commentFillter = {
        idx: appidx,
        mmid: commentMode,
        commentSendMode: commentSendMode,
        comment: null,
        _token: "{{ csrf_token() }}"
    }

    $(document).ready(function(){
      // 사이드바 검색부분
        $('#search').submit(function(){
            $.ajax({
                url: '{{ Route("side-search") }}',
                type: 'POST',
                data: {
                  query: $(this).find('[name=search]').val()
                },
                success: function(response) {
                  //console.log(response);
                  $('#nav-search-info-tab').click();
                  $('#search-info-app-name').html(`${response[0][0].app_name}`);
                  $('#nav-company-info #company-id').html(`${response[0][0].mem_id}`);

                  // $('#nav-company-info #cellno').value = response[0][1].cellno;
                  document.getElementById('cellno').value = response[0][1].cellno;
                  console.log(response[0][1].cellno);

                  $('#nav-app-info #app-id').html(`${response[0][0].app_id}`);
                }
            })
        });

        // 댓글
        if(!appidx) return;

        refreshComment = function(){
            $('.comments').html('');
            $.ajax({
                url: '{{ Route("comment") }}',
                type: 'POST',
                data: commentFillter,
                success: function(response) {
                    response.forEach( data =>
                        $('.comments').append(`<li style="font-size:.8rem;border-bottom: 1px dotted #ccc;padding-bottom:12px;margin-bottom:8px">
                        ${data.comment}<br>-${data.mem_name}, ${data.reg_time}<span style="float:right;margin-right:5px;">${data.mmid}</span></li>`)
                    );
                }
            })
        }
        refreshComment();

        $('#nav-comment .custom-select').change(function(){
            mode = $(this).val();
            commentFillter.mmid = mode;
            refreshComment();
        })

        if(!commentSendMode) return;

        $('#sendComment').submit(function( event ) {
            event.preventDefault();
            var msg = $(this).find('input[name=message]').val();
            if(!msg)return;
            $(this).find('input[name=message]').val('')
            commentFillter.comment = msg;
            $.ajax({
                async: false,
                url: '{{ Route("commentsend") }}',
                type: 'POST',
                data: commentFillter,
                success: function(data) {
                    $('.comments').html(`<li style="font-size:.8rem;border-bottom: 1px dotted #ccc;padding-bottom:12px;margin-bottom:8px">
                    ${data.comment}<br>-${data.mem_name}, ${data.reg_time}<span style="float:right;margin-right:5px;">
                    ${data.mmid}</span></li>`+$('.comments').html())
                },
            });
        });
    })
</script>

<div id="sidebar-close" class="my-2">
  <i class="mdi mdi-close"></i>
</div>

<!-- 검색 박스 -->
<form id="search" class="navbar-nav flex-row ml-md-auto d-none d-md-flex form-inline" action="javascript:void(0)">
    <div class="form-group">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">검색</button>
    </div>
</form>

<div id="app_noti" class="card-body row">
    <div class="col-12" style="overflow:auto;" >
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-comment-tab" data-toggle="tab" href="#nav-comment" role="tab" aria-controls="nav-comment" aria-selected="true">댓글</a>
                <?= $tablist ?>
                <a class="nav-item nav-link" id="nav-cc-tab" data-toggle="tab" href="#nav-cc" role="tab" aria-controls="nav-comment" aria-selected="true">회원정보</a>
            </div>
        </nav>

        <div class="tab-content">
            <!-- #nav-comment -->
            <div class="tab-pane px-3 active" id="nav-comment" role="tabpanel" aria-labelledby="nav-comment-tab">
                <!-- <div id="comment"> -->
                <div>
                <!-- 코멘트박스 -->
                    <select name="" class="custom-select my-1 mr-sm-2">
                        <option value="order">주문</option>
                        <option value="payment">결제</option>
                        <option value="new_update">업데이트</option>
                        <option value="apps">앱 상세</option>
                        <option value="reseller">리셀러</option>
                        <option value="myqna">문의</option>
                        <option value="ma">MA</option>
                        <option value="all" selected>전체</option>
                    </select>
                    <ul class="comments" style="overflow-y: auto;max-height:500px;">
                    </ul>

                    <div id="comment_box" class="row" >
                        <!-- comment component 자리 -->
                    </div>
                <!-- //코멘트박스 -->
                </div>
                <!-- 코멘트 푸터 고정-->
                <div class="box-footer">
                    <form id="sendComment" method="post" action="javascript:void(0)">
                    <div class="input-group">
                    <div class="checkbox checkbox-danger my-2">
                            <label>
                                <input type="checkbox" value="" >
                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                            </label>
                        </div>
                        <input type="text" name="message" placeholder="댓글 작성..." class="form-control" style="height:35px">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-flat">전송</button>
                        </span>
                    </div>
                    </form>
                </div><!-- 코멘트 푸터 고정-->
            </div>

            <!-- #nav-comment -->
            <div class="tab-pane px-3" id="nav-search-info" role="tabpanel" aria-labelledby="nav-search-info">
                <!-- card -->
              <h3 class="card-title my-2">
                  <a class="text-dark" id="search-info-app-name">
                  </a>
              </h3>

              <div id="app_noti" class="row" >

                  <div class="col-12" style="overflow:auto;" >
                      <nav>
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active" id="nav-company-info-tab" data-toggle="tab" href="#nav-company-info" role="tab" aria-controls="nav-company-info" aria-selected="true">업체정보</a>
                              <a class="nav-item nav-link" id="nav-app-info-tab" data-toggle="tab" href="#nav-app-info" role="tab" aria-controls="nav-app-info" aria-selected="false">서비스기간</a>
                          </div>
                      </nav>

                      <!-- tab content-->
                      <div class="tab-content">
                          <!-- #nav-company-info -->
                          <div class="tab-pane px-3 active" id="nav-company-info" role="tabpanel" aria-labelledby="nav-company-info-tab">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group row">
                                          <label class="col-md-3 col-xs-12 control-label">ID</label>
                                          <strong class="form-control-static mr-3" id="company-id"></strong>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">RESELLER</label>
                                          <strong class="form-control-static" id="reseller"></strong>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">비밀번호</label>
                                          <input type="password" name="pw" class="col-4" value="">
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">비밀번호 확인</label>
                                          <input type="password" name="check_pw" class="col-4" value="">
                                      </div>

                                  </div>

                                  <div class="col-md-12">
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">대표자</label>
                                          <strong class="form-control-static" id="ceo"></strong>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">담당자</label>
                                          <strong class="form-control-static mr-3" id=""></strong>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">연락처</label>
                                          <input type="text" name="phone" class="col-4" id="cellno" value="">
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">이메일</label>
                                          <input type="text" name="email" class="col-4" value="">
                                      </div>
                                  </div>

                              </div>
                          </div>
                          <!-- //#nav-company-info -->

                          <!-- #nav-app-info -->
                          <div class="tab-pane fade px-3 text-black" id="nav-app-info" role="tabpanel" aria-labelledby="nav-app-info-tab">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">APP ID</label>
                                          <strong class="form-control-static" id="app_id"></strong>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">APP NAME</label>
                                          <input type="text" name="pw" class="col-4" value="">
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">부가서비스</label>
                                          <div class="col-md-7 col-xs-12 px-0">
                                              <div class="checkbox checkbox-warning">
                                                  <label>
                                                      <input type="checkbox" value="iphone" checked="">
                                                      <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                      푸쉬자동화
                                                  </label>
                                              </div>
                                              <div class="checkbox checkbox-warning">
                                                  <label>
                                                      <input type="checkbox" value="iphone" checked="">
                                                      <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                      웹푸쉬
                                                  </label>
                                              </div>
                                              <br>
                                              <div class="checkbox checkbox-pink">
                                                  <label>
                                                      <input type="checkbox" value="android" >
                                                      <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                      MA통합
                                                  </label>
                                              </div>
                                              <div class="checkbox checkbox-purple">
                                                  <label>
                                                      <input type="checkbox" value="iphone" checked="">
                                                      <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                      리타겟팅
                                                  </label>
                                              </div>
                                              <div class="checkbox checkbox-purple">
                                                  <label>
                                                      <input type="checkbox" value="android" checked="">
                                                      <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                      MA
                                                  </label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12 control-label">이용기간</label>
                                          <div class="input-daterange input-group col-md-7 col-xs-12" id="date-range">
                                              <input class="form-control input-limit-datepicker" type="text" name="daterange" value="06/01/2015 - 06/07/2015"/>
                                              <input type="text" class="form-control col-md-2 col-xs-2" name="count-day" value="">일
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-5 col-xs-12control-label">APP OS</label>
                                          <div class="checkbox checkbox-success m-t-0">
                                              <label>
                                                  <input type="checkbox" value="android" checked="">
                                                  <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                  android
                                              </label>
                                          </div>
                                          <div class="checkbox checkbox-info ml-3">
                                              <label>
                                                  <input type="checkbox" value="iphone" checked="">
                                                  <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                  ios
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-md-5 col-xs-12 control-label">이용기간</label>

                                      <div class="form-inline">
                                          <div class="input-daterange input-group row" id="date-range">
                                              <input type="date" class="col-md-3 col-xs-3" name="start">
                                              <div class="input-group-append">
                                                  <span class="input-group-text bg-custom text-white b-0">to</span>
                                              </div>
                                              <input type="date" class="col-md-3 col-xs-3" name="end">
                                              <input type="text" class="col-md-2 col-xs-2" name="count-day" value="">일
                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </div> <!-- //#nav-app-info -->
                        </div><!-- //tab content-->
                      </div>

                    </div><!-- //card body -->
                </div>

                <div class="tab-pane px-3" id="nav-cc" role="tabpanel" aria-labelledby="nav-cc-tab">
                    <div class="row">
                        <div class="col-sm-12" id="user-info">
                          @if(isset($mem_id) && $mem_id != null)
                            @include('partials.asideUserInfo',['mem_id'=>$mem_id])
                          @endif
                        </div><!--row end-->
                    </div><!--col end-->
                </div><!--row end-->
            </div><!--nav-cc end-->
        </div><!--tab-content end-->

    </div>
</div><!-- 전체를 감싸고있는 박스 -->
