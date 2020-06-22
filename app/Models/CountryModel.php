<?php

namespace App\Models;

class CountryModel extends SuperModel
{
    protected $table = 'country_sql';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

    /**
     * @param $country
     */
    public static function getCountryID($country)
    {
        try {
            $result = self::select(["country_sql.id"])
                ->where('name_ar', $country);

            $result = $result->first()->id;

        } catch (\Exception $e) {
            $result = "-1";
        }

        return $result;
    }
    public static function getCountryList(Array $filters = [])
    {
        $result = self::select(["country_sql.*"]);


        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('name_en', 'like', "%" . $filters['key'] . "%");
        }
        $result = $result->whereNull('country_sql.deleted_at');
        return $result;

    }
    public static function getActiveCountry($lang)
    {
            $result = self::select(["country_sql.id","Code2","name_ar","img"])
                ->where('country_active',1);

        return $result;
    }
    public static function getCountryName($id)
    {
        try {
            $result = self::select('*')
                ->where('id', $id)->get()->first()->name_en;
            return $result;
        } catch (\Exception $ex) {
            return 'NA';
        }
    }
    public static function countAll()
    {
        $result = self::select(["country_sql.id","Code2","name_ar as name_en","img"])
            ->wherein('id', RecipeModel::where("active", "1")->lists('country'));

        return count($result->get());
    }
    public static function getlist()
    {
        $result = ['0' => 'Select Country'] + self::lists('name_en','id')->toArray();
        return $result;
    }

}