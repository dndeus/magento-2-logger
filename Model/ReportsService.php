<?php
namespace Dndeus\Logger\Model;

use Dndeus\Logger\Helper\BootEloquent;
use Dndeus\Logger\Model\Repositories\Batch;
use Dndeus\Logger\Model\Repositories\Report;
use Illuminate\Database\Eloquent\Builder;

class ReportsService
{
    use BootEloquent;

    const PER_PAGE = 15;

    public function __construct()
    {
        $this->boot();
    }

    public function getTypes(): array
    {
        $types = Batch::groupBy('type')->get('type')->pluck('type')->toArray();

        return array_map(function ($type) {
            return ucfirst(str_replace('_', ' ', $type));
        }, $types);
    }

    public function getReports($data)
    {
        $page = 1;
        if (isset($data["page"])) {
            $page = explode('=', $data["page"]);
            $page = $page[1];
        }

        \Illuminate\Pagination\Paginator::currentPageResolver(function ($pageName = 'page') use ($page) {
            return (int) ($page ?? 1);
        });

        $reports = Report::with('batch')->where('batch_id', $data['batch_id']);

        if (isset($data["status"]) && !is_null($data["status"])) {
            $reports = $reports->where('completed',$data["status"]);
        }

        $reports = $reports->orderBy('created_at', 'desc')->paginate(self::PER_PAGE)->toArray();

//        foreach ($filters as $key =>  $filter) {
//            if ( $key == 'order_by' ) {
//                $results->appends(['order_by' => $filter['field'] . '-'.$filter['order']]);
//            } else {
//                $results->appends([$key => $filter]);
//            }
//        }

        for ($i = 0; $i < count($reports['data']); $i++) {
            $reports['data'][$i]['data'] = json_encode(unserialize($reports["data"][$i]["data"]));
            $reports['data'][$i]['batch']['type'] = str_replace('_', ' ', ucfirst($reports['data'][$i]['batch']['type']));
        }

        return $reports;
    }

    public function getBatches($data)
    {
        $page = 1;
        if (isset($data["page"])) {
            $page = explode('=', $data["page"]);
            $page = $page[1];
        }

        \Illuminate\Pagination\Paginator::currentPageResolver(function ($pageName = 'page') use ($page) {
            return (int) ($page ?? 1);
        });

        $batches = Batch::withCount([
            'reports as successful_imports' => function (Builder $query) {
                $query->where('completed', 1);
            },
            'reports as failed_imports' => function (Builder $query) {
                $query->where('completed', 0);
            }]);

        if (isset($data["type"]) && !is_null($data["type"])) {
            $batches = $batches->where('type', str_replace(' ', '_', strtolower($data["type"])));
        }

        if (isset($data["from"]) && !is_null($data["from"])) {
            $data["from"] = $data["from"] . ' 00:00:00';
            $batches = $batches->where('created_at', '>=', $data["from"]);
        }

        if (isset($data["to"]) && !is_null($data["to"])) {
            $data["to"] = $data["to"] . ' 23:59:59';
            $batches = $batches->where('created_at', '<=', $data["to"]);
        }

         $batches = $batches->orderBy('created_at', 'desc')->paginate(self::PER_PAGE)->toArray();

//        foreach ($filters as $key =>  $filter) {
//            if ( $key == 'order_by' ) {
//                $results->appends(['order_by' => $filter['field'] . '-'.$filter['order']]);
//            } else {
//                $results->appends([$key => $filter]);
//            }
//        }

        for ($i = 0; $i < count($batches['data']); $i++) {
            $batches['data'][$i]['date'] = $batches["data"][$i]["created_at"];
            $batches['data'][$i]['type'] = [
                'label' => ucfirst(str_replace('_', ' ', $batches["data"][$i]["type"])),
                'machine_name' => $batches["data"][$i]["type"],
            ];

            unset($batches["data"][$i]["created_at"]);
        }

        return $batches;
    }
}
