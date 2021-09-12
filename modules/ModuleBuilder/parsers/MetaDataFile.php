<?php





/**
 * Generic metadata file
 */
class MetaDataFile implements MetaDataFileInterface
{
    /**
     * @var string
     */
    protected $view;

    /**
     * @var string
     */
    protected $module;

    /**
     * Constructor
     *
     * @param string $view
     * @param string $module
     */
    public function __construct($view, $module)
    {
        $this->view = $view;
        $this->module = $module;
    }

    /** {@inheritDoc} */
    public function getPath()
    {
        $names = MetaDataFiles::getNames();

        //In a deployed module, we can check for a studio module with file name overrides.
        $sm = StudioModuleFactory::getStudioModule($this->module);
        foreach ($sm->sources as $file => $def) {
            if (!empty($def['view'])) {
                $names[$def['view']] = substr($file, 0, strlen($file) - 4);
            }
        }

        if (!isset($names[$this->view])) {
            dotb_die("View $this->view is not recognized");
        }

        return array('modules', $this->module, $names[$this->view]);
    }

    /**
     * Gets the view from this class
     *
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Gets the module from this class
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }
}
