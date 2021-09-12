<?php

namespace CJ_Forms;

class TargetResolver
{
    /**
     * @var \CJ_Form
     */
    private $action;

    /**
     * RelationshipFinder constructor.
     * @param \CJ_Form $action
     */
    public function __construct(\CJ_Form $action)
    {
        $this->action = $action;
    }

    /**
     * @param \DotbBean $parent
     * @param \DotbBean $target
     * @return array
     */
    public function resolve(\DotbBean $parent, \DotbBean $target)
    {
        $linkName = null;
        $module = null;

        $rels = json_decode($this->action->relationship, true);

        foreach ($rels as $rel) {
            $module = $rel['module'];

            if ($rel['relationship'] === 'self') {
                break;
            }

            $linkName = $rel['relationship'];

            $target->load_relationship($linkName);

            /** @var \Link2 $link */
            $link = $target->{$linkName};

            if (empty($link)) {
                throw new \DotbApiExceptionError("Unable to load link: {$linkName}");
            }

            $beans = $link->getBeans();

            // todo - refactor this logic, it's error prone
            if (!empty($beans)) {
                $parent = $target;
                $target = array_shift($beans);
            } else {
                $parent = $target;
                $target = \BeanFactory::newBean($module);
            }
        }

        return array (
            'parent' => $parent,
            'target' => $target,
            'linkName' => $linkName,
            'module' => $module,
        );
    }
}
