<?php




class ThemeApi extends DotbApi
{
    public function registerApiRest()
    {
        return array(
            'getCSSURL' => array(
                'reqType' => 'GET',
                'path' => array('css'),
                'pathVars' => array(''),
                'method' => 'getCSSURLs',
                'shortHelp' => 'Get (or generate) the css files for a platform and a theme',
                'longHelp' => 'include/api/help/css_get_help.html',
                'noLoginRequired' => true,
            ),
            'previewCSS' => array(
                'reqType' => 'GET',
                'path' => array('css', 'preview'),
                'pathVars' => array('', ''),
                'method' => 'previewCSS',
                'shortHelp' => 'Compile the css for a platform and a theme just as a preview',
                'longHelp' => 'include/api/help/css_preview_get_help.html',
                'noLoginRequired' => true,
                'rawReply' => true
            ),
            'getCustomThemeVars' => array(
                'reqType' => 'GET',
                'path' => array('theme'),
                'pathVars' => array(''),
                'method' => 'getCustomThemeVars',
                'shortHelp' => 'Get the customizable variables of a custom theme',
                'longHelp' => 'include/api/help/theme_get_help.html',
                'noLoginRequired' => true,
            ),
            'updateCustomTheme' => array(
                'reqType' => 'POST',
                'path' => array('theme'),
                'pathVars' => array(''),
                'method' => 'updateCustomTheme',
                'shortHelp' => 'Update the customizable variables of a custom theme',
                'longHelp' => 'include/api/help/theme_post_help.html',
            ),
        );
    }

    /**
     * Get (or generate) the css files for a platform and a theme
     *
     * @param ServiceBase $api
     * @param array $args
     *
     * @return array Locations of CSS Files
     */
    public function getCSSURLs(ServiceBase $api, array $args)
    {
        // Validating arguments
        $platform = isset($args['platform']) ? $args['platform'] : 'base';
        $themeName = isset($args['themeName']) ? $args['themeName'] : 'default';

        $theme = new LumiaTheme($platform, $themeName);
        // Otherwise we just return the CSS Url so the application can load the CSS file.
        // getCSSURL method takes care of generating CSS file(s) if it doesn't exist in cache.
        return array("url" => array_values($theme->getCSSURL()));
    }

    /**
     * Compile the css for a platform and a theme just as a preview
     *
     * @param ServiceBase $api
     * @param array $args
     *
     * @return string Plaintext css
     */
    public function previewCSS(ServiceBase $api, array $args)
    {
        // If `preview` is defined, it means that the call was made by the Theme Editor in Studio so we want to return
        // plain text/css
        // Validating arguments
        $platform = isset($args['platform']) ? $args['platform'] : 'base';
        $themeName = isset($args['themeName']) ? $args['themeName'] : 'default';
        $minify = isset($args['min']) ? true : false;

        $theme = new LumiaTheme($platform, $themeName);
        $theme->loadVariables();
        $theme->setVariables($args);
        $theme->setVariable('baseUrl', '"../../styleguide/assets"');

        $api->setHeader('Content-type', 'text/css');
        $css = $theme->previewCss($minify);
        $api->setHeader('Content-Length', strlen($css));

        echo $css;
        return;
    }

    /**
     * Get the customizable variables of a custom theme
     *
     * @param ServiceBase $api
     * @param array $args
     *
     * @return array Collection of objects {"name": varName, "value": value}
     */
    public function getCustomThemeVars(ServiceBase $api, array $args)
    {
        // Validating arguments
        $platform = isset($args['platform']) ? $args['platform'] : 'base';
        $themeName = isset($args['themeName']) ? $args['themeName'] : null;

        $output = array();
        $theme = new LumiaTheme($platform, $themeName);
        $variablesByType = $theme->getThemeVariables();
        foreach ($variablesByType as $type => $variables) {
            foreach ($variables as $lessVar => $lessValue) {
                $output[$type][] = array('name' => $lessVar, 'value' => $lessValue);
            }
        }
        return $output;
    }

    /**
     * Updates variables.less with the values given in the request.
     *
     * @param ServiceBase $api
     * @param array $args
     *
     * @return array Locations of CSS files
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionMissingParameter
     */
    public function updateCustomTheme(ServiceBase $api, array $args)
    {
        if (!$api->user->isAdmin()) {
            throw new DotbApiExceptionNotAuthorized();
        }

        if (empty($args)) {
            throw new DotbApiExceptionMissingParameter('Missing colors');
        }

        // Validating arguments
        $platform = isset($args['platform']) ? $args['platform'] : 'base';
        $themeName = isset($args['themeName']) ? $args['themeName'] : null;

        $theme = new LumiaTheme($platform, $themeName);

        // if reset=true is passed
        if (!empty($args['reset'])) {
            $theme->saveThemeVariables($args['reset']);
        } else {
            // else
            $theme->loadVariables();
            // Override the custom variables.less with the given vars
            $variables = array_diff_key($args, array('platform' => 0, 'themeName' => 0, 'reset' => 0));
            $theme->setVariables($variables);
            $theme->saveThemeVariables();
        }

        // saves the CSS file URL in the portal settings
        $urls = $theme->getCSSURL();
        foreach ($urls as $key => $url) {
            $urls[$key] = $GLOBALS['dotb_config']['site_url'] . '/' . $url;
        }
        $GLOBALS ['system_config']->saveSetting($platform, 'css', $urls);

        return $urls;
    }

}
