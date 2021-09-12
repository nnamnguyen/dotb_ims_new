<?php



/**
 * Special metadata parser implementation for upgrading old portal edit/detail views
 */
class ParserPortalUpgrade extends GridLayoutMetaDataParser
{
    /**
     * {@inheritDoc}
     *
     * Disable original constructor, since during upgrade we don't need to intantiate metadata implementation,
     * which in some cases (like KBDocuments) will fail
     */
    public function __construct()
    {
    }
}
