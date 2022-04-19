<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'edit_roles',
    ];

    public $table = 'roles';

    public static $list = array(
        'edit_roles',
    );
}
