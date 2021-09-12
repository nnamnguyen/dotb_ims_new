<?php


// This is a set of classes that are here temporarialy until we get rid of any dependencies on the files in service/core

class SCErrorObject {
    var $errorMessage;
    function set_error($errorMessage) {
        $this->errorMessage = $errorMessage;
    }
    function error($errorObject) {
        throw new DotbApiExceptionError($errorObject->errorMessage);
    }
}