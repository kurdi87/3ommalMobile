<?php

namespace App\Models;

class LoggingMastersModel extends SuperModel
{
    protected $table = 'logging_masters';
    public $timestamps = false;
    protected $primaryKey = 'Log_ID';
    protected $fillable = ['Log_UserID','Log_ActionDate','Log_IPAddress','Log_ActionName','Log_AffectedRecordTableName','Log_RecordReferenceName'];

    public function user()
    {
        return $this->belongsTo($this->model("SystemUserModel"), "Log_UserID");
    }

    public function details()
    {
        return $this->hasMany($this->model("LoggingDetailsModel"), "LogDet_MasterID");
    }

    public function recordsKey()
    {
        return $this->hasMany($this->model("LoggingRecordPKModel"), "LogPK_MasterID");
    }

    public function newMasterLog($primaryValue,$Log_UserID,$Log_IPAddress,$Log_ActionName,$Log_AffectedRecordTableName,$Log_RecordReferenceName,$primary,$password,$islog){
        //$this->Log_ActionPrimaryValue=$primaryValue;
        $this->Log_UserID=$Log_UserID;
        $this->Log_ActionDate=date("Y-m-d H:i:m");
        $this->Log_IPAddress=$Log_IPAddress;
        $this->Log_ActionName=$Log_ActionName;
        $this->Log_AffectedRecordTableName=$Log_AffectedRecordTableName;
        $this->Log_RecordReferenceName=$Log_RecordReferenceName;
        $this->password=$password;
        $this->islog=$islog;
        $this->save();

        $this->recordsKey()->save(new LoggingRecordPKModel(['LogPK_FieldName' => $primary]));
    }

    public static function getLogsList(Array $filters = [])
    {
        $result = self::select(["Logging_Masters.*", "su.SysUsr_FullName as created_by",\DB::raw("concat(Log_ActionName,concat(' ',Log_RecordReferenceName)) as description")])
            ->leftJoin('System_User as su', 'su.SysUsr_ID', '=', 'Logging_Masters.Log_UserID');

        if (isset($filters['from']) && $filters['from']) {
            $result = $result->where('Logging_Masters.Log_ActionDate', '>=', $filters['from']);
        }

        if (isset($filters['to']) && $filters['to']) {
            $result = $result->where(\DB::raw('DATE_FORMAT(Logging_Masters.Log_ActionDate, "%Y-%m-%d")'), '<=', $filters['to']);
        }

        return $result;
    }
}
