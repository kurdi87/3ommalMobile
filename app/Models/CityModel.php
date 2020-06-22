<?php

namespace App\Models;

class CityModel extends SuperModel
{
    protected $table = 'city';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

    /**
     * @param $city
     */
    public static function getCityID($city)
    {
        try {
            $result = self::select(["city.id"])
                ->where('name_ar', $city);

            $result = $result->first()->id;

        } catch (\Exception $e) {
            $result = "-1";
        }

        return $result;
    }

    public static function getCityList(Array $filters = [], $country)
    {
        $result = self::select(["city.*"]);

        if ($country > 0) {
            $result->where('city.country_id', $country);
        }
        if (isset($filters['key']) && $filters['key']) {
            $result->where(function ($query) use ($filters) {
                $query->where('name_en', 'like', "%" . $filters['key'] . "%")->orwhere('name_ar', 'like', "%" . $filters['key'] . "%");
            });

        }
        $result = $result->whereNull('city.deleted_at');
        return $result;

    }

    public static function getActiveCity($lang)
    {
        $result = self::select(["city.id", "Code2", "name_ar", "img"])
            ->where('city_active', 1);

        return $result;
    }

    public static function getCityName($id, $lang = 0)
    {
        try {
            if ($lang == 0)
                $result = self::select('*')
                    ->where('id', $id)->get()->first()->name_en;
            else
                $result = self::select('*')
                    ->where('id', $id)->get()->first()->name_ar;
            return $result;
        } catch (\Exception $ex) {
            return 'NA';
        }
    }

    public static function getRegion($id)
    {
        try {
            $result = self::select('*')
                ->where('id', $id)->get()->first()->region;
            return $result;
        } catch (\Exception $ex) {
            return '0';
        }
    }

    public static function countAll()
    {
        $result = self::select(["city.id", "Code2", "name_ar as name_en", "img"])
            ->wherein('id', RecipeModel::where("active", "1")->lists('city'));

        return count($result->get());
    }

    public static function getlist($lang = 0)
    {
        if ($lang == 0)
            $result = [null => 'Select City'] + self::where('city_active', 1)->lists('name_en', 'id')->toArray();
        else
            $result = [null => 'Select City'] + self::where('city_active', 1)->lists('name_ar', 'id')->toArray();
        return $result;
    }

    public static function getlistProv($lang = 0)
    {
        if ($lang == 0)
            $result = ['0' => 'Select Prov'] + self::where('type', '1')->where('city_active', 1)->lists('name_en', 'id')->toArray();
        else
            $result = ['0' => 'Select Prov'] + self::where('type', '1')->where('city_active', 1)->lists('name_ar', 'id')->toArray();
        return $result;
    }

    public static function getCityByProv($prov, $lang = 0)
    {
        $result = self::select(["city.id", "name_ar as name_en", "img"])->where('city_active', 1)->where('prov', $prov);
        return $result;
    }


}