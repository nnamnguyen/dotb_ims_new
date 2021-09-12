/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
(function () {
    /***
     * @class App.view.views.BaseDriWorkflowHeaderView
     * @extends App.view.views.BaseView
     */
    return {
        plugins: [
            'ToggleMoreLess'
        ],

        events: {
            'click [data-moreless]': 'moreLessClicked'
        },

        className: "dri-workflows-header-wrapper",

        /**
         * Status values.
         *
         * @property
         */
        MORE_LESS_STATUS: {
            MORE: 'more',
            LESS: 'less'
        },

        access: true,

        /**
         * {@inheritdoc}
         */
        initialize: function (options) {
            this._super("initialize", [options]);
            var moreLess = App.user.lastState.get(App.user.lastState.key(this.MORE_LESS_KEY, this));
            this.context.set("moreLess", moreLess);
            this.context.on("change:moreLess", this.render, this);

            this.collection.on("add", this.render, this);
            this.collection.on("remove", this.render, this);
            this.collection.on("sync", this.render, this);
            this.on("more-less:toggled", this._toggleMoreLess, this);

            this.editModel = app.data.createBean(this.context.get("parentModel").module);

            _.each(this.meta.fields, function (def) {
                _.extend(def, this.editModel.fields[def.name]);
            }, this);

            var url = app.api.buildURL('DRI_Workflows', 'validate-license');

            app.api.call('read', url, null, {
                error: _.bind(this.licenseLoadError, this)
            });
        },

        licenseLoadError: function (error) {
            if (error.code === "invalid_license") {
                this.access = false;

                if (this.$el) {
                    this.render();
                }
            }
        },

        /**
         * @param {string} moreLess
         * @private
         */
        _toggleMoreLess: function(moreLess) {
            this.context.set("moreLess", moreLess);
        }
    };
} ())
