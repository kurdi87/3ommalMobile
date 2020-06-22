<?php

namespace App\Models;

class SystemLookupModel extends SuperModel
{
    protected $table = 'system_lookup';
    public $timestamp = false;
    protected $primaryKey = 'SysLkp_ID';

    public function language()
    {
        return $this->hasMany($this->model("LookupLanguageModel"), "SysLkpLang_SystemLookupID");
    }

    public function lookup_language()
    {
        return $this->hasOne($this->model("LookupLanguageModel"), "SysLkpLang_SystemLookupID");
    }

    public function english()
    {
        return $this->hasOne($this->model("LookupLanguageModel"), "SysLkpLang_SystemLookupID")->where("SysLkpLang_Type","EN");
    }

    public function arabic()
    {
        return $this->hasOne($this->model("LookupLanguageModel"), "SysLkpLang_SystemLookupID")->where("SysLkpLang_Type","AR");
    }

    public static function getLookeupByKey($key, $lang = "EN", $order = "desc")
    {

        return self::where('SysLkp_ParentID', '=', self::getIdByKey($key))
            ->where('SysLkp_IsActive', '=', 1)
            ->with(['language' => function ($query) use ($lang) {
                $query->where('SysLkpLang_Type', '=', $lang);
            }])
            ->orderBy('SysLkp_Order',$order)
            ->orderBy('SysLkp_ID', $order)
            ->get();
    }

    public static function getLookeupValueByKey($key, $lang = "EN")
    {
        return self::where('SysLkp_ID', '=', self::getIdByKey($key))
            ->where('SysLkp_IsActive', '=', 1)
            ->with(['language' => function ($query) use ($lang) {
                $query->where('SysLkpLang_Type', '=', $lang);
            }])
            ->orderBy('SysLkp_ID', 'desc')
            ->get();
    }

    public static function getIdByKey($key)
    {
        return self::where('SysLkp_HTMLID', '=', $key)->first()->SysLkp_ID;
    }

    public static function getKeyById($id)
    {
        return self::where('SysLkp_ID', '=', $id)->first()->SysLkp_HTMLID;
    }

    public static function getLookupBySysLkp_HTMLID($SysLkp_HTMLID, $lookup_language = 'en')
    {
        return self::with(['lookup_language' => function ($query) use ($lookup_language) {
            $query->where('SysLkpLang_Type', $lookup_language);
        }])
            ->whereIn('SysLkp_ParentID', function ($query) use ($SysLkp_HTMLID, $lookup_language) {
                $query->select('SysLkp_ID')->from('System_Lookup')->where('SysLkp_HTMLID', '=', $SysLkp_HTMLID);
            })
            ->get();
    }

    public static function getLookupBySysLkp_ID($SysLkp_ID, $lookup_language = 'en')
    {
        return self::with(['lookup_language' => function ($query) use ($lookup_language) {
            $query->where('SysLkpLang_Type', $lookup_language);
        }])
            ->where('SysLkp_ID', $SysLkp_ID)->first();
    }

    public static function getLookupList($SysLkp_HTMLID)
    {
        return self::with('lookup_language')->whereIn('SysLkp_ParentID', function ($query) use ($SysLkp_HTMLID) {
            $query->select('SysLkp_ID')->from('System_Lookup')->where('SysLkp_HTMLID', '=', $SysLkp_HTMLID);
        })->lists('SysLkp_ID');
    }
}
