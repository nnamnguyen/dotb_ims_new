<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\DataPrivacy\Erasure\Field;

use DotbBean;
use Dotbcrm\Dotbcrm\DataPrivacy\Erasure\Field;
use Dotbcrm\Dotbcrm\DataPrivacy\Erasure\FieldList;

/**
 * Represents an email field
 */
final class Email implements Field
{
    /**
     * @var string
     */
    private $id;

    /**
     * Constructor
     *
     * @param string $id The ID of the email to be erased
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            'field_name' => 'email',
            'id' => $this->id,
        ];
    }

    /**
     * Erase email from bean, also need to erase the email from all beans which have this email.
     * In order to avoid recursive erasure, we need to break the logic into 2 stages:
     * 1. remove this email from all related beans
     * 2. erase this email from other related beans
     *
     * {@inheritDoc}
     */
    public function erase(DotbBean $bean) : void
    {
        $emailBean = \BeanFactory::getBean('EmailAddresses', $this->id);

        // get all related beans containing this email address
        $relatedBeans = $this->getAllRelatedBeans($emailBean);

        $beansToEraseEmail = [];
        if (!empty($relatedBeans)) {
            // remove the email for related beans first
            foreach ($relatedBeans as $relBean) {
                if (!empty($relBean->emailAddress)) {
                    $relBean->emailAddress->removeAddressById($this->id);
                    $relBean->emailAddress->removeLegacyAddressForBean($relBean, $emailBean->email_address);
                    $relBean->emailAddress->save($relBean->id, $relBean->module_dir);
                    // only select other related beans, not this $bean
                    if ($relBean->id != $bean->id || $bean->getModuleName() != $relBean->getModuleName()) {
                        $beansToEraseEmail[] = $relBean;
                    }
                }
            }

            // erase email from other related beans
            foreach ($beansToEraseEmail as $relBean) {
                $relBean->erase(new FieldList($this), false);
            }
        }

        // erase this email
        $emailBean->erase(FieldList::fromArray(['email_address', 'email_address_caps']), false);
    }

    /**
     * to get all related beans to this email id
     * @param DotbBean $emailBean
     * @return array
     */
    protected function getAllRelatedBeans($emailBean)
    {
        return $emailBean->getRelatedBeansById($emailBean->id);
    }
}
