<?php

namespace App\Models;

class AttModel extends SuperModel
{
    protected $table = 'att';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

}
