<?php



/**
 * OpportunitiesCurrencyRateUpdate
 *
 * A class for updating currency rates on specified database table columns
 * when a currency conversion rate is updated by the administrator.
 *
 */
class ProductTemplatesCurrencyRateUpdate extends CurrencyRateUpdateAbstract
{
    /**
     * constructor
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        // set rate field definitions
        $this->addRateColumnDefinition('product_templates', 'base_rate');
        // set usdollar field definitions
        $this->addUsDollarColumnDefinition('product_templates', 'list_price', 'list_usdollar');
        $this->addUsDollarColumnDefinition('product_templates', 'cost_price', 'cost_usdollar');
        $this->addUsDollarColumnDefinition('product_templates', 'discount_price', 'discount_usdollar');
    }

}
