<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\CdnLog;
use App\Dto\InputLogDto;

class LogRepository extends Model
{
    protected $user;

    public function __construct()
    {
        $this->Log = new CdnLog();
    }

    public function create(InputLogDto $inputLogDto)
    {
        $log = new CdnLog();
        $log->feature = $inputLogDto->getFeature();
        $log->operate = $inputLogDto->getOperate();
        $log->table = $inputLogDto->getTable();
        $log->content = $inputLogDto->getContent();
        $log->user_id = $inputLogDto->getUserId();
        $log->save();
    }
}
