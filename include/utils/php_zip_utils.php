<?php


function unzip( $zip_archive, $zip_dir)
{
   return unzip_file($zip_archive, null, $zip_dir);
}

function unzip_file( $zip_archive, $archive_file, $zip_dir)
{
    if( !is_dir( $zip_dir ) ) {
        if (defined('DOTB_PHPUNIT_RUNNER') || defined('DOTBCRM_INSTALL'))
        {
        	$GLOBALS['log']->fatal("Specified directory '$zip_dir' for zip file '$zip_archive' extraction does not exist.");
        	return false;
        } else {
            die( "Specified directory '$zip_dir' for zip file '$zip_archive' extraction does not exist." );
        }
    }

    $zip = new ZipArchive;

    $res = $zip->open(UploadFile::realpath($zip_archive)); // we need realpath here for PHP streams support

    if($res !== TRUE) {
        if (defined('DOTB_PHPUNIT_RUNNER') || defined('DOTBCRM_INSTALL'))
        {
        	$GLOBALS['log']->fatal(sprintf("ZIP Error(%d): Status(%s): Arhive(%s): Directory(%s)", $res, $zip->status, $zip_archive, $zip_dir));
            return false;
        } else {
        	die(sprintf("ZIP Error(%d): Status(%s): Arhive(%s): Directory(%s)", $res, $zip->status, $zip_archive, $zip_dir));
        }

    }

    if($archive_file !== null) {
        $res = $zip->extractTo(UploadFile::realpath($zip_dir), $archive_file);
    } else {
        $res = $zip->extractTo(UploadFile::realpath($zip_dir));
    }

    if($res !== TRUE) {
        if (defined('DOTB_PHPUNIT_RUNNER') || defined('DOTBCRM_INSTALL'))
        {
        	$GLOBALS['log']->fatal(sprintf("ZIP Error(%d): Status(%s): Arhive(%s): Directory(%s)", $res, $zip->status, $zip_archive, $zip_dir));
            return false;
        } else {
        	die(sprintf("ZIP Error(%d): Status(%s): Arhive(%s): Directory(%s)", $res, $zip->status, $zip_archive, $zip_dir));
        }
    }
    return true;
}

function zip_dir( $zip_dir, $zip_archive )
{
    if( !is_dir( $zip_dir ) ){
        if (!defined('DOTB_PHPUNIT_RUNNER'))
            die( "Specified directory '$zip_dir' for zip file '$zip_archive' extraction does not exist." );
        return false;
    }
    $zip = new ZipArchive();
    // we need this for shadow path resolution to work
    // we need realpath here for PHP streams support
    $zip->open(UploadFile::realpath($zip_archive), ZipArchive::CREATE|ZipArchive::OVERWRITE);
    $path = UploadFile::realpath($zip_dir);

    /** @var RecursiveIteratorIterator|RecursiveDirectoryIterator $it */
    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator(
            $path,
            FilesystemIterator::SKIP_DOTS | FilesystemIterator::UNIX_PATHS
        ),
        RecursiveIteratorIterator::SELF_FIRST
    );
    foreach ($it as $fileinfo) {
        $subPathName = $it->getSubPathname();
        if ($fileinfo->isDir()) {
            $zip->addEmptyDir($subPathName);
        } else {
            $zip->addFile($fileinfo->getPathname(), $subPathName);
        }
    }
}

/**
 * Zip list of files, optionally stripping prefix
 * FIXME: check what happens with streams
 * @param string $zip_file
 * @param array $file_list
 * @param string $prefix Regular expression for the prefix to strip
 */
function zip_files_list($zip_file, $file_list, $prefix = '')
{
    $archive    = new ZipArchive();
    $res = $archive->open(UploadFile::realpath($zip_file), ZipArchive::CREATE|ZipArchive::OVERWRITE); // we need realpath here for PHP streams support
    if($res !== TRUE)
    {
        $GLOBALS['log']->fatal("Unable to open zip file, check directory permissions: $zip_file");
        return FALSE;
    }
    foreach($file_list as $file) {
        if(!empty($prefix) && preg_match($prefix, $file, $matches) > 0) {
            $zipname = substr($file, strlen($matches[0]));
        } else {
            $zipname = $file;
        }
        $archive->addFile(UploadFile::realpath($file), $zipname);
    }
    return TRUE;
}
