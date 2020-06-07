<?php

namespace Dndeus\Logger\Helper;
use Illuminate\Database\Capsule\Manager as Capsule;

trait BootEloquent
{
    private $capsule = null;
    private $objectManager = null;
    private $config = null;
    private $hasAlreadyBooted = false;

    private function boot()
    {
        if ( $this->hasAlreadyBooted )
            return;
        ///////////////////  LOAD ELOQUENT /////////////////////
        $objectManager = $this->getObjectManager();
        $config = $this->getConfig();

        $capsule = $this->getCapsule();

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $config->get('db/connection/default/host'),
            'database'  => $config->get('db/connection/default/dbname'),
            'username'  => $config->get('db/connection/default/username'),
            'password'  => $config->get('db/connection/default/password'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => $config->get('db/table_prefix'),
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();

        $this->hasAlreadyBooted = true;
    }

    private function getCapsule()
    {
        if ( is_null($this->capsule) ) {
            $this->setCapsule();
        }

        return $this->capsule;
    }

    private function setCapsule()
    {
        $this->capsule = new Capsule;
    }

    private function getObjectManager()
    {
        if ( is_null($this->objectManager) ) {
            $this->setObjectManager();
        }
        return $this->objectManager;
    }

    private function setObjectManager()
    {
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    private function getConfig()
    {
        if ( is_null($this->config) ) {
            $this->setConfig();
        }

        return $this->config;
    }

    private function setConfig()
    {
        $this->config = $this->getObjectManager()->create(\Magento\Framework\App\DeploymentConfig::class);
    }

}
