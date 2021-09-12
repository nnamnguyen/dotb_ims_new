@modules @rli
Feature: RLI module verification

  Background:
    Given I am logged in

  @revenue_line_items_products @pr  @api @e2e
  Scenario: RLI > Verify that the corresponding fields are auto populated when selecting a product while editing an RLI
    # Create Product
    Given ProductTemplates records exist:
      | *name     | discount_price | list_price | cost_price |
      | Product_1 | $1000          | $2000      | $500       |
    # Could not related Product Category to Product Template via API
    And ProductCategories records exist related via category_link link to *Product_1:
      | *name      |
      | Category_1 |
    And RevenueLineItems records exist:
      | *name | date_closed               | likely_case | best_case | sales_stage | quantity |
      | RLI_1 | 2018-10-19T19:20:22+00:00 | $300        | $300      | Prospecting | 5        |
    And Opportunities records exist related via opportunities link to *RLI_1:
      | *name  |
      | Opp_1 |
    When I update ProductTemplates *Product_1 with the following values: 
      | website         | category_name |  
      | www.google.com  | Category_1    |
    Then ProductTemplates *Product_1 should have the following values:
      | fieldName      | value       |
      | category_name  | Category_1  |
    When I update RevenueLineItems *RLI_1 with the following values: 
      | product_template_name |
      | Product_1             |
    Then RevenueLineItems *RLI_1 should have the following values:
      | fieldName      | value      |
      | discount_price | $1,000.00   |
      | total_amount   | $5,000.00   |
      | category_name  | Category_1 |
      | list_price     | $2,000.00   |
      | cost_price     | $500.00    |

  @revenue_line_item_best_worst_likely @pr @e2e
  Scenario Outline: RLI > Verify that Best and Worst amounts are made read-only and equal to likely
  when either the "closed won" or "closed lost: sales stage are selected.
    Given RevenueLineItems records exist:
      | *name | date_closed               | worst_case | likely_case | best_case | sales_stage | quantity |
      | RLI_1 | 2018-10-19T19:20:22+00:00 | 200        | 300         | 400       | Prospecting | 5        |
    And Opportunities records exist related via opportunities link to *RLI_1:
      | name |
      | Opp_1 |
    When I update RevenueLineItems *RLI_1 with the following values:
      | sales_stage  |
      | <salesStage> |
    Then RevenueLineItems *RLI_1 should have the following values:
      | fieldName   | value          |
      | likely_case | <likelyAmount> |
      | best_case   | <likelyAmount> |
      | worst_case  | <likelyAmount> |
    Examples:
      | salesStage  | likelyAmount |
      | Closed Won  | $300.00      |
      | Closed Lost | $300.00      |

  @revenue_line_items_accounts @pr @api @e2e
  Scenario: RLI > Verify that account field is populated when an Opportunity is selected while editing an RLI
    Given RevenueLineItems records exist:
      | *name | date_closed               | likely_case | best_case | sales_stage | quantity |
      | RLI_1 | 2018-10-19T19:20:22+00:00 | 3000        | 3000      | Prospecting | 3        |
    And Opportunities records exist:
      | *name  |
      | Opp_1 |
    And Accounts records exist related via accounts link to *Opp_1:
      | *name |
      | Acc_1 |
    When I update RevenueLineItems *RLI_1 with the following values:
      | opportunity_name |
      | Opp_1            |
    Then RevenueLineItems *RLI_1 should have the following values:
      | fieldName    | value |
      | account_name | Acc_1 |
