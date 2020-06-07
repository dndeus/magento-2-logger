<?php

namespace Dndeus\Logger\Model;

use Dndeus\Logger\Helper\BootEloquent;
use Dndeus\Logger\Model\Repositories\Batch;

class Logger
{
    use BootEloquent;

    protected $batch = null;

    public function __construct()
    {
        $this->boot();
    }

    public function success($data, $message)
    {
        $this->getBatch()->reports()->create([
            'data' => serialize($data),
            'message' => $message,
            'completed' => true,
        ]);
    }

    public function failed($data, $message)
    {
        $this->getBatch()->reports()->create([
            'data' => serialize($data),
            'message' => $message,
            'completed' => false,
        ]);
    }

    public function forType(string $type)
    {
        if ( is_null($this->batch) ) {
            $this->batch = Batch::create(['type' => $type]);
        }

        return $this;
    }

    public function getBatch()
    {
        if ( is_null($this->batch) ) {
            throw new \Exception('You need to set the type of the logger before using it. Use the method ' . self::class . '::forType() first.');
        }

        return $this->batch;
    }
}
