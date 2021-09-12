<?php



class DotbOAuth2StorageMobile extends DotbOAuth2StorageBase {
    /**
     * How many simultaneous sessions allowed for this platform
     *
     * @var int
     */
    public $numSessions = 10000;
}
