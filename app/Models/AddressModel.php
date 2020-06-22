<?php

namespace App\Models;

class AddressModel extends SuperModel
{

    protected $table = 'addressbook';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];


    public static function getAddressList(Array $filters = [], $hospital = 0, $department = 0, $title = 0, $finance_party = 0, $type = 0)
    {
        $result = self::select(["addressbook.*", "titles.name as title","city.name_en as province", "recipe.name as recipe", 'optimum_types.type as atype', 'finance_party.name as finance_party_name', "department.name as department", "languages.language as language"])
            ->leftJoin('titles', 'titles.id', '=', 'addressbook.title_id')
            ->leftJoin('languages', 'languages.id', '=', 'addressbook.lang')

            ->leftJoin('city', 'city.id', '=', 'addressbook.prov')
            ->leftJoin('department', 'addressbook.department_id', '=', 'department.id')
            ->leftJoin('optimum_types', 'addressbook.type', '=', 'optimum_types.id')
            ->leftJoin('finance_party', 'addressbook.finance_party', '=', 'finance_party.id')
            ->leftJoin('recipe', 'addressbook.hospital_id', '=', 'recipe.id');

        if (isset($filters['key']) && $filters['key']) {
            $result = $result->where(function ($query) use ($filters) {
                $query->where('addressbook.name', 'like', "%" . $filters['key'] . "%")
                    ->orwhere('addressbook.email', 'like', "%" . $filters['key'] . "%")
                    ->orwhere('addressbook.telephone', 'like', "%" . $filters['key'] . "%")
                    ->orwhere('addressbook.fax', 'like', "%" . $filters['key'] . "%")
                    ->orwhere('addressbook.note', 'like', "%" . $filters['key'] . "%");
            });




        }
        if ($hospital > 0) {
            $result->where('addressbook.hospital_id', $hospital);
        }
        if ($department > 0) {
            $result->where('addressbook.department_id', $department);
        }
        if ($title > 0) {
            $result->where('addressbook.title_id', $title);
        }
        if ($finance_party > 0) {
            $result->where('event_case.finance_party', $finance_party);
        }

        if ($type > 0) {
            $result->where('addressbook.type', $type);
        }
        $result  ->where('addressbook.active', 1);
        return $result->orderby('addressbook.id', 'desc');;
    }


}
