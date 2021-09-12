<?php

class TasksApiHelper extends DotbBeanApiHelper
{
    public function populateFromApi(DotbBean $bean, array $submittedData, array $options = array())
    {
        $data = parent::populateFromApi($bean, $submittedData, $options);

        $start = strtotime($bean->date_start);

        if ($bean->task_duration == 99999) {
            $end = strtotime($bean->date_due);
            if ($start > $end) throw new DotbApiExceptionMissingParameter('Date due must be after date start');
            $bean->duration = $end - $start;
        } elseif ($bean->task_duration != 0) {
            $bean->duration = (int)$bean->task_duration;
        } else {
            $bean->duration = 0;
        }

        return $data;
    }
}
