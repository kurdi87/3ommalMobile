<?php

namespace App\Models;

class CategoryModel extends SuperModel
{

    public $timestamps = false;
    protected $table = 'default_category';
    protected $primaryKey = 'id';
    protected $fillable = ['value'];


    public static function getCategoryList(Array $filters = [],$type,$cost_from,$cost_to,$parent_id,$ptype=0,$disease=0,$source=0,$active=-1)
    {
        $result = self::select(["default_category.*", "languages.language"])
            ->leftJoin('languages', 'languages.id', '=', 'lang');


        $result->whereNull('default_category.deleted_at');
        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('default_category.name', 'like', "%" . $filters['key'] . "%");
        }
        if ($source) {
            $result = $result->where('default_category.source', 'like', "%" . $source . "%");
        }
        if($type>0)
        {
            if($type==1)
                $result = $result->where('default_category.parent_id',0);
            else
                $result = $result->where('default_category.parent_id','<>',0);
        }
        if($ptype>0)
        {
            if($ptype==1)
                $result = $result->where('default_category.type',1);
            else
                $result = $result->where('default_category.type','=',2);
        }
        if($active!=-1)
        {

                $result = $result->where('default_category.active',$active);

        }



        if ($cost_from>0)
        {
            $result = $result->where('default_category.cost_from','>=', $cost_from);

        }

        if ($cost_to>0)
        {
            $result = $result->where('default_category.cost_to','<=',$cost_to);

        }
        if ($parent_id>0)
        {
            $result = $result->where('default_category.parent_id',$parent_id);
        }
        if ($disease!=0)
        {
            $result = $result->where('default_category.disease_id',$disease);
        }



        return $result;
    }

    public static function getCategoryAll($id)
    {
        $result = self::select(["default_category.*", "languages.language"])
            ->leftJoin('languages', 'languages.id', '=', 'lang')
            ->where('isroot', 1)
            ->where('default_category.id', '<>', $id)
            ->orwhere('parent_id', 0);


        return $result;
    }

    public static function getCategoryAlllist()
    {
        $result = self::select(["default_category.*", "languages.language"])
            ->leftJoin('languages', 'languages.id', '=', 'lang')
            ->where('isroot', 1)
            ->orwhere('parent_id', 0)->lists('name','name')->toArray();


        return $result;
    }

    public static function getSubCategorys($parent_id,$search='%')
    {
        $result = self::select(["default_category.*"])
            ->where('parent_id', $parent_id)
            ->where('name','like','%'.$search.'%')
            ->where('active', '1');

        return $result;
    }




    public static function getCategoryID($name)
    {
        try {
            $result = self::select(["default_category.id"])
                ->where('default_category.name', $name);
            $result = $result->first()->id;

        } catch (\Exception $e) {
            $result = "-1";
        }

        return $result;
    }

    public static function getCategoryName($id)
    {
        try {
            $result = self::select(["default_category.name"])
                ->where('default_category.id', $id);
            $result = $result->first()->name;

        } catch (\Exception $e) {
            $result = "NA";
        }

        return $result;
    }


}
