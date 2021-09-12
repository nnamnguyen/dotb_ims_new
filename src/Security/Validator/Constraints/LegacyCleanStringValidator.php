<?php


namespace Dotbcrm\Dotbcrm\Security\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 *
 * This validator constraint implements the legacy clean_string
 *
 */
class LegacyCleanStringValidator extends ConstraintValidator
{
    /**
     * List of available filter expressions
     * @var array
     */
    protected $filters = array(
        "STANDARD"        => '#[^A-Z0-9\-_\.\@]#i',
        "STANDARDSPACE"   => '#[^A-Z0-9\-_\.\@\ ]#i',
        "FILE"            => '#[^A-Z0-9\-_\.]#i',
        "NUMBER"          => '#[^0-9\-]#i',
        "SQL_COLUMN_LIST" => '#[^A-Z0-9\(\),_\.]#i',
        "PATH_NO_URL"     => '#://#i',
        "SAFED_GET"		  => '#[^A-Z0-9\@\=\&\?\.\/\-_~+]#i',
        "UNIFIED_SEARCH"  => "#[\\x00]#",
        "AUTO_INCREMENT"  => '#[^0-9\-,\ ]#i',
        "ALPHANUM"        => '#[^A-Z0-9\-]#i',
    );

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof LegacyCleanString) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\LegacyCleanString');
        }

        if (!array_key_exists($constraint->filter, $this->filters)) {
            throw new ConstraintDefinitionException("Unkown filter {$constraint->filter}");
        }

        $this->validateRecursive($constraint, $value);
    }

    /**
     * Apply regex validation filter recursively
     * @param LegacyCleanString $constraint
     * @param mixed $value
     */
    protected function validateRecursive(LegacyCleanString $constraint, $value)
    {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $this->validateRecursive($constraint, $v);
            }
            return;
        }

        if (!is_string($value) || preg_match($this->filters[$constraint->filter], $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%filter%', $constraint->filter)
                ->setInvalidValue($value)
                ->setCode(LegacyCleanString::FILTER_ERROR)
                ->setCause($constraint->filter)
                ->addViolation();
        }
    }
}
