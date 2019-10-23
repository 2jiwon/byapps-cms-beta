<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// 결제 관리
Breadcrumbs::for('paylist', function ($trail) {
    $trail->push('결제 관리', route('paylist.view'));
});

// 결제 관리 > 결제 상세
Breadcrumbs::for('paydetail', function ($trail) {
    $trail->parent('paylist');
    $trail->push('결제 상세', route('paylist'));
});

// 결제 관리 > 프로모션
Breadcrumbs::for('promolist', function ($trail) {
    $trail->parent('paylist');
    $trail->push('프로모션', route('promolist.view'));
});

// 결제 관리 > 프로모션 > 프로모션 상세
Breadcrumbs::for('promodetail', function ($trail) {
    $trail->parent('promolist');
    $trail->push('프로모션 상세', route('promolist'));
});

// 앱 관리(앱 목록)
Breadcrumbs::for('appslist', function ($trail) {
  $trail->push('앱 관리', route('appslist.view'));
});

// 앱 접수
Breadcrumbs::for('appsorderlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('앱 접수', route('appsorderlist.view'));
});

// 업데이트 관리
Breadcrumbs::for('appsupdatelist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('업데이트 관리', route('appsupdatelist.view'));
});

// APK 관리
Breadcrumbs::for('apklist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('APK 관리', route('apklist.view'));
});

// Push 현황
Breadcrumbs::for('pushlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('PUSH 현황', route('pushlist.view'));
});

// 소식 관리
Breadcrumbs::for('pushnewslist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('소식 관리', route('pushnewslist.view'));
});

// 인증회원 관리
Breadcrumbs::for('appspointmemberlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('인증회원 관리', route('appspointmemberlist.view'));
});

// 앱포인트 관리
Breadcrumbs::for('appspointlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('앱포인트 관리', route('appspointlist.view'));
});

// 테스터 관리
Breadcrumbs::for('pushtesterlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('테스터 관리', route('pushtesterlist.view'));
});

// 부가서비스
Breadcrumbs::for('appendixlist', function ($trail) {
  $trail->push('부가서비스', route('appendixorderlist.view'));
});

// 부가서비스 접수
Breadcrumbs::for('appendixorderlist', function ($trail) {
  $trail->parent('appendixlist');
  $trail->push('부가서비스 접수', route('appendixorderlist.view'));
});

// MA 이용 업체
Breadcrumbs::for('malist', function ($trail) {
  $trail->parent('appendixlist');
  $trail->push('MA 이용 업체', route('malist.view'));
});

// 통계
Breadcrumbs::for('statlist', function ($trail) {
  $trail->push('통계', route('appsdownstatlist.view'));
});

// 앱 설치 통계
Breadcrumbs::for('appsdownstatlist', function ($trail) {
  $trail->parent('statlist');
  $trail->push('앱 설치 통계', route('appsdownstatlist.view'));
});

// 앱 이용 통계
Breadcrumbs::for('appsstatlist', function ($trail) {
  $trail->parent('statlist');
  $trail->push('앱 이용 통계', route('appsstatlist.view'));
});

// 앱 매출 통계
Breadcrumbs::for('appssalestatlist', function ($trail) {
  $trail->parent('statlist');
  $trail->push('앱 매출 통계', route('appssalestatlist.view'));
});
