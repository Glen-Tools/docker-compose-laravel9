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
        $this->log->url = $inputLogDto->url;
        $this->log->method = $inputLogDto->method;
        $this->log->feature = $inputLogDto->feature;
        $this->log->operate = $inputLogDto->operate;
        $this->log->table = $inputLogDto->table;
        $this->log->content = $inputLogDto->content;
        $this->log->user_id = $inputLogDto->userId;
        $this->log->save();
    }
}
