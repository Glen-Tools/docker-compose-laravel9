<?php
namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;

class MenuRepository extends Model
{
    protected $menu;

    public function __construct()
    {
        $this->menu = new Menu();
    }

    public function get()
    {
        return $this->menu->get();
    }
}
