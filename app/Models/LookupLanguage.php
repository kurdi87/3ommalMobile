<?php

namespace App;

class LookupLanguage extends SuperModel
{
    protected $table = 'systemlookup_language';
    public $timestamp = false;
    protected $primaryKey = 'LkpLang_ID';
}
