<?php

namespace App\Models;

class RecipeAdvModel extends SuperModel
{

    protected $table = 'recipe_adv';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

    public static function getrecipeAdv(Array $recipes = [])
    {
    	$result = self::select('*')
            ->whereIn('recipe_id',$recipes)
    	->where('recipe_adv.active',1);
           
        
   

        return $result->get();
    }
    public static function getrecipeAdvone($id)
    {
        $result = self::select('*')
            ->where('recipe_id',$id)
            ->where('recipe_adv.active',1);




        return $result->get();
    }

    }


