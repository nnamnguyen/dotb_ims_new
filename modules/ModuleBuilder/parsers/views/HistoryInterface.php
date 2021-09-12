<?php


interface HistoryInterface
{

    /*
     * Get the most recent item in the history
     * @return Id of the first item
     */
    function getFirst () ;

    /*
     * Get the next oldest item in the history
     * @return Id of the next item
     */
    function getNext () ;

    /*
     * Get the nth item in the history (where the zeroeth record is the most recent)
     * @return Id of the nth item
     */
    function getNth ($n) ;

    /*
     * Restore the historical layout identified by timestamp
     * @return Timestamp if successful, null if failure (if the file could not be copied for some reason)
     */
    function restoreByTimestamp ($timestamp) ;

    /*
     * Undo the restore - revert back to the layout before the restore
     */
    function undoRestore () ;

    /*
     * Add an item to the history
     * @return String   An timestamp for this newly added item
     */
    function append ($path) ;
}