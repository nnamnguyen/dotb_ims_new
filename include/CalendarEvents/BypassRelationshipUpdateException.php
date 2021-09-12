<?php


/**
 * @deprecated Since 7.8
 * Class BypassRelationshipUpdateException
 */
class BypassRelationshipUpdateException extends Exception
{
    /*
       Thrown when a condition exists in a before_relationship_update Hook such that
       the Update should Not Actually Occur. Throwing this exception will abort the
       relationship update.
    */
}
