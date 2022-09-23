<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Model
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function get()
    {
        return $this->user->get();
    }
}
