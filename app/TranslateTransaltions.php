<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslateTransaltions extends Model
{
    /**
     * @var string
     */
    protected $table = 'translate_translations';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'language_id', 'value', 'meta_id'
    ];
}