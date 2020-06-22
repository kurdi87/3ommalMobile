<?php

namespace App\Models;

class TypesModel extends SuperModel
{

    protected $table = 'optimum_types';
    public $timestamps = false;
    protected $primaryKey = 'idd';
    protected $fillable = ['value'];

    public static function getTypes($module,$lang="0",$json=0)
    {
        if($json==0) {
            if ($lang == "0") {
                $result = [null => 'Select ' . $module . '..'] + self::select('*')
                        ->where('optimum_types.module', $module)->where('optimum_types.active', '1')->lists('type', 'id')->toArray();;
            } else {
                $result = [null => 'Select ' . $module . '..'] + self::select('*')
                        ->where('optimum_types.module', $module)->where('optimum_types.active', '1')->lists('type_ar', 'id')->toArray();;
            }
        } else{
            if ($lang == "0") {
                $result =  self::select('type', 'id','category')
                    ->where('optimum_types.module', $module)->where('optimum_types.active', '1')->get();;
            } else {
                $result =self::select('type_ar as type', 'id','category')
                    ->where('optimum_types.module', $module)->where('optimum_types.active', '1')->get();;
            }
        }
        return $result;

    }
    public static function getTypes2($module,$lang="0",$json=0)
    {
        if($json==0) {
            if ($lang == "0") {
                $result = [null => 'Select ' . $module . '..'] + self::select('*')
                        ->where('optimum_types.module', $module)->where('optimum_types.active', '1')->lists('type', 'type')->toArray();;
            } else {
                $result = [null => 'Select ' . $module . '..'] + self::select('*')
                        ->where('optimum_types.module', $module)->where('optimum_types.active', '1')->lists('type_ar', 'type_ar')->toArray();;
            }
        } else{
            if ($lang == "0") {
                $result =  self::select('type', 'id')
                    ->where('optimum_types.module', $module)->where('optimum_types.active', '1')->get();;
            } else {
                $result =self::select('type_ar as type', 'id')
                    ->where('optimum_types.module', $module)->where('optimum_types.active', '1')->get();;
            }
        }
        return $result;

    }
    public static function getAllTypes($module)
    {
        $result = self::select('*')
            ->where ('optimum_types.module',$module) ->where('optimum_types.active', '1')->get();;
        return $result;
    }
    public static function getTypeColor($id)
    {
        try {
            $result = self::select('*')
                ->where('id', $id) ->where('optimum_types.active', '1')->get()->first()->color;
            return $result;
        } catch (\Exception $ex) {
            return 'label-info';
        }
    }

    /**
     * @param $id
     * @return string
     */
    public static function getTypeName($id,$lang="0")
    {
        try {
            if($lang=="0")
                $result = self::select('*')
                    ->where('optimum_types.active', '1')->where('id', $id)->get()->first()->type;
            else
                $result = self::select('*')
                    ->where('id', $id) ->where('optimum_types.active', '1')->get()->first()->type_ar;
            return $result;
        } catch (\Exception $ex) {
            return 'Not Known';
        }
    }
    public static function getTypeID($name)
    {
        try {
            $result = self::select('*')
                ->where('name','like','%'.$name.'%')->get()->first()->type;
            return $result;
        } catch (\Exception $ex) {
            return 'Not Known';
        }
    }

    public static function TypeINOutPatient($id)
    {
        if (in_array($id, [30,31,32]))
        {
            return "In Patient";
        }
        else
        {
            return "Out Patient";
        }


    }

    public static function getTypesList(Array $filters = [],$status=0,$module=0)
    {
        $result = self::select(["optimum_types.*"]);



        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('type', 'like', "%" . $filters['key'] . "%");
        }
        if ($status != 0)
        {
            if ($status == "1")
                $result->where('optimum_types.active', 1);
            else
                $result->where('optimum_types.active', '<>', 1);
        }
        if (strlen($module)>1)
        {

            $result->where('optimum_types.module',$module);

        }
        $result = $result->whereNull('optimum_types.deleted_at');
        return $result;
    }
    public static function getModules()
    {
        $result = self::select('optimum_types.module as module')
            ->where ('optimum_types.active',1)->lists('module','module')->groupBy('module')->toArray();
        return $result;
    }


}
