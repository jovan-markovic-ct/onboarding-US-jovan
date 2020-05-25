Feature: iDealInitialTransactionHappyPath
  As a guest user
  I want to make an initial transaction with iDeal
  And to see that initial transaction was successful

  Background:
    Given I initialize shop system

  @woocommerce
  Scenario: initial transaction ING
    Given I activate "iDeal" payment action "debit" in configuration
    And I prepare checkout with purchase sum "18" in shop system as "guest customer"
    And I see "Wirecard iDEAL"
    And I start "iDeal" payment over bank "ING"
    When I perform "iDeal" actions outside of the shop
    Then I see successful payment
    And I see "iDeal" transaction type "debit" in transaction table
