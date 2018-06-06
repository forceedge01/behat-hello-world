<?php

use Behat\Behat\Context\Context;
use Genesis\SQLExtensionWrapper\BaseProvider;

/**
 * Defines application features from the specific context.
 */
class DataModContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        date_default_timezone_set('UTC');

        // BaseProvider::setCredentials([
        //     'engine' => 'dblib',
        //     'name' => 'Cruise-4_6',
        //     'schema' => 'dbo',
        //     'prefix' => '',
        //     'host' => '31.193.11.199',
        //     'port' => '1433',
        //     'username' => 'app_cruise',
        //     'password' => 'eyesorefreesh1ps'
        // ]);
    }
}
