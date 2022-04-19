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

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function role() {
        return $this->belongsTo('App\Models\Roles', 'roles_id', 'id');
    }
}
