<?php

require_once "modules/DRI_Workflow_Task_Templates/Activity/ActivityHandlerFactory.php";
require_once "modules/DRI_Workflow_Task_Templates/Activity/ActivityHandlerInterface.php";
require_once "modules/DRI_Workflows/Exception/InvalidLicenseException.php";

use DRI_Workflow_Task_Templates\Activity\ActivityHandlerFactory;
use DRI_Workflow_Task_Templates\Activity\ActivityHandlerInterface;
use DRI_Workflows\Exception\InvalidLicenseException;

/**
 * This class contains logic hooks related to the
 * Customer Insight plugin for the activity modules
 *
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRI_Workflow_Task_Templates_Activity_ActivityHooks
{
    /**
     * @var bool
     */
    private static $inReorderActivities = false;

    /**
     * @var bool
     */
    private static $internalSave = false;

    /**
     * @var array
     */
    private static $disabled = array ();

    /**
     * @param string $id
     */
    public static function disable($id)
    {
        self::$disabled[$id] = true;
    }

    /**
     * @param string $id
     */
    public static function enable($id)
    {
        unset(self::$disabled[$id]);
    }

    /**
     * @param boolean $internalSave
     */
    public static function setInternalSave($internalSave)
    {
        self::$internalSave = $internalSave;
    }

    /**
     * before_save logic hook
     *
     * Stores the fetched row on the bean before save to
     * make it available for after save logic hooks
     *
     * @param \DotbBean $activity
     */
    public function saveFetchedRow(\DotbBean $activity)
    {
        $activity->fetched_row_before = $activity->fetched_row;
    }

    /**
     * @param DotbBean $activity
     */
    public function setActualSortOrder(\DotbBean $activity)
    {
        try {
            if (self::$inReorderActivities) {
                $GLOBALS['log']->error('setActualSortOrder: $inReorderActivities');
                return;
            }

            if (self::$internalSave) {
                $GLOBALS['log']->error('setActualSortOrder: $internalSave');
                return;
            }

            $handler = ActivityHandlerFactory::factory($activity->module_dir);

            if (!$handler->isStageActivity($activity)) {
                $GLOBALS['log']->error('setActualSortOrder: isStageActivity');
                return;
            }

            $handler->setActualSortOrder($activity);
        }
        catch (InvalidLicenseException $e) {
            // omit errors when license is not valid or user missing access
        }
        catch (\DRI_Workflows_Exception_IdNotFound $e) {
            $GLOBALS['log']->error('CJ: journey not found - '.$activity->id);
        }
        catch (\DRI_SubWorkflows_Exception_IdNotFound $e) {
            // this error gets thrown when a complete journey/stage is deleted since the related stage has already
            // been deleted when updating the activities relationships, it's not a real error so we can just skip it
            $GLOBALS['log']->info('CJ: stage not found - id - '.$activity->id);
        }
    }

    /**
     * @param DotbBean $activity
     * @throws DotbApiExceptionError
     */
    public function beforeStatusChange(\DotbBean $activity)
    {
        try {
            if (self::$inReorderActivities) {
                $GLOBALS['log']->error('beforeStatusChange: $inReorderActivities');
                return;
            }

            if (self::$internalSave) {
                $GLOBALS['log']->error('beforeStatusChange: $internalSave');
                return;
            }

            $handler = ActivityHandlerFactory::factory($activity->module_dir);

            if (!$handler->isStageActivity($activity)) {
                $GLOBALS['log']->error('beforeStatusChange: isStageActivity');
                return;
            }

            if ($this->isNew($activity)) {
                $GLOBALS['log']->error('beforeStatusChange: isNew');
                return;
            }

            if (!$handler->haveChangedStatus($activity) && $handler->haveChangedPoints($activity)) {
                $GLOBALS['log']->error('beforeStatusChange: haveChangedStatus');
                return;
            }

            $this->beforeCompleted($handler, $activity);
            $this->beforeNotApplicable($handler, $activity);
            $this->beforeInProgress($handler, $activity);
        }
        catch (InvalidLicenseException $e) {
            // omit errors when license is not valid or user missing access
        }
        catch (\DRI_Workflows_Exception_IdNotFound $e) {
            $GLOBALS['log']->error('CJ: journey not found - '.$activity->id);
        }
        catch (\DRI_SubWorkflows_Exception_IdNotFound $e) {
            // this error gets thrown when a complete journey/stage is deleted since the related stage has already
            // been deleted when updating the activities relationships, it's not a real error so we can just skip it
            $GLOBALS['log']->info('CJ: stage not found - id - '.$activity->id);
        }
    }

    /**
     * after_save logic hook
     *
     * Re saves the related DRI_SubWorkflow when the task's status gets updated
     *
     * Also triggers the completed events if applicable
     *
     * @param \DotbBean $activity
     * @throws DRI_SubWorkflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_ParentNotFound
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidParameter
     * @throws DotbQueryException
     */
    public function resaveIfChanged(\DotbBean $activity)
    {
        try {
            if (self::$inReorderActivities) {
                return;
            }

            if (self::$internalSave) {
                return;
            }

            $handler = ActivityHandlerFactory::factory($activity->module_dir);

            if (!$handler->isStageActivity($activity)) {
                return;
            }

            if ($this->isNew($activity)) {
                return;
            }

            if (!$handler->haveChangedStatus($activity) && $handler->haveChangedPoints($activity)) {
                return;
            }

            /** @var DRI_Workflow $journey */
            /** @var DRI_SubWorkflow $stage */
            list($journey, $stage) = $this->getJourney($activity);

            // load the complete journey and make sure that the
            // saved activity is inserted to the objects loaded into memory
            $journey->load();
            $journey->insertActivity($activity);

            $this->afterCompleted($journey, $stage, $handler, $activity);
            $this->afterNotApplicable($handler, $activity);
            $this->afterInProgress($handler, $activity);

            $this->doResave($journey, $handler, $activity);
        }
        catch (InvalidLicenseException $e) {
            // omit errors when license is not valid or user missing access
        }
        catch (\DRI_Workflows_Exception_IdNotFound $e) {
            $GLOBALS['log']->error('CJ: journey not found - '.$activity->id);
        }
        catch (\DRI_SubWorkflows_Exception_IdNotFound $e) {
            // this error gets thrown when a complete journey/stage is deleted since the related stage has already
            // been deleted when updating the activities relationships, it's not a real error so we can just skip it
            $GLOBALS['log']->info('CJ: stage not found - id - '.$activity->id);
        }
    }

    /**
     * @param DRI_Workflow $journey
     * @param DRI_SubWorkflow $stage
     * @param ActivityHandlerInterface $handler
     * @param \DotbBean $activity
     */
    private function afterCompleted(
        DRI_Workflow $journey,
        DRI_SubWorkflow $stage,
        ActivityHandlerInterface $handler,
        DotbBean $activity
    ) {
        if ($handler->haveChangedStatus($activity) && $handler->isCompleted($activity)) {
            $GLOBALS['log']->debug('CJ: activity after completed - '.$activity->id);
            $handler->afterCompleted($journey, $stage, $activity);
        }
    }

    /**
     * @param ActivityHandlerInterface $handler
     * @param \DotbBean $activity
     */
    private function beforeCompleted(
        ActivityHandlerInterface $handler,
        DotbBean $activity
    ) {
        if ($handler->haveChangedStatus($activity) && $handler->isCompleted($activity)) {
            $GLOBALS['log']->debug('CJ: activity before completed - '.$activity->id);
            $handler->beforeCompleted($activity);
        }
    }

    /**
     * @param ActivityHandlerInterface $handler
     * @param \DotbBean $activity
     */
    private function afterInProgress(
        ActivityHandlerInterface $handler,
        DotbBean $activity
    ) {
        if ($handler->haveChangedStatus($activity) && $handler->isInProgress($activity)) {
            $GLOBALS['log']->debug('CJ: activity after in progress - '.$activity->id);
            $handler->afterInProgress($activity);
        }
    }

    /**
     * @param ActivityHandlerInterface $handler
     * @param \DotbBean $activity
     */
    private function beforeInProgress(
        ActivityHandlerInterface $handler,
        DotbBean $activity
    ) {
        if ($handler->haveChangedStatus($activity) && $handler->isInProgress($activity)) {
            $GLOBALS['log']->debug('CJ: activity before in progress - '.$activity->id);
            $handler->beforeInProgress($activity);
        }
    }

    /**
     * @param ActivityHandlerInterface $handler
     * @param \DotbBean $activity
     */
    private function afterNotApplicable(
        ActivityHandlerInterface $handler,
        DotbBean $activity
    ) {
        if ($handler->haveChangedStatus($activity) && $handler->isNotApplicable($activity)) {
            $GLOBALS['log']->debug('CJ: activity after not applicable - '.$activity->id);
            $handler->afterNotApplicable($activity);
        }
    }

    /**
     * @param ActivityHandlerInterface $handler
     * @param \DotbBean $activity
     */
    private function beforeNotApplicable(
        ActivityHandlerInterface $handler,
        DotbBean $activity
    ) {
        if ($handler->haveChangedStatus($activity) && $handler->isNotApplicable($activity)) {
            $GLOBALS['log']->debug('CJ: activity before not applicable - '.$activity->id);
            $handler->beforeNotApplicable($activity);
        }
    }

    /**
     * after_save logic hook
     *
     * @param \DotbBean $activity
     * @throws DRI_SubWorkflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_ParentNotFound
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidParameter
     * @throws DotbQueryException
     */
    public function resave(\DotbBean $activity)
    {
        try {
            if (isset(self::$disabled[$activity->id])) {
                return;
            }

            $handler = ActivityHandlerFactory::factory($activity->module_dir);

            if (!$handler->isStageActivity($activity)) {
                return;
            }

            list($journey, $stage) = $this->getJourney($activity);
            $this->doResave($journey, $handler, $activity);
        } catch (InvalidLicenseException $e) {
            // omit errors when license is not valid or user missing access
        }
        catch (\DRI_Workflows_Exception_IdNotFound $e) {
            $GLOBALS['log']->error('CJ: journey not found - '.$activity->id);
        }
        catch (\DRI_SubWorkflows_Exception_IdNotFound $e) {
            // this error gets thrown when a complete journey/stage is deleted since the related stage has already
            // been deleted when updating the activities relationships, it's not a real error so we can just skip it
            $GLOBALS['log']->info('CJ: stage not found - id - '.$activity->id);
        }
    }

    /**
     * @param DotbBean $activity
     */
    public function removeChildren(\DotbBean $activity)
    {
        $handler = ActivityHandlerFactory::factory($activity->module_dir);

        if ($handler->isStageActivity($activity) && $handler->isParent($activity)) {
            $children = $handler->getChildren($activity);

            foreach ($children as $child) {
                $child->mark_deleted($child->id);
            }
        }
    }

    /**
     * @param DotbBean $activity
     */
    public function beforeDelete(\DotbBean $activity)
    {
        $handler = ActivityHandlerFactory::factory($activity->module_dir);

        if ($handler->isStageActivity($activity)) {
            $handler->beforeDelete($activity);
        }
    }

    /**
     * @param DotbBean $activity
     */
    public function afterDelete(\DotbBean $activity)
    {
        $handler = ActivityHandlerFactory::factory($activity->module_dir);

        if ($handler->isStageActivity($activity)) {
            $handler->afterDelete($activity);
        }
    }

    /**
     * Re saves the parent journey
     *
     * @param DRI_Workflow $journey
     * @param ActivityHandlerInterface $handler
     * @param \DotbBean $activity
     * @throws DRI_SubWorkflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_ParentNotFound
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidParameter
     * @throws DotbQueryException
     */
    private function doResave(DRI_Workflow $journey, ActivityHandlerInterface $handler, \DotbBean $activity)
    {
        try {
            if ($handler->hasParent($activity)) {
                $parent = $handler->getParent($activity);

                if ($parent) {
                    $handler = ActivityHandlerFactory::factory($parent->module_dir);

                    $handler->insertChild($parent, $activity);
                    $handler->calculate($parent);
                    $handler->calculateStatus($parent);

                    if ($handler->isPointsChanged($parent)
                        || $handler->isStatusChanged($parent)
                        || $handler->isScoreChanged($parent)
                        || $handler->isProgressChanged($parent)
                        || empty($parent->is_cj_parent_activity)) {
                        $parent->is_cj_parent_activity = true;
                        $parent->save();
                    }
                }
            }

            if (!isset(self::$disabled[$journey->id])) {
                $GLOBALS['log']->debug('CJ: saving journey - '.$activity->id);
                $journey->save();
            }
        }
        catch (InvalidLicenseException $e) {
            // omit errors when license is not valid or user missing access
        }
        catch (\DRI_Workflows_Exception_IdNotFound $e) {
            $GLOBALS['log']->error('CJ: journey not found - '.$activity->id);
        }
        catch (\DRI_SubWorkflows_Exception_IdNotFound $e) {
            // this error gets thrown when a complete journey/stage is deleted since the related stage has already
            // been deleted when updating the activities relationships, it's not a real error so we can just skip it
            $GLOBALS['log']->info('CJ: stage not found - id - '.$activity->id);
        }
    }

    /**
     * @param DotbBean $activity
     * @return array
     * @throws DRI_Workflows_Exception_IdNotFound
     */
    private function getJourney(\DotbBean $activity)
    {
        $handler = ActivityHandlerFactory::factory($activity->module_dir);

        $stage = $handler->getStage($activity);
        $GLOBALS['log']->debug('CJ: stage found - '.$activity->id);

        $journey = $stage->getJourney();
        $GLOBALS['log']->debug('CJ: journey found - '.$activity->id);

        return array ($journey, $stage);
    }

    /**
     * before_save logic hook
     *
     * @param \DotbBean $activity
     */
    public function calculate(\DotbBean $activity)
    {
        try {
            $handler = ActivityHandlerFactory::factory($activity->module_dir);

            if (!$handler->isStageActivity($activity)) {
                return;
            }

            $handler->calculate($activity);
        } catch (InvalidLicenseException $e) {
            // omit errors when license is not valid or user missing access
        }
    }

    /**
     * @param DotbBean $activity
     */
    public function calculateMomentum(\DotbBean $activity)
    {
        try {
            $handler = ActivityHandlerFactory::factory($activity->module_dir);

            if (!$handler->isStageActivity($activity)) {
                return;
            }

            if (!$handler->hasMomentum($activity)) {
                return;
            }

            if (!$handler->hasActivityTemplate($activity)) {
                return;
            }

            $handler->calculateMomentum($activity);
        } catch (InvalidLicenseException $e) {
            // omit errors when license is not valid or user missing access
        }
    }

    /**
     * before_save logic hook
     *
     * @param \DotbBean $bean
     * @throws DotbQueryException
     */
    public function reorder(\DotbBean $bean)
    {
        try {
            if (self::$inReorderActivities) {
                return;
            }

            if (self::$internalSave) {
                return;
            }

            $activityHandler = ActivityHandlerFactory::factory($bean->module_dir);

            if (!$activityHandler->isStageActivity($bean)) {
                return;
            }

            if (!$this->orderExistOnStage($bean)) {
                return;
            }

            $stage = $activityHandler->getStage($bean);
            $order = (int)$activityHandler->getSortOrder($bean);

            self::$inReorderActivities = true;

            $i = -1;

            foreach ($stage->getActivities() as $activity) {
                $handler = ActivityHandlerFactory::factory($activity->module_dir);
                $sortOrder = (int)$handler->getSortOrder($activity);

                // start sequence check on the duplicated index
                if ($sortOrder === $order) {
                    $i = $order;
                } elseif ($sortOrder > $order) {
                    $i++;
                }

                if ($sortOrder >= $order && $activity->id !== $bean->id && $sortOrder === $i) {
                    $handler->increaseSortOrder($activity);
                    $activity->save();
                }
            }

            self::$inReorderActivities = false;
        } catch (InvalidLicenseException $e) {
            // omit errors when license is not valid or user missing access
        }
    }

    /**
     * @param \DotbBean $activity
     * @return bool
     * @throws DotbQueryException
     */
    private function orderExistOnStage(\DotbBean $activity)
    {
        $activityHandler = ActivityHandlerFactory::factory($activity->module_dir);

        foreach (ActivityHandlerFactory::all() as $handler) {
            if ($handler->orderExistOnStage($activityHandler->getStageId($activity), $activityHandler->getSortOrder($activity), $activity->id)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Checks if the bean in its current state is new
     *
     * @param \DotbBean $activity
     * @return boolean
     */
    protected function isNew(\DotbBean $activity)
    {
        return empty($activity->id) || (!empty($activity->id) && !empty($activity->new_with_id));
    }

    /**
     * before_save logic hook
     *
     * validates the activity
     *
     * @param \DotbBean $activity
     * @throws \DotbApiExceptionInvalidParameter
     * @throws DRI_Workflows_Exception_IdNotFound
     */
    public function validate(\DotbBean $activity)
    {
        try {
            if (self::$inReorderActivities) {
                return;
            }

            if (self::$internalSave) {
                return;
            }

            $activityHandler = ActivityHandlerFactory::factory($activity->module_dir);

            if (!$activityHandler->isStageActivity($activity)) {
                return;
            }

            $GLOBALS['log']->info('CJ: validating activity - '.$activity->id);
            $this->validateUniqueName($activity, $activityHandler);
            $this->validateDependency($activity, $activityHandler);
        } catch (InvalidLicenseException $e) {
            // omit errors when license is not valid or user missing access
        }
    }

    /**
     * @param \DotbBean $activity
     * @param ActivityHandlerInterface $activityHandler
     * @throws \DotbApiExceptionInvalidParameter
     * @throws DRI_Workflows_Exception_IdNotFound
     */
    protected function validateDependency(\DotbBean $activity, ActivityHandlerInterface $activityHandler)
    {
        // only perform this check if the activity is blocked
        // and the status is changed to completed/in progress/not applicable.
        // we should do the simple check if the status is changed
        // first to not cause an performance impact for non status updates
        if (!$activityHandler->haveChangedStatus($activity)
            || (!$activityHandler->isCompleted($activity)
            && !$activityHandler->isInProgress($activity)
            && !$activityHandler->isNotApplicable($activity))) {
            return;
        }

        if ($activityHandler->isBlocked($activity)) {
            $stage = $activityHandler->getStage($activity);
            $journey = $stage->getJourney();

            $names = array ();
            foreach ($activityHandler->getBlockedBy($activity) as $blockedBy) {
                $names[] = $blockedBy->name;
            }

            throw new \DotbApiExceptionInvalidParameter(sprintf(
                'This record cannot be completed because it is blocked by an activity in a Customer Insight. Please complete "%s" in the "%s" journey.',
                implode(', ', $names),
                $journey->name
            ));
        }
    }

    /**
     * @param \DotbBean $activity
     * @param ActivityHandlerInterface $activityHandler
     * @throws \DotbApiExceptionInvalidParameter
     */
    protected function validateUniqueName(\DotbBean $activity, ActivityHandlerInterface $activityHandler)
    {
        try {
            $activityHandler->getByStageIdAndName(
                $activityHandler->getStageId($activity),
                $activity->name,
                $activity->id
            );

            throw new \DotbApiExceptionInvalidParameter(sprintf(
                'Activity with name %s does already exist',
                $activity->name
            ));
        } catch (\DotbApiExceptionNotFound $e) {}
    }
}
