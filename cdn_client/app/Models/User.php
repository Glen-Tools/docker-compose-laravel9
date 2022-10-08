<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ["password"];

    // /**
    //  * The roles that belong to the user.
    //  */
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }
}
