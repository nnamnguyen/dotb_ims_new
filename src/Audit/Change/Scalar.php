<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Audit\Change;

use Dotbcrm\Dotbcrm\Audit\Change;

/**
 * Represents a scalar field stored on the bean itself
 */
class Scalar implements Change
{
    /**
     * @var string
     */
    private $name;

    private $dataType;

    private $before;

    private $after;


    /**
     * Scalar constructor.
     *
     * @param string $name name of field
     * @param string $type type of field (bool, int, enum, ...)
     * @param string|int|float|bool|null $before value (or null) of field before update
     * @param string|int|float|bool|null $after value (or null) of field after update
     */
    public function __construct(string $name, string $type, $before, $after)
    {
        $this->name = $name;
        $this->dataType = $type;
        $this->before = $before;
        $this->after = $after;
    }

    /**
     * Create a Scalar Audit Field entry from a change array entry
     * @param array $change {
     *    @type string $field_name name of field which changed
     *    @type string $data_type type of field which changed
     *    @type string|null $before value of field before save
     *    @type string|null $after of field after save
     * }
     *
     * @return array|Array<Scalar>
     */
    public static function getAuditFieldChanges(array $change)
    {
        //cast null values to empty string
        return [
            new self(
                $change['field_name'],
                $change['data_type'],
                $change['before'],
                $change['after']
            ),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return $this->getChangeArray();
    }

    /**
     * @return array This Audit Field entry in change array format
     */
    public function getChangeArray()
    {
        return [
            'field_name' => $this->name,
            'data_type' => $this->dataType,
            'before' => $this->before,
            'after' => $this->after,
        ];
    }
}
