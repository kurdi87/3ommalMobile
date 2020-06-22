<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class RecipeModel extends SuperModel
{

    protected $table = 'recipe';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

    public static function getRecipes()
    {
        $result = self::select('recipe.id as id', 'recipe.name as name', 'rate', 'information', 'recipe.icon', 'country_sql.name_en as country', 'Code2', 'recipe.active', 'lang', 'ismain', 'h_order',
            'country_sql.name_ar as country_ar', 'country_sql.name_ru as country_ru', 'telephone', 'fax', 'web_address', 'email', 'overview', 'city', 'address', 'map_address', 'map_link')
            ->leftJoin('country_sql', 'country_sql.id', '=', 'recipe.country');

        // $result = $result->get();

        return $result;
    }

    public static function getRecipesMain()
    {
        $result = self::select('recipe.id as id', 'recipe.name as name', 'rate', 'information', 'recipe.icon', 'country_sql.name_en as country', 'Code2', 'recipe.active', 'lang', 'ismain', 'h_order',
            'country_sql.name_ar as country_ar', 'country_sql.name_ru as country_ru', 'telephone', 'fax', 'web_address', 'email', 'overview', 'city', 'address', 'map_address', 'map_link')
            ->leftJoin('country_sql', 'country_sql.id', '=', 'recipe.country')
            ->wherein('recipe.id', DoctorRecipeModel::where('active', 1)->lists('recipe_id')->toArray())
            ->wherein('recipe.id', RecipeCategoryModel::where('active', 1)->lists('recipe_id')->toArray());
        // $result = $result->get();

        return $result;
    }

    public static function getAllRecipes($offset, $limit, $order, $lang = 0)
    {
        $result = self::select('recipe.id as id', 'recipe.name as name', 'rate', 'information', 'recipe.icon', 'country_sql.name_en as country', 'country_sql.name_ar as country_ar', 'recipe.city', 'recipe.map_address', 'recipe.address', 'map_link')
            ->leftJoin('country_sql', 'country_sql.id', '=', 'recipe.country')
            ->where('recipe.active', '1')
            ->limit($limit)->offset($offset - 1)
            ->orderby($order, 'asc');

        $result = $result->get();

        return $result;
    }

    public static function countAll($type = 0)
    {
        $result = self::select('recipe.id')
            ->where('recipe.active', '1');
        if ($type != 0) {
            $result = $result->where('recipe.type', $type);
        }

        $result = $result->get();
        return count($result);
    }

    public static function countAllCountry($lang, $country)
    {
        $result = self::select('recipe.id')
            ->where('recipe.active', '1')
            ->where('recipe.country', $country);

        $result = $result->get();

        return count($result->all());
    }

    public static function countAllDoctorCountry($lang, $country)
    {
        $result = self::select('recipe.id')
            ->where('recipe.active', '1')
            ->where('recipe.country', $country);

        $result = $result->get();
        $count = 0;
        foreach ($result->all() as $hos) {
            $count = $count + count(DoctorModel::getDoctorsbyRecipe($hos->id));

        }

        return $count;
    }


    public static function getRecipeList(Array $filters = [], $country = 0, $type = 0, $active = -1)
    {
        $result = self::select('recipe.*',
            'country_sql.name_ar as country_ar')
            ->leftJoin('languages', 'languages.id', '=', 'lang')
            ->leftJoin('optimum_types', 'optimum_types.id', '=', 'recipe.type')
            ->leftJoin('country_sql', 'country_sql.id', '=', 'recipe.country');


        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('name', 'like', "%" . $filters['key'] . "%");
        }
        if ($country > 0) {
            $result->where('recipe.country', $country);
        }
        if ($type > 0) {
            $result->where('recipe.type', $type);
        }
        if ($active != -1) {

            $result = $result->where('recipe.active', $active);

        }
        $result = $result->whereNull('recipe.deleted_at');
        return $result;
    }

    public static function countbycity($cid, $type = 0)
    {
        $result = self::select('recipe.id')
            ->where('recipe.active', '1')
            ->where('recipe.country', $cid);
        if ($type > 0) {
            $result = $result->where("recipe.type", $type);
        }
        $result = $result->get();

        return count($result);
    }

    public static function getRecipesbyDeptCounryProcedure($disease, $offset, $limit, $order, $country, $type, $procedure, $department)
    {

        $result = self::select('recipe.*', 'country_sql.name_ar as country_name')
            ->leftJoin('recipe_department', 'recipe_department.recipe_id', '=', 'recipe.id')
            ->leftJoin('doctor_info', 'doctor_info.id', '=', 'recipe_department.head_id')
            ->leftJoin('optimum_types', 'recipe.type', '=', 'optimum_types.id')
            ->leftJoin('recipe_procedure', 'recipe_procedure.recipe_id', '=', 'recipe_department.recipe_id')
            ->leftJoin('default_procedure', 'recipe_procedure.procedure_id', '=', 'default_procedure.id')
            ->leftJoin('department', 'department.id', '=', 'recipe_department.department_id')
            ->leftJoin('country_sql', 'country_sql.id', '=', 'recipe.country')
            ->where('recipe.active', 1);

        if (isset($country) && $country != "0" && $country != "جميع المدن" && $country != "") {
            $result = $result->where(function ($query) use ($country) {
                $a = explode(",", $country);
                for ($i = 0; $i < count($a); $i++) {
                    if ($i == 0)
                        $query->orwhere('recipe.country', 'like', CountryModel::getCountryID($a[$i]));
                    else
                        $query = $query->orwhere('recipe.country', CountryModel::getCountryID($a[$i]));
                }
            });
        }
        if (isset($procedure) && $procedure != "0" && $procedure != "") {
            $result = $result->where(function ($query) use ($procedure) {
                $a = explode(",", $procedure);
                for ($i = 0; $i < count($a); $i++) {
                    if ($i == 0)
                        $query->orwhere('recipe_procedure.procedure_id', ProcedureModel::getProcedureID($a[$i]));
                    else
                        $query = $query->orwhere('recipe_procedure.procedure_id', ProcedureModel::getProcedureID($a[$i]));
                }
            });
        }
        if (isset($department) && $department != "0" && $department != "") {
            $result = $result->where(function ($query) use ($department) {
                $a = explode(",", $department);
                for ($i = 0; $i < count($a); $i++) {

                    if ($i == 0)
                        $query->where('department.name', $a[$i]);
                    else
                        $query = $query->orwhere('department.name', $a[$i]);
                }
            });
        }


        if (isset($disease) && $disease != "0" && $disease != "") {
            $result = $result->where(function ($query) use ($disease) {
                $query->where(DB::raw("REPLACE(recipe_department.keywords, ' ', '')"), 'like', '%' . str_replace(' ', '', $disease) . '%')
                    ->orwhere(DB::raw("REPLACE(department.name, ' ', '')"), 'like', '%' . str_replace(' ', '', $disease) . '%')
                    ->orwhere(DB::raw("REPLACE(recipe.name, ' ', '')"), 'like', '%' . str_replace(' ', '', $disease) . '%')
                    ->orwhere(DB::raw("REPLACE(doctor_info.name, ' ', '')"), 'like', '%' . str_replace(' ', '', $disease) . '%')
                    ->orwhere(DB::raw("REPLACE(default_procedure.name, ' ', '')"), 'like', '%' . str_replace(' ', '', $disease) . '%');
            });
        }

        if (isset($type) && $type != "0" && $type != "") {
            $result = $result->where(function ($query) use ($type) {
                $a = explode(",", $type);
                for ($i = 0; $i < count($a); $i++) {
                    if ($i == 0)
                        $query->orwhere('optimum_types.type', $a[$i]);

                    else
                        $query = $query->orwhere('optimum_types.type', $a[$i]);
                }
            });
        }

        $result = $result->groupby('recipe.id');
        $result = $result->orderby($order);
        return $result->paginate(10, $columns = ['*'], 'page', $offset);
    }

    public static function getRecipeName($id)
    {
        try {
            if ($id == 0)
                5 / 0;
            $result = self::select('*')
                ->where('id', $id)->get()->first()->name;
            return $result;
        } catch (\Exception $ex) {
            return 'NA';
        }
    }


}
