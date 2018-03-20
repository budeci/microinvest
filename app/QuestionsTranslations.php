<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionsTranslations extends Model
{
    /**
     * @var string
     */
    protected $table = 'questions_translate';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'questions_id'
    ];
}