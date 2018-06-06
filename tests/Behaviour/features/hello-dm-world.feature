Feature:
    In order to try out some data manipulation tactics that aid behavioural testing
    As a developer
    I want to create a hello world example with SQL data manipulation

    Scenario: Happy path - test that the phone booking details appear correctly.
        Given I have a "Consultant" fixture with the following data set:
            | Email Address | abc@xyz.com |
        Given I have a "PhoneBooking" fixture with the following data set:
            | SailingDate         | today  |
            | CruiseLineReference | HHDYS  |
        When I am on the "Hello SQL" page
        Then I should see "[CruiselineRef] => HHDYS"
        And I should see "The consultant looking after this booking is abc xyz.com"
        And I should see "Email: abc@xyz.com"
