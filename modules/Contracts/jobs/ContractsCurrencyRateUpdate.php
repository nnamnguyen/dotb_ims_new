<?php



/**
 * OpportunitiesCurrencyRateUpdate
 *
 * A class for updating currency rates on specified database table columns
 * when a currency conversion rate is updated by the administrator.
 *
 */
class ContractsCurrencyRateUpdate extends CurrencyRateUpdateAbstract
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
        $this->addRateColumnDefinition('contracts', 'base_rate');
        // set usdollar field definitions
        $this->addUsDollarColumnDefinition('contracts', 'total_contract_value', 'total_contract_value_usdollar');
    }

}
