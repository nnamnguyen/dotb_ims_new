<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Audit\Change;

use Dotbcrm\Dotbcrm\Audit\Change;

/**
 * Represents an email field
 */
class Email implements Change
{
    /**
     * @var string
     */
    private $before;
    private $after;

    /**
     * Constructor
     *
     * @param string $id The ID of the email to be erased
     */
    public function __construct(?string $before, ?string $after)
    {
        $this->before = $before;
        $this->after = $after;
    }

    /**
     * @inheritdoc
     */
    public static function getAuditFieldChanges(array $change)
    {
        $emailChanges = [];
        $before_addresses = [];
        $after_addresses = [];

        if (is_array($change['before'])) {
            $before_addresses = array_column($change['before'], 'email_address_id');
        }
        if (is_array($change['after'])) {
            $after_addresses = array_column($change['after'], 'email_address_id');
        }

        //Check for removed addresses
        foreach (array_diff($before_addresses, $after_addresses) as $id) {
            $emailChanges[] = new self($id, null);
        }
        //Check for added addresses
        foreach (array_diff($after_addresses, $before_addresses) as $id) {
            $emailChanges[] = new self(null, $id);
        }

        return $emailChanges;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return $this->getChangeArray();
    }

    public function getChangeArray()
    {
        return [
            'field_name' => 'email',
            'data_type' => 'email',
            'before' => $this->before,
            'after' => $this->after,
        ];
    }
}
