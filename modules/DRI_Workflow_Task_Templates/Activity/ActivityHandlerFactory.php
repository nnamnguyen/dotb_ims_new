<?php

namespace DRI_Workflow_Task_Templates\Activity;

/**
 * Responsible for creating ActivityHandler instances
 *
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class ActivityHandlerFactory
{
    /**
     * Creates the right ActivityHandler for a given module name
     *
     * @param string $moduleName
     * @return ActivityHandlerInterface
     * @throws \InvalidArgumentException
     */
    public static function factory($moduleName)
    {
        $moduleName = is_object($moduleName) && $moduleName instanceof \DotbBean
            ? $moduleName->module_dir
            : $moduleName;

        switch ($moduleName) {
            case 'Tasks':    return new TaskHandler();
            case 'Meetings': return new MeetingHandler();
            case 'Calls':    return new CallHandler();
            default:
                throw new \InvalidArgumentException("unsupported module: {$moduleName}");
        }
    }

    /**
     * Returns a list of all available ActivityHandler's
     *
     * @return ActivityHandlerInterface[]
     */
    public static function all()
    {
        return array (
            new MeetingHandler(),
            new TaskHandler(),
            new CallHandler(),
        );
    }
}
