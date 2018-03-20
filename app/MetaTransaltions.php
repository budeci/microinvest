<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaTransaltions extends Model
{
    /**
     * @var string
     */
    protected $table = 'meta_translations';

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