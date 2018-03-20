<?php

namespace App;

use App\Libraries\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class Partners extends Repository
{
    use  ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'partners';


    /**
     * @var array
     */
    protected $fillable = ['image', 'active'];
    
}