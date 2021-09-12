<?php



/**
 * Class to run a job which should remove temporary PDF files
 */
class DotbJobRemovePdfFiles extends DotbJobRemoveFiles
{
    /**
     * {@inheritDoc}
     */
    protected function getDirectory()
    {
        return dotb_cached('pdf');
    }

    /**
     * {@inheritDoc}
     */
    protected function getMaxLifetime()
    {
        global $dotb_config;

        if (isset($dotb_config['pdf_file_max_lifetime'])) {
            return $dotb_config['pdf_file_max_lifetime'];
        }

        return null;
    }
}
