<?php
namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends Model
{
    protected $role;

    public function __construct()
    {
        $this->role = new Role();
    }

    public function get()
    {
        return $this->role->get();
    }
}
