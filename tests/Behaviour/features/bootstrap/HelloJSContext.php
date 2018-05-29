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
class HelloJSContext implements Context, MinkAwareContext
{
    /**
     * @var string
     */
    private static $exceptionHash;

    /**
     * @var Mink
     */
    private $mink;

    /**
     * @var array
     */
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
