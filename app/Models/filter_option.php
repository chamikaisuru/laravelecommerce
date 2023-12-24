<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filter_option extends Model
{
    use HasFactory;

    public function filterValues()
    {
        return $this->hasMany(filtervalues::class);
    }
}
