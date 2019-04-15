<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'dep_id');
    }
}