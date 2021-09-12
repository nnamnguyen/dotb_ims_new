<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\Implement;

use Dotbcrm\Dotbcrm\Elasticsearch\Analysis\AnalysisBuilder;
use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Document;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\ObjectProperty;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\MultiFieldBaseProperty;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\MultiFieldProperty;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\SearchFields;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\GlobalSearch;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\AbstractHandler;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\AnalysisHandlerInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\MappingHandlerInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\SearchFieldsHandlerInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\ProcessDocumentHandlerInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\SearchField;

/**
 *
 * Email Address Handler
 *
 */
class EmailAddressHandler extends AbstractHandler implements
    AnalysisHandlerInterface,
    MappingHandlerInterface,
    SearchFieldsHandlerInterface,
    ProcessDocumentHandlerInterface
{
    /**
     * Multi field definitions
     * @var array
     */
    protected $multiFieldDefs = [
        'gs_email' => [
            'type' => 'text',
            'index' => true,
            'analyzer' => 'gs_analyzer_email',
            'store' => true,
        ],
        'gs_email_wildcard' => [
            'type' => 'text',
            'index' => true,
            'analyzer' => 'gs_analyzer_email_ngram',
            'search_analyzer' => 'gs_analyzer_email',
            'store' => true,
        ],
    ];

    /**
     * Weighted boost definition
     * @var array
     */
    protected $weightedBoost = array(
        // we dont need to specify gs_email_primary
        'gs_email_wildcard_primary' => 0.45,
        'gs_email_secondary' => 0.75,
        'gs_email_wildcard_secondary' => 0.25,
    );

    /**
     * Highlighter field definitions
     * @var array
     */
    protected $highlighterFields = array(
        '*.gs_email' => array(
            'number_of_fragments' => 0,
        ),
        '*.gs_email_wildcard' => array(
            'number_of_fragments' => 0,
        ),
    );

    /**
     * Field name to use for email search
     * @var string
     */
    protected $searchField = 'email_search';

    /**
     * {@inheritdoc}
     */
    public function setProvider(GlobalSearch $provider)
    {
        parent::setProvider($provider);

        $provider->addSupportedTypes(array('email'));
        $provider->addHighlighterFields($this->highlighterFields);
        $provider->addWeightedBoosts($this->weightedBoost);

        // As we are searching against email_search field, we want to remap the
        // highlights from that field back to the original email field.
        $provider->addFieldRemap(array($this->searchField => 'email'));

        // We don't want to add the email field to the queuemanager query
        // because we will populate the emails seperately.
        $provider->addSkipTypesFromQueue(array('email'));
    }

    /**
     * {@inheritdoc}
     */
    public function buildAnalysis(AnalysisBuilder $analysisBuilder)
    {
        $analysisBuilder
            ->addCustomAnalyzer(
                'gs_analyzer_email',
                'whitespace',
                array('lowercase')
            )
            ->addCustomAnalyzer(
                'gs_analyzer_email_ngram',
                'whitespace',
                array('lowercase', 'gs_filter_ngram_1_15')
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildMapping(Mapping $mapping, $field, array $defs)
    {
        if (!$this->isEmailField($defs)) {
            return;
        }

        // Use original field to store the raw json content
        $baseObject = new ObjectProperty();
        $baseObject->setEnabled(false);
        $mapping->addModuleObjectProperty($field, $baseObject);

        // Prepare multifield
        $email = new MultiFieldBaseProperty();
        foreach ($this->multiFieldDefs as $multiField => $defs) {
            $multiFieldProp = new MultiFieldProperty();
            $multiFieldProp->setMapping($defs);
            $email->addField($multiField, $multiFieldProp);
        }

        // Additional field holding both primary/secondary addresses
        $searchField = new ObjectProperty();
        $searchField->addProperty('primary', $email);
        $searchField->addProperty('secondary', $email);

        $searchFieldName = $mapping->getModule() . Mapping::PREFIX_SEP . $this->searchField;
        $mapping->addObjectProperty($searchFieldName, $searchField);
        $mapping->excludeFromSource($searchFieldName);
    }

    /**
     * {@inheritdoc}
     */
    public function buildSearchFields(SearchFields $sfs, $module, $field, array $defs)
    {
        if (!$this->isEmailField($defs)) {
            return;
        }

        $emailFields = array('primary', 'secondary');
        $multiFields = array('gs_email', 'gs_email_wildcard');

        foreach ($emailFields as $emailField) {
            foreach ($multiFields as $multiField) {
                $sf = new SearchField($module, $defs['name'], $defs);
                $sf->setPath([$this->searchField, $emailField, $multiField]);
                $sfs->addSearchField($sf, $multiField . '_' . $emailField);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSupportedTypes()
    {
        return array('email');
    }

    /**
     * {@inheritdoc}
     */
    public function processDocumentPreIndex(Document $document, \DotbBean $bean)
    {
        // skip if there is no email field
        if (!isset($bean->field_defs['email'])) {
            return;
        }
        $defs = $bean->field_defs['email'];
        if (!$this->isEmailField($defs)) {
            return;
        }

        // Load raw email addresses in prefixed email field to store in ES
        $emails = $this->getEmailAddressesForBean($bean);
        $document->setDataField($document->getType() . Mapping::PREFIX_SEP . 'email', $emails);
        $document->removeDataField('email');

        // Format data for email search fields
        $value = array(
            'primary' => '',
            'secondary' => array(),
        );

        foreach ($emails as $emailAddress) {
            if (!empty($emailAddress['primary_address'])) {
                $value['primary'] = $emailAddress['email_address'];
            } else {
                $value['secondary'][] = $emailAddress['email_address'];
            }
        }

        // Set formatted value in special email search field
        $searchField = $document->getType() . Mapping::PREFIX_SEP . $this->searchField;
        $document->setDataField($searchField, $value);
    }

    /**
     * Get list of email address for given bean
     * @param \DotbBean $bean
     * @return array
     */
    protected function getEmailAddressesForBean(\DotbBean $bean)
    {
        /*
         * Beans extending Person or Company template should have this
         * set automatically. Beans using email addresses without extending
         * from those templates are not supported.
         */
        if (!isset($bean->emailAddress) || !$bean->emailAddress instanceof \DotbEmailAddress) {
            return array();
        }

        // Fetch email addresses from database if needed
        if (empty($bean->emailAddress->hasFetched)) {
            return $this->fetchEmailAddressesFromDatabase($bean);
        }

        return $bean->emailAddress->addresses;
    }

    /**
     * Fetch email addresses from database
     * @param \DotbBean $bean
     * @return array
     */
    protected function fetchEmailAddressesFromDatabase(\DotbBean $bean)
    {
        return \BeanFactory::newBean('EmailAddresses')->getAddressesByGUID($bean->id, $bean->module_name);
    }

    /**
     * Check if given field def is an email field
     * @param array $defs
     * @return boolean
     */
    protected function isEmailField(array $defs)
    {
        return $defs['name'] === 'email' && $defs['type'] === 'email';
    }
}
