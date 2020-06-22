<?php

namespace App\Models;

class RequestModel extends SuperModel
{
    protected $table = 'request';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['userid','module','subject','request_id'];


}
