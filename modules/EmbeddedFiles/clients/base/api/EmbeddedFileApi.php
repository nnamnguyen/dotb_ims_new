<?php


/**
 * API Class to handle embedded files.
 */
class EmbeddedFileApi extends FileApi
{
    /**
     * {@inheritDoc}
     */
    public function registerApiRest()
    {
        return array(
            'saveFilePost' => array(
                'reqType' => 'POST',
                'path' => array('EmbeddedFiles', '?', 'file', '?'),
                'pathVars' => array('module', 'record', '', 'field'),
                'method' => 'saveFilePost',
                'rawPostContents' => true,
                'shortHelp' => 'Saves a file. The file can be a new file or a file override.',
                'longHelp' => 'include/api/help/module_record_file_field_post_help.html',
            ),
            'saveFilePut' => array(
                'reqType' => 'PUT',
                'path' => array('EmbeddedFiles', '?', 'file', '?'),
                'pathVars' => array('module', 'record', '', 'field'),
                'method' => 'saveFilePut',
                'rawPostContents' => true,
                'shortHelp' => 'Saves a file. The file can be a new file or a file override.
                    (This is an alias of the POST method save.)',
                'longHelp' => 'include/api/help/module_record_file_field_put_help.html',
            ),
            'getFileContents' => array(
                'reqType' => 'GET',
                'path' => array('EmbeddedFiles', '?', 'file', '?'),
                'pathVars' => array('module', 'record', '', 'field'),
                'method' => 'getFile',
                'rawReply' => true,
                'allowDownloadCookie' => true,
                'shortHelp' => 'Gets the contents of a single file related to a field for a module record.',
                'longHelp' => 'include/api/help/module_record_file_field_get_help.html',
                'noLoginRequired' => true,
            ),
        );
    }

    /**
     * {@inheritDoc}
     *
     * Need flexible field names for download files, so we need to override it.
     */
    public function saveFilePost(ServiceBase $api, array $args, $temporary = false)
    {
        $field = $args['field'];

        $prefix = empty($args['prefix']) ? '' : $args['prefix'];

        $filesIndex = $prefix . $field;

        if ($field !== 'filename') {
            $args['field']  = 'filename';
            $_FILES[$prefix . 'filename'] = $_FILES[$filesIndex];
            unset($_FILES[$filesIndex]);
        }

        $result = parent::saveFilePost($api, $args, $temporary);

        if ($field !== 'filename' && isset($result['filename'])) {
            $result[$field] = $result['filename'];
            unset($result['filename']);
        }
        return $result;
    }

    /**
     * {@inheritDoc}
     *
     * Need flexible field names for download files, so we need to override it.
     */
    public function getFile(ServiceBase $api, array $args)
    {
        if (empty($args['field'])) {
            throw new DotbApiExceptionMissingParameter('Field name is missing');
        }
        $args['field'] = 'filename';
        return parent::getFile($api, $args);
    }
}
