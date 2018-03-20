<?php

namespace App;
use Keyhunter\Administrator\Repository;

class AplicationFile extends Repository
{

	protected $table    = 'aplication_file';
	public $timestamps  = false;
	protected $fillable = ['aplication_id','file','id_file'];

    public function aplication()
    {
        return $this->hasOne(Aplication::class, 'id', 'aplication_id');
    }

    public function getFullPathAttribute()
    {
        return public_path().$this->file;
    }
}

