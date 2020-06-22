<?php

namespace App\Models;

class Contact extends SuperModel
{

    protected $table = 'contact';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

}
