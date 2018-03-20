<?php

namespace App;

use App\Libraries\ActivateableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;

class Questions extends Repository
{
    use HasTranslations, ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'questions';


    /**
     * @var array
     */
    protected $fillable = ['active'];

    /**
     * @var array
     */
    public $translatedAttributes = ['title', 'body'];

    /**
     * @var MetaTransaltions
     */
    public $translationModel = QuestionsTranslations::class;
}