<?php


namespace Dotbcrm\Dotbcrm\Security\Subject\Formatter;

use BeanFactory;
use Localization;
use Dotbcrm\Dotbcrm\Security\Subject\Formatter;
use DotbQuery;

/**
 * Augments data in the set of serialized security subjects with bean names
 */
class BeanFormatter implements Formatter
{
    /**
     * @var Localization
     */
    private $localization;

    /**
     * Constructor
     *
     * @param Localization $localization
     */
    public function __construct(Localization $localization)
    {
        $this->localization = $localization;
    }

    /**
     * {@inheritDoc}
     */
    public function formatBatch(array $subjects)
    {
        $beanRefs = [];

        foreach ($subjects as &$subject) {
            $this->analyzeSubject($subject, $beanRefs);
            unset($subject);
        }

        foreach ($beanRefs as $module => $beans) {
            $data = $this->retrieveRecordNames($module, array_keys($beans));

            foreach ($beans as $id => $refs) {
                if (!isset($data[$id])) {
                    continue;
                }

                foreach ($refs as &$ref) {
                    $ref = array_merge($ref, $data[$id]);
                    unset($ref);
                }
            }
        }

        return $subjects;
    }

    /**
     * Analyzes the given array recursively and extracts references to beans
     *
     * @param array $array
     * @param array $beanRefs
     */
    private function analyzeSubject(&$array, &$beanRefs)
    {
        if (isset($array['_module'], $array['id'])) {
            $beanRefs[$array['_module']][$array['id']][] =& $array;
        }

        foreach ($array as &$value) {
            if (!is_array($value)) {
                continue;
            }

            $this->analyzeSubject($value, $beanRefs);
            unset($value);
        }
    }

    /**
     * Retrieves names of the records
     *
     * @param string $module
     * @param string[] $ids
     * @return array[]
     *
     * @throws \DotbQueryException
     */
    private function retrieveRecordNames($module, $ids)
    {
        $bean = BeanFactory::newBean($module);

        $q = new DotbQuery();
        $q->from($bean);
        $q->select('id', 'name');
        $q->where()->in('id', $ids);

        $data = [];

        foreach ($q->execute() as $row) {
            $id = $row['id'];
            unset($row['id']);

            if (!isset($row['name'])) {
                $row['name'] = $this->localization->formatName($module, $row);
            }

            $data[$id] = $row;
        }

        return $data;
    }
}
