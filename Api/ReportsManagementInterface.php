<?php
namespace Dndeus\Logger\Api;

interface ReportsManagementInterface
{

    /**
     * POST for batches api
     * @param mixed $data
     * @return mixed
     */
    public function getReports($data);
}
