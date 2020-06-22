<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class LoggingDetailsModel extends SuperModel
{
    protected $table = 'Logging_Details';
    public $timestamps = false;
    protected $primaryKey = 'LogDet_ID';
    protected $fillable = ['LogDet_MasterID','LogDet_ReferencedTableName','LogDet_ReferencedFieldName','LogDet_OldValue','LogDet_NewValue'];

     public function newDetailsLog($LogDet_MasterID,$LogDet_ReferencedTableName,$LogDet_ReferencedFieldName,$LogDet_OldValue, $LogDet_NewValue){
    //    $this->Log_ActionPrimaryValue=$primaryValue;
        $this->LogDet_MasterID=$LogDet_MasterID;
        $this->LogDet_ReferencedTableName=$LogDet_ReferencedTableName;
        $this->LogDet_ReferencedFieldName=$LogDet_ReferencedFieldName;
        $this->LogDet_OldValue=$LogDet_OldValue;
        $this->LogDet_NewValue=$LogDet_NewValue;
        $this->save();

        //$this->recordsKey()->save(new LoggingRecordPKModel(['LogPK_FieldName' => $primary]));
    }
}
