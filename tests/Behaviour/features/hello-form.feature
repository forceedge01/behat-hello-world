Feature:
    In order to try out some basic behavioural testing tactics
    As a developer
    I want to create a hello world example with form submission

    Background:
        Given I am on "/behat-hello-world/index-form.php"

    Scenario: Happy path - Input name and date of birth.
        When I fill in "name" with "Abdul"
        And I fill in "dob" with "1989-05-10"

        And I press "Submit"

        Then I should see "Hello Abdul! You are 29 year(s) old!"

    Scenario: Input just name.
        When I fill in "name" with "Abdul"
        And I fill in "dob" with ""
        And I press "Submit"

        Then I should see "Hello Abdul!"

    Scenario: Use default input to submit.
        And I press "Submit"

        Then I should see "Hello John!"

    Scenario: Input nothing.
        When I fill in "name" with ""
        And I fill in "dob" with ""
        And I press "Submit"

        Then I should see "Hello World!"

    Scenario: Input just date of birth.
        When I fill in "name" with ""
        And I fill in "dob" with "1989-05-10"
        And I press "Submit"

        Then I should see "Hello World! You are 29 year(s) old!"

    Scenario: Date of birth in the future.
        When I fill in "name" with "Yahoo"
        And I fill in "dob" with "2050-05-10"
        And I press "Submit"

        Then I should see "Hello Yahoo! Invalid age, you are not from the future. "

    Scenario: Default name preserves value.
        When I fill in "name" with "kasdklfhlashdfhalshdf"
        And I press "Submit"

        Then the "name" field should contain "kasdklfhlashdfhalshdf"
