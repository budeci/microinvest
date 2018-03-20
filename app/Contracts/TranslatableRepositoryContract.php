<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface TranslatableRepositoryContract
{
    /**
     * Get translatable model of instance.
     *
     * @return Model
     */
    public function getTranslatableModel();
}