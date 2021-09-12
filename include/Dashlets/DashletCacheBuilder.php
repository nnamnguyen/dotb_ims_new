<?php

/*********************************************************************************

 * Description: Handles Generic Widgets 
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/




class DashletCacheBuilder {
    
    /**
     * Builds the cache of Dashlets by scanning the system
     */
    function buildCache() {
        global $beanList;
        $dashletFiles = array();
        $dashletFilesCustom = array();
        
        getFiles($dashletFiles, 'modules', '/^.*\/Dashlets\/[^\.]*\.php$/');
        getFiles($dashletFilesCustom, 'custom/modules', '/^.*\/Dashlets\/[^\.]*\.php$/');
        $cacheDir = create_cache_directory('dashlets/');
        $allDashlets = array_merge($dashletFiles, $dashletFilesCustom);
        $dashletFiles = array();
        foreach($allDashlets as $num => $file) {
            if(substr_count($file, '.meta') == 0) { // ignore meta data files
                $class = substr($file, strrpos($file, '/') + 1, -4);
                $dashletFiles[$class] = array();
                $dashletFiles[$class]['file'] = $file;
                $dashletFiles[$class]['class'] = $class;
                if(is_file(preg_replace('/(.*\/.*)(\.php)/Uis', '$1.meta$2', $file))) { // is there an associated meta data file?
                    $dashletFiles[$class]['meta'] = preg_replace('/(.*\/.*)(\.php)/Uis', '$1.meta$2', $file);
                    require($dashletFiles[$class]['meta']);
                    if ( isset($dashletMeta[$class]['module']) )
                        $dashletFiles[$class]['module'] = $dashletMeta[$class]['module'];
                }
                
                $filesInDirectory = array();
                getFiles($filesInDirectory, substr($file, 0, strrpos($file, '/')), '/^.*\/Dashlets\/[^\.]*\.icon\.(jpg|jpeg|gif|png)$/i');
                if(!empty($filesInDirectory)) {
                    $dashletFiles[$class]['icon'] = $filesInDirectory[0]; // take the first icon we see
                }
            }
        }
        
        write_array_to_file('dashletsFiles', $dashletFiles, $cacheDir . 'dashlets.php');
    }
}
?>