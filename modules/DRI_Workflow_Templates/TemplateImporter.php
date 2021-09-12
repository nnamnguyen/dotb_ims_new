<?php

namespace DRI_Workflow_Templates;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class TemplateImporter
{
    /**
     * @var array
     */
    private static $links = array (
        'dri_subworkflow_templates',
        'dri_workflow_task_templates',
        'web_hooks',
        'forms',
    );

    /**
     * @var bool
     */
    private $output = false;

    /**
     * @var string
     */
    private $directory = 'modules/DRI_Workflow_Templates/data';

    /**
     * @var bool
     */
    private $purge = false;

    /**
     * @var bool
     */
    private $dry = false;

    /**
     * @var bool
     */
    private $verbose = false;

    /**
     * Keeps track of records saved in the import and makes
     * sure moved records are not deleted when syncing links
     *
     * @var array
     */
    private $saved = array ();

    /**
     * @param mixed $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    /**
     * @param string $directory
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    /**
     * @param boolean $purge
     */
    public function setPurge($purge)
    {
        $this->purge = $purge;
    }

    /**
     * @param boolean $dry
     */
    public function setDry($dry)
    {
        $this->dry = $dry;
    }

    /**
     * @param boolean $verbose
     */
    public function setVerbose($verbose)
    {
        $this->verbose = $verbose;
    }

    /**
     * @param array $ids
     */
    private function purge(array $ids)
    {
        $query = new \DotbQuery();
        $query->from(new \DRI_Workflow_Template());
        $query->select('id');
        $query->where()->notIn('id', $ids);

        foreach ($query->execute() as $row) {
            $journey = \BeanFactory::retrieveBean('DRI_Workflow_Template', $row['id']);

            if ($journey) {
                $this->log("Deleting {$journey->module_dir} with id {$journey->id}");

                if (!$this->dry) {
                    $journey->mark_deleted($journey->id);
                }
            }
        }
    }

    /**
     * @param string $message
     * @param string $level
     */
    private function log($message, $level = 'info')
    {
        $GLOBALS['log']->{$level}($message);

        if (is_object($this->output)) {
            $this->output->writeln($message);
        } elseif ($this->output === true) {
            $message = strip_tags($message);
            $lineBreak = php_sapi_name() === 'cli' ? "\n" : '<br/>';
            echo $message.$lineBreak;
        }
    }

    /**
     * @return array
     * @throws \DotbQueryException
     */
    public function listIds()
    {
        return $this->loadFile(sprintf('%s/all.php', $this->directory));
    }

    /**
     * @param string $file
     * @return \DRI_Workflow_Template
     * @throws \DotbApiExceptionMissingParameter
     */
    public function importUpload($file)
    {
        $content = $this->getUploadedContent($file);
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \DotbApiExceptionMissingParameter('ERROR_UPLOAD_FAILED');
        }

        return $this->importData($data);
    }

    /**
     * @param $file
     * @return array
     * @throws \DotbApiExceptionMissingParameter
     */
    public function parseUpload($file)
    {
        $content = $this->getUploadedContent($file);
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \DotbApiExceptionMissingParameter('ERROR_UPLOAD_FAILED');
        }

        return $data;
    }

    /**
     * Function to get a data for File uploaded
     * @param $file
     * @return string
     */
    private function getUploadedContent($file)
    {
        require_once 'include/upload_file.php';
        $uploadFile = new \UploadFile($file);

        // confirm upload
        if (!$uploadFile->confirm_upload()) {
            throw new DotbApiExceptionMissingParameter('ERROR_UPLOAD_FAILED');
        }

        return $uploadFile->get_file_contents();
    }

    /**
     * @param string $id
     * @throws \Exception
     */
    public function import($id)
    {
        $file = sprintf('%s/%s.php', $this->directory, $id);
        $this->log("Importing template with id $id");
        $data = $this->loadFile($file);
        $this->importData($data, $id);
    }

    /**
     * @param array $data
     * @param string|null $id
     * @return \DRI_Workflow_Template
     */
    private function importData($data, $id = null)
    {
        $this->saved = array ();

        if (null === $id) {
            $id = $data['id'];
        }

        /** @var \DRI_Workflow_Template $journey */
        $journey = $this->findRecord('DRI_Workflow_Templates', $id);

        $this->syncRecord($journey, $data);

        return $journey;
    }

    /**
     * @param \DotbBean $bean
     * @param string    $link
     * @param array     $records
     */
    private function syncLink(\DotbBean $bean, $link, array $records)
    {
        $bean->load_relationship($link);
        $current = $bean->$link->getBeans();

        foreach ($records as $id => $data) {
            $record = $this->findRecord($bean->$link->getRelatedModuleName(), $id);

            if (isset($current[$id])) {
                unset($current[$id]);
            }

            $this->syncRecord($record, $data);
        }

        $this->deleteRecords($current);
    }

    /**
     * @param \DotbBean $bean
     * @param array      $data
     * @return bool
     */
    private function populateData(\DotbBean $bean, array $data)
    {
        $changes = false;

        // import blocked by from old format into new one if not exported from new version
        if ($bean instanceof \DRI_Workflow_Task_Template && !empty($data['blocked_by_id']) && empty($data['blocked_by'])) {
            $data['blocked_by'] = json_encode(array ($data['blocked_by_id']));
        }

        foreach ($data as $fieldName => $value) {
            if (isset($bean->field_defs[$fieldName]) && $bean->field_defs[$fieldName]['type'] === 'link') {
                continue;
            }

            if ($bean->$fieldName != $value) {
                if ($this->verbose) {
                    $message = sprintf(
                        'updating field %s to \'%s\' on record with id %s in module %s, previous value: \'%s\'',
                        $fieldName,
                        $value,
                        $bean->id,
                        $bean->module_dir,
                        $bean->$fieldName
                    );

                    $this->log($message);
                }

                $bean->$fieldName = $value;
                $changes = true;
            }
        }

        return $changes;
    }

    /**
     * @param \DotbBean $bean
     * @param bool       $changes
     */
    private function saveRecord(\DotbBean $bean, $changes)
    {
        if ($bean->new_with_id || !empty($bean->fetched_row['deleted'])) {
            $this->log("creating {$bean->module_dir} (new: {$bean->new_with_id}, deleted: {$bean->fetched_row['deleted']}) with id {$bean->id}");

            if (!$this->dry) {
                $bean->save();
            }
        } elseif ($changes) {
            $this->log("updating {$bean->module_dir} with id {$bean->id}");

            if (!$this->dry) {
                $bean->save();
            }
        } else {
            $this->log("{$bean->module_dir} with id {$bean->id} is already synchronized");
        }

        $this->saved[] = $bean->id;
    }

    /**
     * @param string $moduleName
     * @param string $id
     * @return \DotbBean
     */
    private function findRecord($moduleName, $id)
    {
        $this->log("retrieving {$moduleName} with id {$id}");
        $bean = \BeanFactory::retrieveBean($moduleName, $id, array(), false);

        if (null === $bean) {
            $this->log("creating new bean {$moduleName} with id {$id}");
            $bean = \BeanFactory::newBean($moduleName);
            $bean->id = $id;
            $bean->new_with_id = true;
        } elseif (!empty($bean->deleted)) {
            $this->log("undeleting {$bean->module_dir} with id {$bean->id}");
            $bean->mark_undeleted($id);
        }

        return $bean;
    }

    /**
     * @param \DotbBean[] $records
     */
    private function deleteRecords(array $records)
    {
        foreach ($records as $record) {
            if (!in_array($record->id, $this->saved, true)) {
                $this->log("deleting {$record->module_dir} with id {$record->id}");

                if (!$this->dry) {
                    $record->mark_deleted($record->id);
                }
            }
        }
    }

    /**
     * @param string $file
     * @return array
     * @throws \Exception
     */
    private function loadFile($file)
    {
        return require \DotbAutoLoader::existingCustomOne($file);
    }

    /**
     * @param \DotbBean $bean
     * @param array      $data
     */
    private function syncRecord(\DotbBean $bean, array $data)
    {
        $changes = $this->populateData($bean, $data);

        $this->saveRecord($bean, $changes);

        foreach ($data as $fieldName => $value) {
            if (isset($bean->field_defs[$fieldName])
                && $bean->field_defs[$fieldName]['type'] === 'link'
                && in_array($fieldName, self::$links, true))
            {
                $this->syncLink($bean, $fieldName, $value);
            }
        }
    }

    /**
     *
     */
    public function importAll()
    {
        $ids = $this->listIds();

        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $this->import($id);
            }
        } else {
            $this->log('no templates to import');
        }

        if ($this->purge) {
            $this->purge($ids);
        }
    }
}
