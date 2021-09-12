<?php




/**
 * Lumia metadata file
 */
class MetaDataFileRoleDependent implements MetaDataFileInterface
{
    /**
     * @var MetaDataFile
     */
    protected $file;

    /**
     * @var string
     */
    protected $role;

    /**
     * Constructor
     *
     * @param MetaDataFileInterface $file
     * @param string $role
     */
    public function __construct(MetaDataFileInterface $file, $role)
    {
        $this->file = $file;
        $this->role = $role;
    }

    /** {@inheritDoc} */
    public function getPath()
    {
        $path = $this->file->getPath();
        $view = array_pop($path);
        array_push($path, 'roles', $this->role, $view);

        return $path;
    }
}
