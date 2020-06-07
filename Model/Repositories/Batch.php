<?php

namespace Dndeus\Logger\Model\Repositories;

class Batch extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'dndeus_logger_batches';

    protected $fillable = ['type'];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function getDateAttribute()
    {
        return $this->attributes['created_at'];
    }
}
