<?php
namespace Dndeus\Logger\Model;

use Dndeus\Logger\Reports\ReportsService;

class BatchesManagement implements \Dndeus\Logger\Api\BatchesManagementInterface
{
    protected $reportsService;

    public function __construct(
        ReportsService $reportsService
    ) {
        $this->reportsService = $reportsService;
    }

    /**
     * {@inheritdoc}
     */
    public function getBatches($data)
    {
        return $this->reportsService->getBatches($data);
    }
}
