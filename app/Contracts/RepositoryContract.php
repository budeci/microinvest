<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryContract
{
    /**
     * @return Model
     */
    public function getModel();

    /**
     * Find row by slug/id
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function find($slug);
}