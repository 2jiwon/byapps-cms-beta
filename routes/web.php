<?php

Route::get('/test',function(){
  dd(config('filesystems'));
  Storage::get('5de8bd2a668e6.jpeg');
});
Route::get('/test/{idx?}',function($idx = 19){
   \Illuminate\Support\Facades\Auth::guard('web')->loginUsingId($idx);
   return '<script>location=`/`</script>';
});

// 세션정보 확인용
Route::get('/session',function(){
    dd(session()->all());
});
Route::get('/', 'HomeController@index')->name('home');
Route::get('/load-more-data', 'ExpiredController@more_data');
Route::get('/layout', 'HomeController@onLayoutChange');
//Route::any('/search', 'HomeController@search')->name('search');
//Route::any('/search-more', 'Search@load_more')->name('search-more');
Route::any('/search', 'SearchContorller@search')->name('search');
Route::any('/search-more', 'SearchContorller@loadMore')->name('search-more');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

// 차트 데이터
Route::post('/chart', 'ChartController@index');
Route::post('/chart/entire_chart', 'ChartController@onGetEntireChartData');
Route::post('/chart/app_term', 'ChartController@onGetAppTermChartData');
Route::get('/chart/app_total', 'ChartController@onGetAppChartData');
Route::post('/chart/ma_term', 'ChartController@onGetMaTermChartData');
Route::get('/chart/ma_total', 'ChartController@onGetMaChartData');

// 매출 차트 데이터
Route::post('/saleschart', 'SalesChartController@index');
//Route::post('/saleschart/entire_chart', 'SalesChartController@onGetEntireSalesChartData');
Route::post('/saleschart/sales_term', 'SalesChartController@onGetSalesTermChartData');
Route::post('/saleschart/sales_total', 'SalesChartController@onGetSalesChartData');

// 매출 통계표
Route::post('/sales', 'SalesController@getPlatformData');
Route::get('/data','File@view');

Route::group(['middleware' => ['auth']], function() {
  // 결제관리
  Route::view('/appspaylist', 'appspaylist')->name('appspaylist.view');
  Route::get('/appspaylist/data', 'AppsPaymentController@getAppsPaymentData')->name('appspaylist');
  Route::get('/appspaydetail/{idx}', 'AppsPaymentController@getSingleData')->name('appspaydetail');
  Route::post('/appspayupdate/{idx}', 'AppsPaymentController@update')->name('appspayupdate');
  Route::post('/getappsorderidx', 'AppsPaymentController@getAppsOrderIdx')->name('getappsorderidx');
  Route::post('/getappspaymentidx', 'AppsPaymentController@getAppsPaymentIdx')->name('getappspaymentidx');
  // 프로모션
  Route::view('/promolist', 'promolist')->name('promolist.view');
  Route::get('/promolist/data', 'PromotionController@getPromotionData')->name('promolist');
  Route::get('/promodetail/{idx}', 'PromotionController@getSingleData')->name('promodetail');
  // 앱 접수
  Route::view('/appsorderlist', 'appsorderlist')->name('appsorderlist.view');
  Route::get('/appsorderlist/data', 'AppsOrderController@getAppsOrderData')->name('appsorderlist');
  Route::get('/appsorderdetail/{idx}', 'AppsOrderController@getSingleData')->name('appsorderdetail');
  // 앱 목록
  Route::view('/appslist', 'appslist')->name('appslist.view');
  Route::get('/appslist/data', 'AppsListController@getAppsListData')->name('appslist');
  Route::get('/appsdetail/{idx}', 'AppsListController@getSingleData')->name('appsdetail');
  Route::post('/appsdetail/{idx}', 'AppsListController@update')->name('appsupdate');
  // 업데이트 관리
  Route::view('/appsupdatelist', 'appsupdatelist')->name('appsupdatelist.view');
  Route::get('/appsupdatelist/data', 'AppsUpdateController@getAppsUpdateData')->name('appsupdatelist');
  Route::get('/appsupdatedetail/{idx}', 'AppsUpdateController@getSingleData')->name('appsupdatedetail');
  // APK 관리
  Route::view('/apklist', 'apklist')->name('apklist.view');
  Route::get('/apklist/data', 'ApkController@getApkData')->name('apklist');
  Route::get('/apkdetail/{idx}', 'ApkController@getSingleData')->name('apkdetail');
  Route::post('/apkupdate/{idx}', 'ApkController@update')->name('apkupdate');

  // Cafe24 앱 설치
  Route::view('/cafe24tokenlist', 'cafe24tokenlist')->name('cafe24tokenlist.view');
  Route::get('/cafe24tokenlist/data', 'Cafe24ApiTokenController@getCafe24ApiTokenData')->name('cafe24tokenlist');
  Route::get('/cafe24tokendetail/{idx}', 'Cafe24ApiTokenController@getSingleData')->name('cafe24tokendetail');
  Route::post('/cafe24tokenupdate/{idx}', 'Cafe24ApiTokenController@update')->name('cafe24tokenupdate');

  // 푸쉬 현황
  Route::view('/pushlist', 'pushlist')->name('pushlist.view');
  Route::get('/pushlist/data', 'PushController@getPushListData')->name('pushlist');
  Route::get('/pushdetail/{idx}', 'PushController@getSingleData')->name('pushdetail');
  // 소식 관리
  Route::view('/pushnewslist', 'pushnewslist')->name('pushnewslist.view');
  Route::get('/pushnewslist/data', 'PushNewsController@getPushNewsListData')->name('pushnewslist');
  Route::get('/pushnewsdetail/{idx}', 'PushNewsController@getSingleData')->name('pushnewsdetail');
  Route::post('/pushnewsupdate/{idx}', 'PushNewsController@update')->name('pushnewsupdate');
  // 인증회원 관리
  Route::view('/appspointmemberlist', 'appspointmemberlist')->name('appspointmemberlist.view');
  Route::get('/appspointmemberlist/data', 'AppsPointMemberController@getAppsPointMemberListData')->name('appspointmemberlist');
  Route::get('/appspointmemberdetail/{idx}', 'AppsPointMemberController@getSingleData')->name('appspointmemberdetail');
  // 앱포인트 관리
  Route::view('/appspointlist', 'appspointlist')->name('appspointlist.view');
  Route::get('/appspointlist/data', 'AppsPointController@getAppsPointListData')->name('appspointlist');
  Route::get('/appspointdetail/{idx}', 'AppsPointController@getSingleData')->name('appspointdetail');
  //  테스터 관리
  Route::view('/pushtesterlist', 'pushtesterlist')->name('pushtesterlist.view');
  Route::get('/pushtesterlist/data', 'PushTesterController@getPushTesterListData')->name('pushtesterlist');
  Route::get('/pushtesterdetail/{idx}', 'PushTesterController@getSingleData')->name('pushtesterdetail');
  //  부가서비스 관리
  Route::view('/appendixorderlist', 'appendixorderlist')->name('appendixorderlist.view');
  Route::get('/appendixorderlist/data', 'AppendixOrderController@getAppendixOrderListData')->name('appendixorderlist');
  Route::get('/appendixorderdetail/{idx}', 'AppendixOrderController@getSingleData')->name('appendixorderdetail');
  Route::post('/appendixorderupdate/{idx}', 'AppendixOrderController@update')->name('appendixorderupdate');
  //  MA 이용 업체
  Route::view('/malist', 'malist')->name('malist.view');
  Route::get('/malist/data', 'MAController@getMAListData')->name('malist');
  Route::get('/madetail/{idx}', 'MAController@getSingleData')->name('madetail');
  Route::post('/madetail/{idx}', 'MAController@update')->name('maupdate');
  //  앱 설치 통계
  Route::view('/appsdownstatlist', 'appsdownstatlist')->name('appsdownstatlist.view');
  Route::get('/appsdownstatlist/data', 'AppsDownStatController@getAppsDownStatListData')->name('appsdownstatlist');
  Route::get('/appsdownstatdetail/{idx}', 'AppsDownStatController@getSingleData')->name('appsdownstatdetail');
  //  앱 이용 통계
  Route::view('/appsstatlist', 'appsstatlist')->name('appsstatlist.view');
  Route::get('/appsstatlist/data', 'AppsStatController@getAppsStatListData')->name('appsstatlist');
  Route::get('/appsstatdetail/{idx}', 'AppsStatController@getSingleData')->name('appsstatdetail');
  //  앱 매출 통계
  Route::view('/appssalestatlist', 'appssalestatlist')->name('appssalestatlist.view');
  Route::get('/appssalestatlist/data', 'AppsSaleStatController@getAppsSaleStatListData')->name('appssalestatlist');
  Route::get('/appssalestatdetail/{idx}', 'AppsSaleStatController@getSingleData')->name('appssalestatdetail');
  //  푸쉬 허용 통계
  Route::view('/pushonoffstatlist', 'pushonoffstatlist')->name('pushonoffstatlist.view');
  Route::get('/pushonoffstatlist/data', 'PushOnoffStatController@getPushOnoffStatListData')->name('pushonoffstatlist');
  Route::get('/pushonoffstatstatdetail/{idx}', 'PushOnoffStatController@getSingleData')->name('pushonoffstatdetail');
  //  회원 정보
  Route::view('/userinfolist', 'userinfolist')->name('userinfolist.view');
  Route::get('/userinfolist/data', 'UserInfoController@getUserInfoListData')->name('userinfolist');
  Route::get('/userinfodetail/{idx}', 'UserInfoController@getSingleData')->name('userinfodetail');
  Route::post('/userinfoupdate/{idx}', 'UserInfoController@update')->name('userinfoupdate');
  //  회원 문의
  Route::view('/qnamemberlist', 'qnamemberlist')->name('qnamemberlist.view');
  Route::get('/qnamemberlist/data', 'QnaMemberController@getQnaMemberListData')->name('qnamemberlist');
  Route::get('/qnamemberdetail/{idx}', 'QnaMemberController@getSingleData')->name('qnamemberdetail');
  Route::post('/qnamembercreate/{idx}', 'QnaMemberController@create')->name('qnamembercreate');
  Route::post('/uploadfile', 'QnaMemberController@uploadFilePost');
  //  비회원 문의
  Route::view('/qnanonmemberlist', 'qnanonmemberlist')->name('qnanonmemberlist.view');
  Route::get('/qnanonmemberlist/data', 'QnaNonmemberController@getQnaNonmemberListData')->name('qnanonmemberlist');
  Route::get('/qnanonmemberdetail/{idx}', 'QnaNonmemberController@getSingleData')->name('qnanonmemberdetail');
  Route::post('/qnanonmemberupdate/{idx}', 'QnaNonmemberController@update')->name('qnanonmemberupdate');

  //  리셀러 정보
  Route::view('/resellerinfolist', 'resellerinfolist')->name('resellerinfolist.view');
  Route::get('/resellerinfolist/data', 'ResellerInfoController@getResellerInfoListData')->name('resellerinfolist');
  Route::get('/resellerinfodetail/{idx}', 'ResellerInfoController@getSingleData')->name('resellerinfodetail');
  Route::post('/resellerinfoupdate/{idx}', 'ResellerInfoController@update')->name('resellerinfoupdate');
  Route::post('/resellerinfoupdatememlv', 'ResellerInfoController@updateMemlv')->name('updatememlv');

  //  리셀러 정산
  Route::view('/resellerpaymentlist', 'resellerpaymentlist')->name('resellerpaymentlist.view');
  Route::get('/resellerpaymentlist/data', 'ResellerPaymentController@getResellerPaymentListData')->name('resellerpaymentlist');
  Route::get('/resellerpaymentdetail/{idx}', 'ResellerPaymentController@getSingleData')->name('resellerpaymentdetail');

  // 사이드바 댓글
  Route::post('/comment','CommentController')->name('comment');
  Route::post('/commentSend','CommentController@send')->name('commentsend');

  // 사이드바 검색
  Route::post('/side_search', 'SearchContorller@sideSearch')->name('side-search');

  //사이드바 회원정보
  Route::get('/user/{mem_id}',function($mem_id){
    return view('partials.aside_user_info',['mem_id'=>$mem_id]);
  });

  //관리자 관리
  Route::get('/admin','Admin')->name('admin');
  Route::post('/adminupdate','Admin@update')->name('adminupdate');


});
