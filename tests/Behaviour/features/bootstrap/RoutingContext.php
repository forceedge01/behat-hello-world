<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkAwareContext;
use Behat\Mink\Mink;
use Genesis\SQLExtensionWrapper\BaseProvider;
use Genesis\TestRouting\Routing;

/**
 * Defines application features from the specific context.
 */
class RoutingContext implements Context, MinkAwareContext
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
        Routing::registerFile(__DIR__ . '/Config/Routing.php');
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
     * @Given I am on the :arg1 page
     * @Given I am on the :arg1 page with params:
     */
    public function iAmOnThePage($arg1, TableNode $params = null)
    {
        $url = Routing::getRoute($arg1, function ($resolvedUrl) use ($params) {
            $resolvedUrl .= ($params ? '?' . http_build_query($params->getRowsHash()) : null);

            return BaseProvider::getApi()->get('keyStore')->parseKeywordsInString($resolvedUrl);
        });

        return $this->mink->getSession()->visit(
            $this->minkParameters['base_url'] .
            $url
        );
    }
}
