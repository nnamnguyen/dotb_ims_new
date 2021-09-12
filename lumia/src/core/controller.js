

const Events = require('core/events');
const Context = require('core/context');
const ViewManager = require('view/view-manager');

/**
 * The controller manages the loading and unloading of layouts.
 *
 * ## Extending controller
 *
 * Applications may choose to extend the controller to provide a custom
 * implementation. Your custom controller class name should be the capitalized
 * {@link Config#appId|appID} for your application followed by the word
 * "Controller".
 *
 * Example:
 * ```
 * DOTB.App.PortalController = DOTB.App.controller.extend({
 *     loadView: function(params) {
 *        // Custom implementation of loadView
 *        // Should call super method:
 *        DOTB.App.Controller.prototype.loadView.call(this, params);
 *     }
 * });
 * ```
 *
 * @module Core/Controller
 */

/**
 * @alias module:Core/Controller
 */
module.exports = Backbone.View.extend({
    /**
     * Instantiates the application's main context and binds global events.
     *
     * @memberOf module:Core/Controller
     * @instance
     */
    initialize: function() {
        /**
         * The primary context of the app. This context is associated with the
         * root layout.
         *
         * @type {Core/Context}
         * @memberOf module:Core/Controller
         * @alias context
         * @instance
         */
        this.context = new Context();

        Events.on('app:sync:complete', function() {
            DOTB.App.api.setStateProperty('loadingAfterSync', true);
            _.each(DOTB.App.additionalComponents, function(component) {
                if (component && _.isFunction(component._setLabels)) {
                    component._setLabels();
                }
                component.render();
            });
            DOTB.App.router.reset();
            DOTB.App.api.clearStateProperty('loadingAfterSync');
        });

        Events.on('app:login:success', function() {
            DOTB.App.sync();
        });
    },

    /**
     * Loads a layout.
     *
     * Sets the context with the given params, creates the layout based on
     * metadata, loads the data and renders it. It also disposes the previous
     * displayed layout. This method is called by the router when the route is
     * changed.
     *
     * @memberOf module:Core/Controller
     * @param {Object} params Properties to set to the context and used to
     *   determine the layout to load.
     * @param {string} params.layout The layout name. It will be used to grab
     *   the corresponding metadata.
     * @param {string} params.module The module the layout belongs to.
     * @param {boolean} [params.skipFetch=false] If `true`, do not fetch the
     *   data.
     * @instance
     */
    loadView: function(params) {
        var oldLayout = this.layout;

        //FIXME SC-5124 will trigger 'app:view:load', and add a deprecation warning for 'app:view:change'.
        if (!DOTB.App.triggerBefore('app:view:change') || !DOTB.App.triggerBefore('app:view:load')) {
            return;
        }

        // Reset context and initialize it with new params
        this.context.clear({silent: true});
        this.context.set(params);

        // Prepare model and collection
        this.context.prepare();
        // Create an instance of the layout and bind it to the data instance
        this.layout = ViewManager.createLayout({
            name: params.layout,
            module: params.module,
            context: this.context
        });

        if (oldLayout) {
            // Take out the previous layout element from the content container,
            // and then keep it in the document fragment
            // in order to destroy jQuery plugin safe.
            var oldLayoutEl = document.createDocumentFragment();
            oldLayoutEl.appendChild(oldLayout.el);
        }

        // Render the layout to the main element
        // Since the previous element is already gone,
        // .append is better way because .html requires
        // additional cost for .empty().
        DOTB.App.$contentEl.append(this.layout.$el);

        //initialize subcomponents in the layout
        this.layout.initComponents();

        // Fetch the data, the layout will be rendered when fetch completes
        if (!params || (params && !params.skipFetch)) {
            this.layout.loadData();
        }

        // Render the layout with empty data
        this.layout.render();

        if (oldLayout) {
            oldLayout.dispose();
        }

        DOTB.App.trigger('app:view:change', params.layout, params);
    },

    /**
     * Creates, renders, and registers within the app additional components.
     *
     * @memberOf module:Core/Controller
     * @param {Object} components The components to load. They will
     *  be created using metadata view definitions and rendered on the page.
     *  The components objects are cached in the the global `DOTB.App` variable
     *  under the `additionalComponents` property.
     * @instance
     */
    loadAdditionalComponents: function(components) {
        if (!_.isEmpty(DOTB.App.additionalComponents)) {
            DOTB.App.logger.error('`Controller.loadAdditionalComponents` has already been called. ' +
                'It can not be called twice.');
            return;
        }

        DOTB.App.additionalComponents = {};
        _.each(components, function(component, name) {
            if (component.target) {
                var $el = this.$(component.target);
                if (!$el.get(0)) {
                    DOTB.App.logger.error('Unable to place additional component "' + name + '": the target specified ' +
                        'does not exist.');
                    return;
                }

                if (component.layout) {
                    DOTB.App.additionalComponents[name] = ViewManager.createLayout({
                        context: this.context,
                        type: component.layout,
                        el: $el,
                    });
                    DOTB.App.additionalComponents[name].initComponents();
                } else {
                    DOTB.App.additionalComponents[name] = ViewManager.createView({
                        type: component.view || name,
                        context: this.context,
                        el: $el,
                    });
                }
                DOTB.App.additionalComponents[name].render();
            } else {
                DOTB.App.logger.error('Unable to place additional component "' + name + '": no target specified.');
            }
        }, this);
    }
});
