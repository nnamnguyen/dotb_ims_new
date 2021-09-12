<?php


namespace Dotbcrm\Dotbcrm\Security\Context;

use JsonSerializable;
use Dotbcrm\Dotbcrm\Security\Subject;

/**
 * Maintains association between security subject and attributes
 *
 * @internal
 */
class SubjectAttributes implements JsonSerializable
{
    /**
     * @var Subject
     */
    private $subject;

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * Constructor
     *
     * @param Subject $subject
     */
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    /**
     * Returns security subject
     *
     * @return Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Returns associated attributes
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Sets attributes associated with security subject
     *
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        $data = ['subject' => $this->subject->jsonSerialize()];

        if (count($this->attributes)) {
            $data['attributes'] = $this->attributes;
        }

        return $data;
    }
}
