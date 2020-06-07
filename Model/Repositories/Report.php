<?php

namespace Dndeus\Logger\Model\Repositories;

class Report extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'dndeus_logger_reports';

    protected $fillable = ['data', 'message', 'completed'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
