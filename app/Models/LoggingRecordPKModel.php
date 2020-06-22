<?php

namespace App\Models;

class LoggingRecordPKModel extends SuperModel
{
    protected $table = 'logging_recordpk';
    public $timestamps = false;
    protected $primaryKey = 'LogPK_ID';
    protected $fillable = ['LogPK_FieldName'];

    public function master()
    {
        return $this->belongsTo($this->model("LoggingMastersModel"), "LogPK_MasterID");
    }
}
