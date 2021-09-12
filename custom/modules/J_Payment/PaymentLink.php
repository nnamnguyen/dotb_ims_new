<?php


class PaymentLink extends Link2 {
    public function buildJoinDotbQuery($dotb_query, $option = array()) {
        $dotb_query->where()->notEquals('payment_type', 'Enrollment');
        return $this->relationship->buildJoinDotbQuery($this, $dotb_query, $option);
    }
}