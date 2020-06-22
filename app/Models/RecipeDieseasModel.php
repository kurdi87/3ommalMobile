<?php

namespace App\Models;

class RecipeDieseasModel extends SuperModel
{

    protected $table = 'recipe_dieseas';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];


    public static function getDieseasByRecipe($id)
    {
        $result = self::select('recipe_dieseas.active as active','recipe_dieseas.id as id','recipe_dieseas.dieseas_id as dieseas_id','speciality_dieseas.name as name','speciality_dieseas.type as type','recipe_dieseas.notes',"optimum_types.type as dtype")
            ->leftJoin('speciality_dieseas', 'recipe_dieseas.dieseas_id', '=', 'speciality_dieseas.id')
            ->leftJoin('optimum_types', 'speciality_dieseas.type', '=', 'optimum_types.id')

            ->where('recipe_dieseas.recipe_id',$id)
            ->where('speciality_dieseas.active',1)
            ->where('recipe_dieseas.active',1);

        $result = $result->get();

        return $result;
    }
    public static function getDieseasByRecipe2($id)
    {
        $result = self::select('recipe_dieseas.active as active','recipe_dieseas.id as id','recipe_dieseas.dieseas_id as dieseas_id','speciality_dieseas.name as name','speciality_dieseas.type as type','recipe_dieseas.notes')
            ->leftJoin('speciality_dieseas', 'recipe_dieseas.dieseas_id', '=', 'speciality_dieseas.id')

            ->where('recipe_dieseas.recipe_id',$id)
            ->where('recipe_dieseas.active',1);



        return $result;
    }


}
