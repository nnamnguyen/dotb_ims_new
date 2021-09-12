<?php

namespace DRI_Workflow_Task_Templates\Activity;

/**
 * Describes the interface all activity handlers must
 * implement to be compatible with the Customer Insight
 *
 * This layer provides a consistent interface to managing actions that should behave
 * differently depending on what kind of activity module
 *
 * Using this structure makes it possible to add new activity modules
 * or similar in the future by either extending one of the existing
 * abstract classes or create a completely new implementation of this interface.
 * 
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
interface ActivityHandlerInterface
{
    /**
     * @return string
     */
    public function getModuleName();

    /**
     * Checks if a activity is completed
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function isCompleted(\DotbBean $activity);

    /**
     * Checks if a activity is completed
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function isNotApplicable(\DotbBean $activity);

    /**
     * Checks if a activity is started
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function isInProgress(\DotbBean $activity);

    /**
     * Checks if a activity have changed status
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function haveChangedStatus(\DotbBean $activity);

    /**
     * Checks if a activity have changed points
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function haveChangedPoints(\DotbBean $activity);

    /**
     * Checks if a activity is blocked by another activity in the journey
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function isBlocked(\DotbBean $activity);

    /**
     * Checks if a activity template is configured with a blocked activity
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function hasBlockedBy(\DotbBean $activity);

    /**
     * Retrieves the activities in the journey that given activity is blocked by
     *
     * @param \DotbBean $activity
     * @return \DotbBean[]
     */
    public function getBlockedBy(\DotbBean $activity);

    /**
     * Retrieves the activity template ids in the journey that given activity is blocked by
     *
     * @param \DotbBean $activity
     * @return string[]
     */
    public function getBlockedByIds(\DotbBean $activity);

    /**
     * Retrieves the activity ids in the journey that given activity is blocked by
     *
     * @param \DotbBean $activity
     * @return string[]
     */
    public function getBlockedByActivityIds(\DotbBean $activity);

    /**
     * Gets called when a activity gets started
     *
     * @param \DotbBean $activity
     * @return bool true if the activity needs to be saved
     */
    public function start(\DotbBean $activity);

    /**
     * Gets called when a activity gets completed (after save)
     *
     * @param \DRI_Workflow $journey
     * @param \DRI_SubWorkflow $stage
     * @param \DotbBean $activity
     */
    public function afterCompleted(\DRI_Workflow $journey, \DRI_SubWorkflow $stage, \DotbBean $activity);

    /**
     * Gets called when a activity gets completed (before save)
     *
     * @param \DotbBean $activity
     */
    public function beforeCompleted(\DotbBean $activity);

    /**
     * Gets called when a activity gets InProgress (after save)
     *
     * @param \DotbBean $activity
     */
    public function afterInProgress(\DotbBean $activity);

    /**
     * Gets called when a activity gets InProgress (before save)
     *
     * @param \DotbBean $activity
     */
    public function beforeInProgress(\DotbBean $activity);

    /**
     * Gets called when a activity gets NotApplicable (after save)
     *
     * @param \DotbBean $activity
     */
    public function afterNotApplicable(\DotbBean $activity);

    /**
     * Gets called when a activity gets InProgress (before save)
     *
     * @param \DotbBean $activity
     */
    public function beforeNotApplicable(\DotbBean $activity);

    /**
     * Gets called when a activity gets deleted (after save)
     *
     * @param \DotbBean $activity
     */
    public function afterDelete(\DotbBean $activity);

    /**
     * Gets called when a activity gets deleted (before save)
     *
     * @param \DotbBean $activity
     */
    public function beforeDelete(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     */
    public function calculateMomentum(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     * @return boolean
     */
    public function hasMomentum(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     * @return bool
     */
    public function calculateStatus(\DotbBean $activity);

    /**
     * Gets called when the activity was completed
     *
     * @param \DotbBean $activity
     * @param \DotbBean $previous
     */
    public function previousActivityCompleted(\DotbBean $activity, \DotbBean $previous);

    /**
     * @param \DotbBean $activity
     * @return \DotbBean|false
     */
    public function getNextChildActivity(\DotbBean $activity);

    /**
     * Creates a new instance of the implemented handlers activity
     *
     * @return \DotbBean
     */
    public function create();

    /**
     * @param \DotbBean $activity
     */
    public function setMomentumStartDateFromParentField(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     */
    public function setDueDateFromParentField(\DotbBean $activity);

    /**
     * Checks if a activity is not started
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function isNotStarted(\DotbBean $activity);

    /**
     * Checks if a activity is a stage activity
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function isStageActivity(\DotbBean $activity);

    /**
     * Retrieves a activity by stage id and name
     *
     * @param string $stageId
     * @param string $name
     * @param string $skipId
     * @return bool
     * @throws \DotbApiExceptionNotFound
     */
    public function getByStageIdAndName($stageId, $name, $skipId);

    /**
     * Retrieves a activity by stage id and order
     *
     * @param string $stageId
     * @param int $order
     * @param string $skipId
     * @return bool
     * @throws \DotbApiExceptionNotFound
     */
    public function getByStageIdAndOrder($stageId, $order, $skipId);

    /**
     * Checks if a activity with a given order exist on stage
     *
     * @param string $stageId
     * @param int    $order
     * @param string $skipId
     * @return bool
     * @throws \DotbQueryException
     */
    public function orderExistOnStage($stageId, $order, $skipId);

    /**
     * Retrieves a order from a activity
     *
     * @param \DotbBean $activity
     * @return string
     */
    public function getSortOrder(\DotbBean $activity);

    /**
     * Retrieves the points from a activity
     *
     * @param \DotbBean $activity
     * @return int
     */
    public function getPoints(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     * @return int
     */
    public function getMomentumPoints(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     */
    public function calculate(\DotbBean $activity);

    /**
     * Retrieves the points from a activity
     *
     * @param \DotbBean $activity
     * @return int
     */
    public function calculatePoints(\DotbBean $activity);

    /**
     * Sets the score on a activity
     *
     * @param \DotbBean $activity
     * @param int $points
     */
    public function setPoints(\DotbBean $activity, $points);

    /**
     * @return string
     */
    public function getNotStartedStatus();

    /**
     * @return string
     */
    public function getInProgressStatus();

    /**
     * @return string
     */
    public function getCompletedStatus();

    /**
     * @return string
     */
    public function getNotApplicableStatus();

    /**
     * Sets the status on a activity
     *
     * @param \DotbBean $activity
     * @param int $status
     */
    public function setStatus(\DotbBean $activity, $status);

    /**
     * Retrieves the score from a activity
     *
     * @param \DotbBean $activity
     * @return int
     */
    public function getScore(\DotbBean $activity);

    /**
     * Retrieves the score from a activity
     *
     * @param \DotbBean $activity
     * @return int
     */
    public function getMomentumScore(\DotbBean $activity);

    /**
     * Sets the score on a activity
     *
     * @param \DotbBean $activity
     * @param int $score
     */
    public function setScore(\DotbBean $activity, $score);

    /**
     * Calculates the score of a activity
     *
     * @param \DotbBean $activity
     * @return int
     */
    public function calculateScore(\DotbBean $activity);

    /**
     * Sets the progress on a activity
     *
     * @param \DotbBean $activity
     * @param int $progress
     */
    public function setProgress(\DotbBean $activity, $progress);

    /**
     * Retrieves the progress from a activity
     *
     * @param \DotbBean $activity
     * @return float
     */
    public function getProgress(\DotbBean $activity);

    /**
     * Calculates the progress of a activity
     *
     * @param \DotbBean $activity
     * @return float
     */
    public function calculateProgress(\DotbBean $activity);

    /**
     * @param \DRI_SubWorkflow $stage
     */
    public function setStage(\DRI_SubWorkflow $stage);

    /**
     * Retrieves the activity's related stage
     *
     * @param \DotbBean $activity
     * @return \DRI_SubWorkflow
     */
    public function getStage(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     * @return \DRI_SubWorkflow
     */
    public function setActualSortOrder(\DotbBean $activity);

    /**
     * Retrieves the activity's related stage id
     *
     * @param \DotbBean $activity
     * @return string
     */
    public function getStageId(\DotbBean $activity);

    /**
     * @return string
     */
    public function getStageIdFieldName();

    /**
     * Retrieves the activity's related activity template
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function hasActivityTemplate(\DotbBean $activity);

    /**
     * Retrieves the activity's related activity template
     *
     * @param \DotbBean $activity
     * @return \DRI_Workflow_Task_Template
     */
    public function getActivityTemplate(\DotbBean $activity);

    /**
     * Retrieves the activity's related activity template id
     *
     * @param \DotbBean $activity
     * @return string
     */
    public function getActivityTemplateId(\DotbBean $activity);

    /**
     * Increases the activity's sort order
     *
     * @param \DotbBean $activity
     */
    public function increaseSortOrder(\DotbBean $activity);

    /**
     * Creates a activity from the required parent entities
     *
     * @param \DRI_Workflow_Task_Template $activityTemplate
     * @param \DRI_SubWorkflow $stage
     * @param \DotbBean $parent
     * @return \DotbBean
     */
    public function createFromTemplate(\DRI_Workflow_Task_Template $activityTemplate, \DRI_SubWorkflow $stage, \DotbBean $parent);

    /**
     * Will be called after the activity has been created
     *
     * @param \DotbBean $activity
     * @param \DotbBean $parent
     */
    public function afterCreate(\DotbBean $activity, \DotbBean $parent);

    /**
     * Will be called before the activity has been created
     *
     * @param \DotbBean $activity
     * @param \DotbBean $parent
     */
    public function beforeCreate(\DotbBean $activity, \DotbBean $parent);

    /**
     * @param \DotbBean $activity
     * @param \DotbBean $parent
     */
    public function relateToParent(\DotbBean $activity, \DotbBean $parent);

    /**
     * Populates a activity from the parent (Account/Contact/Lead etc)
     *
     * @param \DotbBean $activity
     * @param \DotbBean $parent
     */
    public function populateFromParent(\DotbBean $activity, \DotbBean $parent);

    /**
     * Populates a activity from the parent activity (Task/Call/Meeting)
     *
     * @param \DotbBean $activity
     * @param \DotbBean $parentActivity
     */
    public function populateFromParentActivity(\DotbBean $activity, \DotbBean $parentActivity);

    /**
     * Populates a activity from the stage
     *
     * @param \DotbBean $activity
     * @param \DotbBean $parent
     * @param \DRI_SubWorkflow $stage
     * @param \DRI_Workflow_Task_Template $activityTemplate
     */
    public function populateFromStage(
        \DotbBean $activity,
        \DotbBean $parent,
        \DRI_SubWorkflow $stage,
        \DRI_Workflow_Task_Template $activityTemplate
    );

    /**
     * Populates a activity from the stage
     *
     * @param \DotbBean $activity
     * @param \DRI_Workflow_Template $journeyTemplate
     */
    public function populateFromJourneyTemplate(\DotbBean $activity, \DRI_Workflow_Template $journeyTemplate);

    /**
     * Populates a activity from the stage
     *
     * @param \DotbBean $activity
     * @param \DRI_SubWorkflow_Template $stageTemplate
     */
    public function populateFromStageTemplate(\DotbBean $activity, \DRI_SubWorkflow_Template $stageTemplate);

    /**
     * Loads the target handlers activity relationship on a stage.
     *
     * @param \DRI_SubWorkflow $stage
     * @return \DotbBean[]
     */
    public function load(\DRI_SubWorkflow $stage);

    /**
     * @return \DotbQuery
     */
    public function createLoadQuery();

    /**
     * @param \DotbBean $bean
     * @return \DotbBean[]
     */
    public function retrieveChildren(\DotbBean $bean);

    /**
     * Checks if a activity has children
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function isParent(\DotbBean $activity);

    /**
     * Checks if a activity has parent
     *
     * @param \DotbBean $activity
     * @return bool
     */
    public function hasParent(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     * @return \DotbBean
     */
    public function getParent(\DotbBean $activity);

    /**
     * @param \DotbBean $bean
     * @return \DotbBean[]
     */
    public function getChildren(\DotbBean $bean);

    /**
     * @param \DotbBean $bean
     * @return \CJ_Form[]
     */
    public function getForms(\DotbBean $bean);

    /**
     * @param \DotbBean $bean
     */
    public function loadChildren(\DotbBean $bean);

    /**
     * @param \DotbBean $activity
     * @param \DotbBean $child
     */
    public function insertChild(\DotbBean $activity, \DotbBean $child);

    /**
     * @param \DotbBean $activity
     * @return int
     */
    public function getChildOrder(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     * @return bool
     */
    public function isProgressChanged(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     * @return bool
     */
    public function isScoreChanged(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     * @return bool
     */
    public function isPointsChanged(\DotbBean $activity);

    /**
     * @param \DotbBean $activity
     * @return bool
     */
    public function isStatusChanged(\DotbBean $activity);
}
