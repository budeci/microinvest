<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Keyhunter\Administrator\Repository;

class Aplication extends Repository
{
    /** `status` field options */
	const STATUS_OPEN  = 'open';
	const STATUS_CLOSE = 'close';

	protected $table    = 'aplication';
	protected $fillable = ['dealer','status','session_id','expire_date'];
    protected $dates = ['expire_date'];
    
	public function aplicationFile()
    {
        return $this->hasMany(AplicationFile::class, 'aplication_id', 'id');
    }
}
