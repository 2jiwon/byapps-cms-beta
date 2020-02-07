<?php

namespace App;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use DB;
use Illuminate\Database\Eloquent\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class AppsPaymentData extends Model implements Searchable
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_payment_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;
  protected $fillable = [ 'idx', 'mem_id', 'order_id', 'recom_id', 'process', 'pay_type',
    'apps_type', 'app_name', 'term', 'start_time', 'end_time', 'amount', 'payment',
    'receipt', 'promotion', 'reg_time'
  ];

  public static function getPaymentData()
  {
      $paymentData = DB::connection($connection)->table($table)->get();

      return $paymentData;
  }

  public function __construct()
  {
      parent::__construct(['app_name']);
  }

  public function getSearchResult(): SearchResult
  {
    $url = route('appspaydetail', $this->idx);
    //$sortBy = 'reg_time desc';

    $data = new SearchResult($this, $this->app_name, $url, $this->reg_time);

    return $data;
  }

  public function userinfo()
  {
    return $this->belongsTo('App\UserInfo', 'mem_id');
  }

  public function resellerinfo()
  {
    return $this->belongsTo('App\ResellerInfo', 'recom_id', 'mem_id');
  }
}
