<?php

namespace App;

use App\Libraries\ActivateableTrait;
use App\Libraries\Metaable\Metaable;
//use App\Libraries\MetaablePrice\Metaable;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;

class Translate extends Repository implements Translatable
{
    use HasTranslations, Metaable, ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'translate';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['key', 'type', 'active'];

    /**
     * @var array
     */
    public $translatedAttributes = ['value'];


    /**
     * @var
     */
    public $translationModel = TranslateTransaltions::class;
}