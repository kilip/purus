Feature: Person

    Background:
        Given I add "Content-Type" header equal to "application/json"
        And I add "Accept" header equal to "application/ld+json"

    Scenario: List people
        Given I have a person with name Zeus
        And I have a person with name Hera
        And I have a person with name Ares
        When I send a get request to "/people"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node "@context" should be equal to "/contexts/Person"


    Scenario: Create new person
        Given I don't have a person with name Zeus
        When I send a POST request to "/people" with body:
        """
        {
            "fullname": "Zeus"
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node gender should be equal to 0
        And the JSON node fullname should be equal to "Zeus"

    Scenario: Update person
        Given I have a person with name Zeus
        And I add "Content-Type" header equal to "application/merge-patch+json"
        When I send a PATCH request for Zeus with body:
        """
        {
            "gender": 1
        }
        """
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node gender should be equal to 1

    Scenario: Remove person
        Given I have a person with name Zeus
        And I send a delete request for Zeus
        Then the response status code should be 204
