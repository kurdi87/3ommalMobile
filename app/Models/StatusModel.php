<?php

namespace App\Models;

class StatusModel extends SuperModel
{

    public $timestamps = false;
    protected $table = 'optimum_status';
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

    public static function getTypes($module)
    {
        $result = ['0' => 'Select..'] + self::select('*')
                ->where('optimum_status.module', $module)->lists('status', 'id')->toArray();;
        return $result;
    }

    public static function getStatusName($id,$lang=0)
    {
        try {
            if($lang=="0")
                $result = self::select('*')
                    ->where('id', $id)->get()->first()->status;
            else
                $result = self::select('*')
                    ->where('id', $id)->get()->first()->status_ar;
            return $result;
        } catch (\Exception $ex) {
            return 'NA';
        }
    }
    public static function getStatus($module,$lang="0",$json=0)
    {
        if($json==0) {
            if ($lang == "0") {
                $result = [0 => 'Select Status..'] + self::select('*')
                        ->where($module, '1')->lists('status', 'id')->toArray();;
                return $result;
            } else {
                $result = [0 => 'Select Status..'] + self::select('*')
                        ->where($module, '1')->lists('status_ar', 'id')->toArray();;
                return $result;
            }
        }
        else{
            if ($lang == "0") {
                $result =  self::select( 'id','status as status')
                    ->where($module, '1')->get()->toJson();
                return $result;
            } else {
                $result = self::select( 'id','status_ar as status')
                    ->where($module, '1')->get()->toJson();
                return $result;
            }
        }
        return $result;

    }


    public static function getStatusColor($id)
    {
        try {
            $result = self::select('*')
                ->where('id', $id)->get()->first()->color;
            return $result;
        } catch (\Exception $ex) {
            return '';
        }
    }

}
