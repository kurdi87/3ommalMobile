<?php
namespace App\Models;


class RecipeDepartmentModel extends SuperModel
{

    protected $table = 'recipe_department';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

    

      public static function getRecipesbyDept($disease,$offset,$limit,$order,$lang)
    {
        $result = self::select('recipe.id as id','recipe.name as name','recipe.rate','information','recipe.icon','country.name_en as country','country.name_ar as country_ar','recipe.city','recipe.map_address','recipe.address','doctor_info.name as head','doctor_info.id as head_id','doctor_info.rate as d_rate','doctor_info.speciality as d_speciality','doctor_info.title as d_title','doctor_info.d_image as d_image','department.name as dept_name','recipe_department.about_department as dept_info')
       
            ->leftJoin('recipe', 'recipe.id', '=', 'recipe_department.recipe_id')
  ->leftJoin('doctor_info', 'doctor_info.id', '=', 'recipe_department.head_id')
            ->leftJoin('department', 'department.id', '=', 'recipe_department.department_id')
            ->leftJoin('country', 'country.id', '=', 'recipe.country')
            ->where('recipe_department.keywords','like','%'.$disease.'%')
             ->where('recipe_department.active',1)
             ->where('recipe.active',1)
              ->where('recipe.lang',$lang)

            ->limit($limit)->offset($offset-1)
            ->orderby($order,'asc');
            
        $result = $result->get();

        return $result;
    }

    public static function countgetRecipesbyDept($disease,$lang)
    {
        $result = self::select('recipe.id as id','recipe.name as name','recipe.rate','information','recipe.icon','country.name_en as country','country.name_ar as country_ar','recipe.city','recipe.map_address','recipe.address','doctor_info.name as head','doctor_info.id as head_id','doctor_info.rate as d_rate','doctor_info.speciality as d_speciality','doctor_info.title as d_title','doctor_info.d_image as d_image','department.name as dept_name','recipe_department.about_department as dept_info')

            ->leftJoin('recipe', 'recipe.id', '=', 'recipe_department.recipe_id')
            ->leftJoin('doctor_info', 'doctor_info.id', '=', 'recipe_department.head_id')
            ->leftJoin('department', 'department.id', '=', 'recipe_department.department_id')
            ->leftJoin('country', 'country.id', '=', 'recipe.country')
            ->where('recipe_department.keywords','like','%'.$disease.'%')
            ->where('recipe_department.active',1)
            ->where('recipe.active',1)
            ->where('recipe.lang',$lang);


        $result = count($result->get());

        return $result;
    }




    public static function countAllCountry($lang,$country)
    {
        $result = self::select('recipe.country')
            ->leftJoin('recipe', 'recipe.id', '=', 'recipe_department.recipe_id')



            ->leftJoin('department', 'department.id', '=', 'recipe_department.department_id')
            ->leftJoin('country_sql', 'country_sql.id', '=', 'recipe.country')
            ->where('recipe_department.active',1)
            ->where('recipe.active',1)
            ->where('recipe.lang',$lang)
        ->where('recipe.country',$country);

        return count($result->get()->all());
    }


        public static function getAboutDept($id)
    {
        $result = self::select('recipe.id as id','recipe.name as name','recipe.rate','information','recipe.icon','country.name_en as country','country.name_ar as country_ar','recipe.city','recipe.map_address','recipe.address','doctor_info.name as head','doctor_info.id as head_id','doctor_info.rate as d_rate','doctor_info.speciality as d_speciality','doctor_info.title as d_title','doctor_info.d_image as d_image','department.name as dept_name','recipe_department.about_department as dept_info')
       
            ->leftJoin('recipe', 'recipe.id', '=', 'recipe_department.recipe_id')
  ->leftJoin('doctor_info', function($join) {
      $join->on('doctor_info.id', '=', 'recipe_department.head_id')->where('doctor_info.active', '=', 1);
    })


    

            ->leftJoin('department', 'department.id', '=', 'recipe_department.department_id')
            ->leftJoin('country', 'country.id', '=', 'recipe.country')
            ->where('recipe_department.id',$id)
               ->where('recipe_department.active',1)
             ->where('recipe.active',1);

             

           
       
            
        $result = $result->get();

        return $result;
    }




    public static function getDeptByRecipe($id)
    {
        $result = self::select('department.name as name','icon','recipe_department.active as active','recipe_department.id as id','recipe_department.keywords as keywords','doctor_info.name as head','doctor_info.id as head_id','doctor_info.rate as d_rate','doctor_info.speciality as d_speciality','doctor_info.d_image as d_image','recipe_department.department_id as dept_id')
            ->leftJoin('department', 'department.id', '=', 'recipe_department.department_id')
             ->leftJoin('doctor_info', 'doctor_info.id', '=', 'recipe_department.head_id')
            ->where('recipe_department.recipe_id',$id)
            ->where('recipe_department.active','1');
        
        $result = $result->get();

        return $result;
    }
    public static function getDepartmentByRecipe($id)
    {
        $result = self::select('department.*')
            ->leftJoin('department', 'department.id', '=', 'recipe_department.department_id')
            ->where('recipe_department.recipe_id',$id)
            ->where('recipe_department.active',1);



        return $result;
    }
   

   

}





 