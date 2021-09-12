<?php

class Comment extends Basic
{
    public $table_name = 'comments';
    public $object_name = 'Comment';
    public $module_name = 'Comments';
    public $module_dir = 'ActivityStream/Comments';

    public $id;
    public $name = '';
    public $date_entered;
    public $date_modified;
    public $parent_id;
    public $data = '{}';
    public $created_by;
    public $created_by_name;

    /**
     * Disable Custom Field lookup since Activity Streams don't support them
     *
     * @var bool
     */
    public $disable_custom_fields = true;

    /**
     * Method that returns a JSON representation of the bean.
     * @return string
     */
    public function toJson()
    {
        global $current_user;

        $this->retrieve();
        $sfh = new DotbFieldHandler();
        $data = array();
        $service = new RestService();
        $service->user = $current_user;
        foreach ($this->field_defs as $fieldName => $properties) {
            $type = !empty($properties['custom_type']) ? $properties['custom_type'] : $properties['type'];

            $field = $sfh->getDotbField($type);
            if ($field != null && isset($this->$fieldName)) {
                $field->apiFormatField($data, $this, array(), $fieldName, $properties, array(), $service);
            }
        }
        return json_encode($data);
    }

    /**
     * Saves the current comment.
     * @param  boolean $check_notify
     * @return string|bool           GUID of saved comment or false.
     */
    public function save($check_notify = false)
    {
        //if a string convert to object
        if (is_string($this->data)) {
            $this->data = json_decode($this->data, true);
        }

        if(!empty($this->data['value'])) {
            $this->data['value'] = DotbCleaner::cleanHtml($this->data['value']);
        }

        if (!is_string($this->data)) {
            $this->data = json_encode($this->data);
        }

        $activity = BeanFactory::getBean('Activities', $this->parent_id);
        if (!empty($activity) && $activity->id) {
            $isNew = (empty($this->id) || $this->new_with_id);
            if (parent::save($check_notify)) {
                if ($isNew) {
                    $activity->addComment($this);
                    $this->processCommentTags($activity);
                }
                return $this->id;
            }
        }
        return false;
    }

    /**
     * Helper for processing tags on a comment and linking the parent activity to the appropriate tagged record(s)
     *
     * @param Activity $activity
     */
    protected function processCommentTags(Activity $activity)
    {
        $data = json_decode($this->data, true);
        if (isset($data['tags'])) {
            $activity->processTags($data['tags']);
        }
    }

    /**
     * Retrieves the Comment specified.
     *
     * DotbBean's signature states that encode is true by default. However, as
     * we store JSON data, we want to modify that behaviour to be false so that
     * the JSON data does not have characters replaced by HTML entities.
     * @param  string  $id      GUID of the Comment record
     * @param  boolean $encode  Encode quotes and other special characters
     * @param  boolean $deleted Flag to allow retrieval of deleted records
     * @return Comment
     */
    public function retrieve($id = '-1', $encode = false, $deleted = true)
    {
        // TODO: Fix this after ENGRD-17 is resolved.
        $encode = false;
        parent::retrieve($id, $encode, $deleted);
        return $this;
    }

    /**
     * Overwrite the notifications handler.
     */
    public function _sendNotifications($check_notify)
    {
        return false;
    }

    public function get_notification_recipients()
    {
        return array();
    }
}
