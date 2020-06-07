<?php
namespace Dndeus\Logger\Console\Command;

use Dndeus\Logger\Model\Repositories\Batch;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CustomerImport
 *
 * @package Dndeus\Logger\Console\Command
 */
class ClearLogs extends Command
{
    private $state;

    public function __construct(
        \Magento\Framework\App\State $state,
        string $name = null
    ) {
        $this->state = $state;
        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $oldReports = date("Y-m-d", strtotime("-1 months"));
        $batches = Batch::where('created_at', '<', $oldReports)->get()->toArray();
        if (!empty($batches)) {
            foreach ($batches as $batch) {
                Batch::where('id', $batch['id'])->delete();
            }
        }
        $output->writeln('Logs cleared');
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("DndeusLogger:clear-logs");
        $this->setDescription("Clean up logs");
        parent::configure();
    }
}

