<?php

namespace App\Models;

class SpecialityDieseasModel extends SuperModel
{

    protected $table = 'speciality_dieseas';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

    public static function getSpecialityDieseasList(Array $filters = [], $status, $type,$procedure=0)
    {
        $result = self::select(["speciality_dieseas.*", "optimum_types.type as dtype"])

            ->leftJoin('optimum_types', 'speciality_dieseas.type', '=', 'optimum_types.id');


        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where('name', 'like', "%" . $filters['key'] . "%");
        }
        if ($status > 0) {
            if ($status == "1")
                $result->where('speciality_dieseas.active', 1);
            else
                $result->where('speciality_dieseas.active', '<>', 1);
        }
        if ($type > 0) {

            $result->where('speciality_dieseas.type', $type);

        }
        if ($procedure > 0) {
            $result->where('speciality_dieseas.id', ProcedureModel::find($procedure)->disease_id);
        }
        $result = $result->whereNull('speciality_dieseas.deleted_at');
        return $result;
    }

    public static function getDieseasName($id)
    {
        try {
            $result = self::select(["speciality_dieseas.name"])
                ->where('speciality_dieseas.id', $id);
            $result = $result->first()->name;

        } catch (\Exception $e) {
            $result = "NA";
        }

        return $result;
    }

}
