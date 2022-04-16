<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'roles_id',
    ];

    public $table = 'user_role_link';
}
