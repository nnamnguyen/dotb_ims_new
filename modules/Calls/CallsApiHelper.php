<?php

class CallsApiHelper extends DotbBeanApiHelper
{
    public function populateFromApi(DotbBean $bean, array $submittedData, array $options = array())
    {
        $data = parent::populateFromApi($bean, $submittedData, $options);
        $start = strtotime($bean->date_start);

        if ($bean->call_duration == 99999) {
            $end = strtotime($bean->date_end);
            if ($start > $end) throw new DotbApiExceptionMissingParameter('Date end must be after date start');
            $bean->duration = $end - $start;
            $bean->duration_hours = (int)($bean->duration / 3600);
            $bean->duration_minutes = (int)(($bean->duration - $bean->duration_hours * 3600) / 60);
        } elseif ($bean->call_duration != 0) {
            $bean->duration = (int)$bean->call_duration;
            $bean->duration_hours = (int)($bean->duration / 3600);
            $bean->duration_minutes = (int)(($bean->duration - $bean->duration_hours * 3600) / 60);
        } else {
            $bean->duration_hours = $bean->duration_minutes = $bean->duration = 0;
        }

        if ($bean->recall != 0 && $bean->recall != 99999) {
            $bean->recall_at = date("Y-m-d H:i:s", $bean->recall + $start);
        } elseif ($bean->recall == 0) {
            $bean->recall_at = null;
        }

        return $data;
    }
}
