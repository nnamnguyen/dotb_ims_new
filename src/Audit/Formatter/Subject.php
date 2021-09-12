<?php

namespace Dotbcrm\Dotbcrm\Audit\Formatter;

use Dotbcrm\Dotbcrm\Audit\Formatter;
use Dotbcrm\Dotbcrm\Security\Subject\Formatter as SubjectFormatter;

class Subject implements Formatter
{
    private $formatter;

    public function __construct(SubjectFormatter $formatter = null)
    {
        $this->formatter = $formatter;
    }

    public function formatRows(array &$rows)
    {
        $subjects = array();
        // gather all subjects
        foreach ($rows as $k => $v) {
            if (!empty($v['source']['subject'])) {
                $subjects[$k] = $v['source']['subject'];
            }
        }

        $formattedSubjects = $this->formatter->formatBatch($subjects);

        // merge formatted subjects into rows
        foreach ($formattedSubjects as $k => $v) {
            $rows[$k]['source']['subject'] = $v;
        }

        return $rows;
    }
}
