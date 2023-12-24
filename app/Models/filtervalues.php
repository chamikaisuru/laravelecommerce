<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filtervalues extends Model
{
    use HasFactory;

    public function filterOption()
    {
        return $this->belongsTo(filter_option::class, 'filter_id');
    }

    public function productFilters()
    {
        return $this->hasMany(product_filters::class, 'filter_value_id');
    }
}
