<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConditionsTranslations extends Model
{
    /**
     * @var string
     */
    protected $table = 'conditions_translate';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'subtitle', 'conditions_id'
    ];
}