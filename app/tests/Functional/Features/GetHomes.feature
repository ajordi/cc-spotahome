Feature:
  In order to use the platform
  As an user
  I want to make a request to list the homes

  Scenario: User wants to get a list of homes
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/api/v1/homes"
    And the response status code should be 200
    And the response should be in JSON
