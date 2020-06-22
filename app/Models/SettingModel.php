<?php

namespace App\Models;

class SettingModel extends SuperModel
{
    protected $table = 'config';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];
}
