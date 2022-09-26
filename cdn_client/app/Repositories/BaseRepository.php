<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ListType;

class BaseRepository extends Model
{

    protected function isGetListCount(ListType $type)
    {
        if ($type == ListType::ListCount) {
            return true;
        }
        return false;
    }

    protected function stringMixLike(string $data)
    {
        return "%$data%";
    }
}
