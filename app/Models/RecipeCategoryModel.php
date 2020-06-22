<?php
namespace App\Models;


class RecipeCategoryModel extends SuperModel
{

    protected $table = 'recipe_category';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];




    public static function getCategoryByRecipe($id)
    {
        $result = self::select('default_category.name as name','recipe_category.active as active','recipe_category.id as id','default_category.type as type','fee','recipe_category.category_id as pro_id','default_category.isroot as isroot','default_category.parent_id as parent_id')
            ->leftJoin('default_category', 'default_category.id', '=', 'recipe_category.category_id')
            ->where('recipe_category.recipe_id',$id)
            ->where('default_category.active',1)
            ->where('recipe_category.active',1);

        $result = $result->get();

        return $result;
    }

       public static function getCategoryInfo($id)
    {
        $result = self::select('default_category.name as name','recipe_category.active as active','recipe_category.id as id','default_category.type as type','fee','recipe_category.category_id as pro_id','recipe_category.about_category as about_category')
            ->leftJoin('default_category', 'default_category.id', '=', 'recipe_category.category_id')
            ->where('recipe_category.id',$id);

        $result = $result->where('recipe_category.active', 1);
        $result = $result->get();

        return $result;
    }


    public static function getTCategoryByRecipe($id)
    {
        $result = self::select('default_category.name as name','recipe_category.active as active','recipe_category.id as id','default_category.type as type','fee','recipe_category.category_id as pro_id','default_category.isroot as isroot','default_category.parent_id as parent_id')
            ->leftJoin('default_category', 'default_category.id', '=', 'recipe_category.category_id')
            ->where('recipe_category.recipe_id',$id)
                 ->where('recipe_category.active','1')
            ->where('default_category.type','2');
        
        $result = $result->get();

        return $result;
    }


    public static function getICategoryByRecipe($id)
    {
        $result = self::select('default_category.name as name','recipe_category.active as active','recipe_category.id as id','default_category.type as type','fee','recipe_category.category_id as pro_id','default_category.isroot as isroot','default_category.parent_id as parent_id')
            ->leftJoin('default_category', 'default_category.id', '=', 'recipe_category.category_id')
            ->where('recipe_category.recipe_id',$id)
            ->where('recipe_category.active','1')
            ->where('default_category.type','1');
        
        $result = $result->get();

        return $result;
    }
   

   

}





 