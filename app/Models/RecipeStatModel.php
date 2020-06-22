<?php

namespace App\Models;

class RecipeStatModel extends SuperModel
{

    protected $table = 'recipe_stat';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['value'];

}
