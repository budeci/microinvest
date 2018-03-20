<?php

namespace App;

use App\Libraries\ActivateableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;

class Conditions extends Repository
{
    use HasTranslations, ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'conditions';


    /**
     * @var array
     */
    protected $fillable = ['image'];

    /**
     * @var array
     */
    public $translatedAttributes = ['title', 'subtitle'];

    /**
     * @var MetaTransaltions
     */
    public $translationModel = ConditionsTranslations::class;
}