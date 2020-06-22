<?php
namespace App\Models;


class RecipePhotoModel extends SuperModel
{

    protected $table = 'recipe_photo';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

  


    public static function getPhotosByRecipe($id)
    {
        $result = self::select('*')
          
            ->where('active','1')
             ->where('recipe_id',$id);
        
        $result = $result->get();

        return $result;
    }

       
   

   

}





 