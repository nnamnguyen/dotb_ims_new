<?php



/**
 * DotbMetric hook handler class
 *
 * @see custom/Extension/application/Ext/LogicHooks/DotbMetricHoolks.php
 * contains hook configuration for DotbMetric
 */
class DotbMetric_HookManager
{
    /**
     * Initialization state
     *
     * @var bool
     */
    protected $initialized = false;

    /**
     * DotbMetric initialization hook
     *
     * Serve "after_entry_point" hook handling
     */
    public function afterEntryPoint()
    {
        if ($this->initialized) {
            return;
        }

        DotbMetric_Helper::run(false);
        $this->initialized = true;
    }

    /**
     * Called on dotb_cleanup
     *
     * Serve "server_round_trip" hook handling
     */
    public function serverRoundTrip()
    {
        $instance = DotbMetric_Manager::getInstance();

        // Check transaction name was set on endPoints
        if (!$instance->isNamedTransaction()) {
            if (isset($GLOBALS['log']) && !empty($_SERVER['REQUEST_URI'])) {

                // Log REQUEST_URI to debug "dead" entryPoints
                $GLOBALS['log']->debug('Unregistered Transaction name for URI: ' . $_SERVER['REQUEST_URI']);
            }
        }
    }

}
