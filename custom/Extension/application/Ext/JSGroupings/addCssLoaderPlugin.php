<?php

if (isset($js_groupings)) {
    // Loop through the groupings to find grouping file you want to append to
    foreach ($js_groupings as $key => $groupings) {
        foreach  ($groupings as $file => $target) {
            // if the target grouping is found
            if ($target == 'include/javascript/dotb_grp7.min.js') {
                // append the custom JavaScript file to existing grouping
                $js_groupings[$key]['custom/include/javascript/dotb7/plugins/CssLoader.js'] = 'include/javascript/dotb_grp7.min.js';
            }

            break;
        }
    }
}
