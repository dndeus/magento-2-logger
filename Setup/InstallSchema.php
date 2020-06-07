<?php
namespace Dndeus\Logger\Setup;

use Dndeus\Logger\Helper\BootEloquent;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    use BootEloquent;

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->boot();

        if (!Manager::schema()->hasTable('dndeus_logger_batches')) {
            Manager::schema()->create('dndeus_logger_batches', function (Blueprint $table) {
                $table->increments('id');
                $table->string('type');
                $table->timestamps();
            });
        }

        if (!Manager::schema()->hasTable('dndeus_logger_reports')) {
            Manager::schema()->create('dndeus_logger_reports', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('batch_id');
                $table->foreign('batch_id')
                    ->references('id')
                    ->on('dndeus_logger_batches')
                    ->onDelete('cascade');
                $table->text('data');
                $table->text('message');
                $table->boolean('completed');
                $table->timestamps();
            });
        }

        $setup->endSetup();
    }
}
