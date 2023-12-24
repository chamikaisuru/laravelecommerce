<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_filters extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function filterOption()
    {
        return $this->belongsTo(filter_option::class, 'filter_id');
    }

    public function filterValue()
    {
        return $this->belongsTo(filtervalues::class, 'filter_value_id');
    }
}
