

const BeforeEvent = require('core/before-event');
const Events = require('core/events');

/**
 * Manages routing behavior.
 *
 * The default implementation provides `before` and `after` callbacks that are
 * executed before and after a route gets triggered.
 *
 * @module Core/Routing
 * @mixes Core/BeforeEvent
 */
/**
 * @alias module:Core/Routing
 */
const Routing = {
    /**
     * Checks if a user is authenticated before triggering a route.
     *
     * @param {string} route Route name.
     * @param {Array} [args] Route parameters.
     * @return {boolean} `true` if the route should be triggered; `false`
     *   otherwise.
     */
    beforeRoute: function (route, args) {
        if (!this.triggerBefore('route', { route:route, args:args })) {
            return false;
        }

        // skip this check for all white-listed routes (DOTB.App.config.unsecureRoutes)]
        if (_.indexOf(DOTB.App.config.unsecureRoutes, route) >= 0) {
            return true;
        }

        // Check if a user is un-authenticated and redirect him to login
        if (!DOTB.App.api.isAuthenticated()) {
            DOTB.App.router.login();
            return false;
        } else if (!DOTB.App.isSynced) {
            Backbone.history.stop();
            DOTB.App.sync();
            return false;
        }

        return true;
    },

    /**
     * Gets called after a route gets triggered.
     *
     * The default implementation does nothing.
     *
     * @param {string} route Route name.
     * @param {Array} [args] Route parameters.
     */
    after: function (route, args) {
        // Do nothing
    },

    /**
     * Creates a router instance, attaches it to the App object and starts it.
     *
     * @fires 'router:start'
     */
    start: function() {
        var opts = {};
        DOTB.App.augment("router", new DOTB.App.Router(opts), false);
        Events.trigger("router:start", DOTB.App.router);
        DOTB.App.router.init();
        DOTB.App.router.start();
    },

    /**
     * Internal use only - for unit testing Routers.
     *
     * Disables `Backbone.history` temporarily.
     *
     * @deprecated since 7.10. Please use {@link Core.Router#stop} instead.
     */
    stop: function() {
        DOTB.App.logger.warn('`Core.Routing#stop` method is deprecated since 7.10. Please use ' +
            '`Core.Router#stop` instead.');
        DOTB.App.router.stop();
    }
};

//Mix in the beforeEvents
_.extend(Routing, BeforeEvent);

module.exports = Routing;
