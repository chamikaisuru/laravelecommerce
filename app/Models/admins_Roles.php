<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admins_Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'subadmin_id',
        'module',
        'view_access',
        'edit_access',
        'full_access',
    ];
}
