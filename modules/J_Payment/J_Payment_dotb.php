<?php

/**
 * THIS CLASS IS GENERATED BY MODULE BUILDER
 * PLEASE DO NOT CHANGE THIS CLASS
 * PLACE ANY CUSTOMIZATIONS IN J_Payment
 */


class J_Payment_dotb extends Basic {
    public $new_schema = true;
    public $module_dir = 'J_Payment';
    public $object_name = 'J_Payment';
    public $table_name = 'j_payment';
    public $importable = true;
    public $team_id;
    public $team_set_id;
    public $acl_team_set_id;
    public $team_count;
    public $team_name;
    public $acl_team_names;
    public $team_link;
    public $team_count_link;
    public $teams;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $tag;
    public $tag_link;
    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $activities;
    public $following;
    public $following_link;
    public $my_favorite;
    public $favorite_link;
    public $locked_fields;
    public $locked_fields_link;
    public $payment_type;
    public $payment_date;
    public $number_of_payment;
    public $moving_tran_out_date;
    public $moving_tran_in_date;
    public $number_class;
    public $sale_type;
    public $sale_type_date;
    public $start_study;
    public $end_study;
    public $class_start;
    public $class_end;
    public $sessions;
    public $tuition_fee;
    public $currency_id;
    public $base_rate;
    public $paid_amount;
    public $amount_bef_discount;
    public $discount_amount;
    public $remaining_freebalace;
    public $discount_percent;
    public $ratio;
    public $total_after_discount;
    public $deposit_amount;
    public $payment_amount;
    public $tuition_hours;
    public $paid_hours;
    public $total_hours;
    public $payment_expired;
    public $class_string;
    public $level_string;
    public $kind_of_course_string;
    public $final_sponsor;
    public $final_sponsor_percent;
    public $loyalty_amount;
    public $loyalty_percent;
    public $used_hours;
    public $remain_hours;
    public $used_amount;
    public $remain_amount;
    public $payment_list;
    public $note;
    public $outstanding_list;
    public $do_not_drop_revenue;
    public $is_installment;
    public $is_corporate;
    public $is_free_book;
    public $is_outstanding;
    public $is_outing;
    public $status;
    public $installment_plan;
    public $installment_fee;
    public $refund_revenue;
    public $use_type;
    public $catch_limit;
    public $kind_of_course;
    public $h_w;
    public $is_convert;
    public $remain_days;
    public $total_days;
    public $used_days;
    public $duration_exp;
    public $af_duration_exp;

    public function bean_implements($interface){
        switch($interface){
            case 'ACL': return true;
        }
        return false;
    }

}
