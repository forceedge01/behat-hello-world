<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkAwareContext;
use Behat\Mink\Exception\DriverException;
use Behat\Mink\Mink;
use Behat\Testwork\Tester\Result\TestResult;
use Exception;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, MinkAwareContext
{
    /**
     * @var string
     */
    private static $exceptionHash;

    private $mink;

    private $minkParameters;

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
     * Sets Mink instance.
     *
     * @param Mink $mink Mink session manager
     */
    public function setMink(Mink $mink)
    {
        $this->mink = $mink;
    }

    /**
     * Sets parameters provided for Mink.
     *
     * @param array $parameters
     */
    public function setMinkParameters(array $parameters)
    {
        $this->minkParameters = $parameters;
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

    /**
     * @Given I am on the :arg1 page
     */
    public function iAmOnThePage($arg1)
    {
        if ($arg1 === 'Test Javascript') {
            $url = '/behat-hello-world/index-form-js.php';
        }

        $this->mink->getSession()->visit($this->minkParameters['base_url'] . $url);
    }

    /**
     * @Given I press :arg1 to make the form visible
     */
    public function iPressToMakeTheFormVisible($arg1)
    {
        $element = $this->mink->getSession()->getPage()->find('css', '#' . $arg1);

        if (! $element) {
            throw new Exception('Element not found.');
        }

        $element->click();
    }
}
