<?php

namespace App\Models;

class LookUpModel extends SuperModel
{

    protected $table = 'lookup';
    public $timestamps = false;
    protected $primaryKey = 'idd';
    protected $fillable = ['value'];

    public static function getLookUp($lookUp_key,$lang="0")
    {
        if($lang=="0") {
            $result = ['0' => 'Select ' . $lookUp_key . '..'] + self::select('*')
                    ->where('lookup.lookUp_key', $lookUp_key)->lists('lookUp', 'id')->toArray();;
        }
        else{
            $result = ['0' => 'Select ' . $lookUp_key . '..'] + self::select('*')
                    ->where('lookup.lookUp_key', $lookUp_key)->lists('lookUp_ar', 'id')->toArray();;
        }
        return $result;
    }
    public static function getAllLookUp($lookUp_key)
    {
        $result = self::select('*')
                ->where ('lookup.lookUp_key',$lookUp_key)->get();;
        return $result;
    }

    /**
     * @param $id
     * @return string
     */
    public static function getLookUpName($id,$lang="0")
    {
        try {
            if($lang=="0")
            $result = self::select('*')
                ->where('id', $id)->get()->first()->lookUp;
            else
                $result = self::select('*')
                    ->where('id', $id)->get()->first()->lookUp_ar;
            return $result;
        } catch (\Exception $ex) {
            return 'Not Known';
        }
    }
    public static function getLookUpID($name)
    {
        try {
            $result = self::select('*')
                ->where('name','like','%'.$name.'%')->get()->first()->lookUp;
            return $result;
        } catch (\Exception $ex) {
            return 'Not Known';
        }
    }


    public static function getLookUpList(Array $filters = [],$status=0,$lookUp_key=0)
    {
        $result = self::select(["lookup.*"]);



        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('lookUp', 'like', "%" . $filters['key'] . "%");
        }
        if ($status != 0)
        {
            if ($status == "1")
                $result->where('lookup.active', 1);
            else
                $result->where('lookup.active', '<>', 1);
        }
        if (strlen($lookUp_key)>1)
        {

            $result->where('lookup.lookUp_key',$lookUp_key);

        }
        $result = $result->whereNull('lookup.deleted_at');
        return $result;
    }
    public static function getLookUp_keys()
    {
        $result = self::select('lookup.lookUp_key as lookUp_key')
            ->where ('lookup.active',1)->lists('lookUp_key','lookUp_key')->groupBy('lookUp_key')->toArray();
        return $result;
    }


}
