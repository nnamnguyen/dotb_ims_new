<?php


require_once 'data/BeanFactory.php';
require_once 'clients/base/api/FilterApi.php' ;
class CurrenciesFilterApi extends FilterApi
{
    public function registerApiRest()
    {
        return array(
            'currenciesGet' => array(
                'reqType' => 'GET',
                'path' => array('Currencies'),
                'pathVars' => array('module'),
                'method' => 'currenciesGet',
                'jsonParams' => array(),
                'shortHelp' => 'Filter records from a single module',
                'longHelp' => 'modules/Currencies/clients/base/api/help/CurrenciesGet.html',
            ),
        );
    }

    /**
     * Currencies API Handler
     *
     * @param ServiceBase $api
     * @param array $args
     * @return array
     */
    public function currenciesGet(ServiceBase $api, array $args)
    {
        // get the currencies from the base parent API class
        $currencies = parent::filterList($api, $args);

        // get the default currency
        $defaultCurrency = BeanFactory::getBean('Currencies', -99);
        $defaultCurrencyResult = $this->formatBean($api, $args, $defaultCurrency);

        // add system default to the top
        array_unshift($currencies['records'], $defaultCurrencyResult);

        return $currencies;
    }
}
