<?php



/**
 * Class to run a job which should remove diagnostic files
 */
class DotbJobRemoveDiagnosticFiles extends DotbJobRemoveFiles
{
    /**
     * {@inheritDoc}
     */
    protected function getDirectory()
    {
        return dotb_cached('diagnostic');
    }

    /**
     * {@inheritDoc}
     */
    protected function getMaxLifetime()
    {
        global $dotb_config;

        if (isset($dotb_config['diagnostic_file_max_lifetime'])) {
            return $dotb_config['diagnostic_file_max_lifetime'];
        }

        return null;
    }
}
