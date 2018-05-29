Feature:
    In order to try out some basic behavioural testing tactics
    As a developer
    I want to create a hello world example with form submission

    Background:
        Given I am on the "Hello JS" page

    @javascript
    Scenario: Happy path - Input name and date of birth.
        Given I press "showForm" to make the form visible

        When I fill in "name" with "Abdul"
        And I fill in "dob" with "1989-05-10"

        And I press "Submit"

        Then I should see "Hello Abdul! You are 29 year(s) old!"

    Scenario Outline: Try out different combinations as pr AC.
        When I fill in "name" with "<name>"
        And I fill in "dob" with "<dob>"
        And I press "Submit"

        Then I should see "<result>"

        Examples:
            | name  | dob        | result                                                 |
            | Abdul |            | Hello Abdul!                                           |
            |       | 1989-05-10 | Hello World! You are 29 year(s) old!                   |
            | Yahoo | 2050-05-10 | Hello Yahoo! Invalid age, you are not from the future. |
    
    Scenario: Use default input to submit.
        And I press "Submit"

        Then I should see "Hello John!"

    Scenario: Default name preserves value.
        When I fill in "name" with "kasdklfhlashdfhalshdf"
        And I press "Submit"

        Then the "name" field should contain "kasdklfhlashdfhalshdf"
