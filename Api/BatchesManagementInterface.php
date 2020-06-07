<?php
namespace Dndeus\Logger\Api;

interface BatchesManagementInterface
{

    /**
     * POST for batches api
     * @param mixed $data
     * @return mixed
     */
    public function getBatches($data);
}
