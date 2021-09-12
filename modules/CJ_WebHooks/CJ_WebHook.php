<?php

require_once 'modules/CJ_WebHooks/Request.php';

use CJ_WebHooks\Request;

class CJ_WebHook extends Basic
{
    /**
     * @param DotbBean $parent
     * @param string $trigger_event
     * @param array $data
     * @throws DotbApiException
     * @throws DotbQueryException
     */
    public static function send(\DotbBean $parent, $trigger_event, array $data)
    {
        $GLOBALS['log']->debug("Sending web hook: {$parent->module_dir}:{$parent->id}:$trigger_event");

        $results = self::getWebHooksByParent($parent->module_dir, $parent->id, $trigger_event);

        foreach ($results as $result) {
            /** @var \CJ_WebHook $webHook */
            $webHook = BeanFactory::retrieveBean('CJ_WebHooks', $result['id']);

            if ($webHook) {
                $data['trigger_event'] = $trigger_event;
                $data['web_hook_id'] = $webHook->id;
                $data['current_user_id'] = $GLOBALS['current_user']->id;
                $request = new Request($webHook);
                $request->send($data);
            }
        }
    }

    /**
     * @param DotbBean $parent
     * @param DotbBean $parentBase
     */
    public static function copyWebHooks(DotbBean $parent, DotbBean $parentBase) {
        $parentBase->load_relationship("web_hooks");
        foreach ($parentBase->web_hooks->getBeans() as $webHookBase) {
            /** @var \CJ_WebHook $webHook */
            $webHook = clone $webHookBase;
            $webHook->id = \Dotbcrm\Dotbcrm\Util\Uuid::uuid4();
            $webHook->new_with_id = true;
            $webHook->parent_id = $parent->id;
            $webHook->parent_name = $parent->name;
            $webHook->parent_type = $parent->module_dir;
            $webHook->save();
            BeanFactory::unregisterBean($webHook);
        }
    }

    /**
     * @param DotbBean $parent
     */
    public static function deleteWebHooks(DotbBean $parent) {
        $parent->load_relationship("web_hooks");
        foreach ($parent->web_hooks->getBeans() as $webHook) {
            /** @var \CJ_WebHook $webHook */
            $webHook->mark_deleted($webHook->id);
        }
    }

    /**
     * @param string $parent_type
     * @param string $parent_id
     * @param string $trigger_event
     * @return array
     * @throws DotbQueryException
     */
    private static function getWebHooksByParent($parent_type, $parent_id, $trigger_event)
    {
        $key = self::getWebHooksByParentCacheKey($parent_type, $parent_id, $trigger_event);
        $results = dotb_cache_retrieve($key);

        if (is_array($results)) {
            return $results;
        }

        $query = new DotbQuery();
        $query->from(BeanFactory::newBean('CJ_WebHooks'));
        $query->select('id');
        $query->orderBy("sort_order", "asc");
        $query->where()
            ->equals('active', true)
            ->equals('trigger_event', $trigger_event)
            ->equals('parent_type', $parent_type)
            ->equals('parent_id', $parent_id);

        $results = $query->execute();
        dotb_cache_put($key, $results, 2592000);

        return $results;
    }

    /**
     * @param $parent_type
     * @param $parent_id
     * @param $trigger_event
     * @return string
     */
    private static function getWebHooksByParentCacheKey($parent_type, $parent_id, $trigger_event)
    {
        return "CJ_WebHook::getWebHooksByParent[$parent_type][$parent_id][$trigger_event]";
    }

    /**
     * @param $parent_type
     * @param $parent_id
     * @param $trigger_event
     * @return string
     */
    private static function clearWebHooksByParentCache($parent_type, $parent_id, $trigger_event)
    {
        $key = self::getWebHooksByParentCacheKey($parent_type, $parent_id, $trigger_event);
        $GLOBALS['log']->debug("Clearing CJ Web Hook cache key: $key");
        dotb_cache_clear($key);
    }

    const TABLE_NAME = 'cj_web_hooks';

    const REQUEST_METHOD_GET = 'GET';
    const REQUEST_METHOD_POST = 'POST';
    const REQUEST_METHOD_PUT = 'PUT';
    const REQUEST_METHOD_PATCH = 'PATCH';
    const REQUEST_METHOD_DELETE = 'DELETE';

    const TRIGGER_EVENT_BEFORE_CREATE = 'before_create';
    const TRIGGER_EVENT_AFTER_CREATE = 'after_create';
    const TRIGGER_EVENT_BEFORE_DELETE = 'before_delete';
    const TRIGGER_EVENT_AFTER_DELETE = 'after_delete';
    const TRIGGER_EVENT_BEFORE_IN_PROGRESS = 'before_in_progress';
    const TRIGGER_EVENT_AFTER_IN_PROGRESS = 'after_in_progress';
    const TRIGGER_EVENT_BEFORE_COMPLETED = 'before_completed';
    const TRIGGER_EVENT_AFTER_COMPLETED = 'after_completed';
    const TRIGGER_EVENT_BEFORE_NOT_APPLICABLE = 'before_not_applicable';
    const TRIGGER_EVENT_AFTER_NOT_APPLICABLE = 'after_not_applicable';

    const REQUEST_FORMAT_JSON = 'json';
    const REQUEST_FORMAT_HTTP_QUERY = 'http_query';

    const RESPONSE_FORMAT_JSON = 'json';
    const RESPONSE_FORMAT_HTTP_QUERY = 'http_query';
    const RESPONSE_FORMAT_TEXT = 'text';

    public $disable_row_level_security = false;
    public $new_schema = true;
    public $module_dir = 'CJ_WebHooks';
    public $object_name = 'CJ_WebHook';
    public $table_name = self::TABLE_NAME;
    public $importable = true;

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
    public $tag;
    public $tag_link;
    public $commentlog;
    public $commentlog_link;
    public $locked_fields;
    public $locked_fields_link;
    public $team_id;
    public $team_set_id;
    public $acl_team_set_id;
    public $team_count;
    public $team_name;
    public $acl_team_names;
    public $team_link;
    public $team_count_link;
    public $teams;
    public $url;
    public $request_method;
    public $request_format;
    public $response_format;
    public $trigger_event;
    public $error_message_path;
    public $headers;
    public $ignore_errors;
    public $parent_type;
    public $parent_id;
    public $parent_name;
    public $sort_order;

    /**
     * @param string $interface
     * @return boolean
     */
    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return true;
        }

        return false;
    }

    /**
     * @param bool $check_notify
     * @return string
     */
    public function save($check_notify = false)
    {
        $return = parent::save($check_notify);

        self::clearWebHooksByParentCache(
            $this->parent_type,
            $this->parent_id,
            $this->trigger_event
        );

        return $return;
    }

    /**
     * @param string $id
     */
    public function mark_deleted($id)
    {
        parent::mark_deleted($id);

        self::clearWebHooksByParentCache(
            $this->parent_type,
            $this->parent_id,
            $this->trigger_event
        );
    }
}
