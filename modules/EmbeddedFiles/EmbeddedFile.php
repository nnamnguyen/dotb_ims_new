<?php


class EmbeddedFile extends DotbBean
{

    public $table_name = 'embedded_files';
    public $object_name = 'EmbeddedFile';
    public $new_schema = true;
    public $module_dir = 'EmbeddedFiles';

    /**
     * {@inheritDoc}
     *
     * Remove the linked file.
     * @param string $id Record ID.
     */
    public function mark_deleted($id)
    {
        $file = "upload://$id";
        if (file_exists($file) && !unlink($file)) {
            $GLOBALS['log']->error("Could not unlink() the file: $file.");
        }
        parent::mark_deleted($id);
    }
}
