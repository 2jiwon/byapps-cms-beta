<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicePointData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_service_point_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getServicePointData()
  {
      $servicePointData = DB::connection($connection)
                            ->table($table)->get();

      return $servicePointData;
  }

}
