<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departament()
    {
        return $this->belongsTo(Departament::class, 'dep_id');
    }

    /**
     * @param $value
     */
    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = trim($value);
    }
}