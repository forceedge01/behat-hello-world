<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\DriverException;
use Behat\Testwork\Tester\Result\TestResult;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var string
     */
    private static $exceptionHash;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @When /^I set the form field values:$/
     */
    public function iSetTheFormFieldValues(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @AfterStep
     */
    public function takeScreenShotAfterFailedStep(AfterStepScope $scope)
    {
        if ($scope->getTestResult()->getResultCode() === TestResult::FAILED) {
            try {
                $objectHash = spl_object_hash($scope->getTestResult()->getException());
                if (self::$exceptionHash !== $objectHash) {
                    self::$exceptionHash = $objectHash;

                    $mink = $scope->getEnvironment()->getContexts()[1]->getMink();
                    $session = $mink->getSession();

                    $currentUrl = null;
                    try {
                        $currentUrl = $session->getCurrentUrl();
                    } catch (Exception $e) {
                        $currentUrl = 'Unable to fetch current url, error: ' . $e->getMessage();
                    }

                    echo 'URL: ' . $currentUrl;
                }
            } catch (DriverException $e) {
                // The driver is not available, dont fail - allow behat to print out the actual error message.
                echo 'Error message: ' . $e->getMessage();
            }
        }
    }
}
