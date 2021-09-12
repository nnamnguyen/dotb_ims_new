<?php





/**
 * BWC metadata file
 */
class MetaDataFileBwc implements MetaDataFileInterface
{
    /**
     * @var MetaDataFile
     */
    protected $file;

    /**
     * Constructor
     *
     * @param MetaDataFileInterface $file
     */
    public function __construct(MetaDataFileInterface $file)
    {
        $this->file = $file;
    }

    /** {@inheritDoc} */
    public function getPath()
    {
        $path = $this->file->getPath();
        array_splice($path, 2, 0, array('metadata'));

        return $path;
    }
}
