<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetakuData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_retaku_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getRetakuData()
  {
      $resellerInfoData = DB::connection($connection)
                            ->table($table)->get();

      return $resellerInfoData;
  }

  public function payments()
  {
    return $this->hasMany('App\AppsPaymentData', 'mem_id', 'mem_id');
  }
}
