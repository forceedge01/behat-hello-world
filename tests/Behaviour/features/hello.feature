Feature:
    In order to try out some behavioural testing tactics
    As a developer
    I want to test against the hello world test site.

    Scenario: View the test site page.
        Given I am on "/behat-hello-world/index-simple.php"
        Then I should see "Hello World"