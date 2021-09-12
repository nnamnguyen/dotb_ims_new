<?php


class EnrollmentLink extends Link2 {
    public function buildJoinDotbQuery($dotb_query, $option = array()) {
        $dotb_query->where()->equals('payment_type', 'Enrollment');
        return $this->relationship->buildJoinDotbQuery($this, $dotb_query, $option);
    }
}