<?php
namespace Dndeus\Logger\Model;

use Dndeus\Logger\Model\ReportsService;

class TypesManagement implements \Dndeus\Logger\Api\TypesManagementInterface
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
    public function getTypes()
    {
        return $this->reportsService->getTypes();
    }
}
