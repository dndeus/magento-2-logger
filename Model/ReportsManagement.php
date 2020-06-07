<?php
namespace Dndeus\Logger\Model;

use Dndeus\Logger\Model\ReportsService;

class ReportsManagement implements \Dndeus\Logger\Api\ReportsManagementInterface
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
    public function getReports($data)
    {
        return $this->reportsService->getReports($data);

    }
}
