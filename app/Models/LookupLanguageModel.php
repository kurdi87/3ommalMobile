<?php

namespace App\Models;

class LookupLanguageModel extends SuperModel
{
    protected $table = 'systemlookup_language';
    public $timestamp = false;
    protected $primaryKey = 'LkpLang_ID';
}
