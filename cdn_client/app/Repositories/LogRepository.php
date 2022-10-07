<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\CdnLog;
use App\Dto\InputLogDto;

class LogRepository extends Model
{
    protected CdnLog $log;

    public function __construct(CdnLog $log)
    {
        $this->log = $log;
    }

    public function create(InputLogDto $inputLogDto)
    {
        $this->log->feature = $inputLogDto->getFeature();
        $this->log->operate = $inputLogDto->getOperate();
        $this->log->table = $inputLogDto->getTable();
        $this->log->content = $inputLogDto->getContent();
        $this->log->user_id = $inputLogDto->getUserId();
        $this->log->save();
    }
}
