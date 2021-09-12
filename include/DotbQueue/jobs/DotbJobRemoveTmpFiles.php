<?php



/**
 * Class to run a job which should remove temporary files
 */
class DotbJobRemoveTmpFiles extends DotbJobRemoveFiles
{
    /**
     * {@inheritDoc}
     */
    protected function getDirectory()
    {
        return 'upload://tmp';
    }

    /**
     * {@inheritDoc}
     */
    protected function getMaxLifetime()
    {
        global $dotb_config;

        if (isset($dotb_config['tmp_file_max_lifetime'])) {
            return $dotb_config['tmp_file_max_lifetime'];
        }

        return null;
    }
}
