<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasRoles, HasPermissions, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'username',
        'password',
        'levels',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    function scopeIsInactive($query)
    {
        return $query->where('is_active', false);
    }
}
