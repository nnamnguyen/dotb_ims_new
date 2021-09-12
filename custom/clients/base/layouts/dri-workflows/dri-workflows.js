/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
(function (app) {

    return {

        _rendered: false,
        loadDataClicked: false,
        enabled: true,
        journeyCreated: false,
        startingJourney: false,

        plugins: [ 'CssLoader' ],

        css: [ 'custom/clients/base/views/dri-workflow/dri-workflow.css' ],

        /**
         * Status values.
         *
         * @property
         */
        MORE_LESS_STATUS: {
            MORE: 'more',
            LESS: 'less'
        },

        /**
         * {@inheritdoc}
         */
        initialize: function (options) {
            this._addedIds = {};
            this._super("initialize", [options]);

            this.context._fetchCalled = true;
            this.context.set("skipFetch", false);

            var parent = this.context.get("parentModel");
            parent.on("sync", this.reloadJourneys, this);
            this.context.on("reload_workflows", this.reloadJourneys, this);

            this.collection.on("add", this.addJourney, this);
            this.collection.on("remove", this.removeJourney, this);
            this.collection.on("sync", this._populateJourneys, this);
            this.collection.on("sync", this.cleanJourneys, this);

            this.context.on("change:moreLess", this.toggleMoreLess, this);
            this.context.on("parent:start_cycle:click", this.startJourneyClicked, this);

            this._populateJourneys();

            this.toggleMoreLess();

            this.context.set("fields", ["id", "name"]);
            this.collection.orderBy = {
                field: "date_entered",
                direction: "desc"
            };
            this.collection.filterDef = {
                archived: false
            };

            var enabled_modules = app.config.customer_journey && app.config.customer_journey.enabled_modules;

            if (enabled_modules) {
                enabled_modules = enabled_modules.split(",");
                if (enabled_modules.indexOf(parent.module) === -1) {
                    this.enabled = false;
                }
            }

            var w = app.data.createBean('DRI_Workflows');
            _.each(w.fields, function (def) {
                if (def.module === parent.module && def.customer_journey_parent) {
                    if (!def.customer_journey_parent.enabled) {
                        this.enabled = false;
                    }
                }
            }, this);
        },

        render: function () {
            this._super("render");
            if (!this.enabled) {
                this.hide();
            }
        },

        /**
         *
         */
        toggleMoreLess: function () {
            if (this.context.get("moreLess") === "more" && !this.loadDataClicked) {
                this.loadDataClicked = true;
                this.loadData();
            }
        },

        /**
         * Reloads all journey view data
         */
        reloadJourneys: function () {
            if (this.loadDataClicked && !this.context.get('customer_journey_fetching_parent_model')) {
                this.removeJourneyViews();
                this.context.children = [];
                this.context.resetLoadFlag();
                this.loadData();
            }
        },

        /**
         * Removes all journey views
         */
        cleanJourneys: function () {
            _.each(this._components, function(component) {
                if (component.name === "dri-workflow" && !this.collection.get(component.model.id)) {
                    this.removeJourneyView(component);
                }
            }, this);
        },

        /**
         * @private
         */
        _populateJourneys: function () {
            this.collection.each(this.addJourney, this);
        },

        /**
         * Toggles the display of all journey views
         */
        checkHide: function () {
            var completed = this.collection.filter(function (journey) {
                return journey.get("state") === "completed";
            }, this).length;

            if (completed === this.collection.length && this.loadDataClicked) {
                this.context.set("moreLess", this.MORE_LESS_STATUS.LESS);
            }
        },

        /**
         * {@inheritdoc}
         */
        loadData: function () {
            if (this.loadDataClicked) {
                this.context._fetchCalled = false;
                this.collection.dataFetched = false;
                this.render();
                this.context.loadData();
            }
        },

        /**
         * Initializes a new journey panel, adds it to the layout and loads the data
         *
         * @param {object} journey
         */
        addJourney: function (journey) {
            if (this._addedIds[journey.id]) return;

            var context = this.context.getChildContext({
                module: "DRI_Workflows",
                model: journey,
                forceNew: true
            });

            var view = this.createComponentFromDef({
                view: 'dri-workflow',
                context: context
            });

            this.addComponent(view);

            view.loadData();

            this._addedIds[journey.id] = true;

            view.render();

            journey.on("change:state", function () {
                if (journey.get("state") === "completed") {
                    this.checkHide();
                }
            }, this);

            // when a journey is created we should open it by default
            if (this.journeyCreated) {
                view.toggleMoreLess(view.MORE_LESS_STATUS.MORE);
            }
        },

        /**
         * Removes a journey view
         *
         * @param {object} view
         */
        removeJourneyView: function (view) {
            delete this._addedIds[view.model.id];
            this.removeComponent(view);
            view.dispose();
            this.collection.remove(view.model);
        },

        /**
         * Removes a journey and its related view
         *
         * @param {object} model
         */
        removeJourney: function (model) {
            _.each(this._components, function(component) {
                if (component && component.name === "dri-workflow" && component.model === model) {
                    this.removeJourneyView(component);
                }
            }, this);
        },

        /**
         * Removes all journey views
         */
        removeJourneyViews: function () {
            var remove = [];

            _.each(this._components, function(component) {
                if (component.name === "dri-workflow") {
                    remove.push(component);
                }
            }, this);

            _.each(remove, this.removeJourneyView, this);
        },

        /**
         * Starts a new journey related to the parent
         *
         * @param {object} model
         */
        startJourneyClicked: function (model) {
            if (_.isEmpty(model.get("dri_workflow_template_id"))) {
                return;
            }

            if (this.startingJourney) {
                return;
            }

            this.startingJourney = true;

            var url = app.api.buildURL(model.module, 'customer-journey/start-cycle', {
                id: this.context.get("parentModel").get('id')
            }, {
                template_id: model.get("dri_workflow_template_id")
            });

            this.$(".dri-workflows-actions-spinner").removeClass('hide');
            model.set("dri_workflow_template_id", "");
            model.set("dri_workflow_template_name", "");
            this.$el.children().fadeTo("slow", 0.7);

            app.api.call('create', url, null, {
                success: _.bind(function (parentData) {
                    if (this.context.get("moreLess") === this.MORE_LESS_STATUS.LESS) {
                        this.context.set("moreLess", this.MORE_LESS_STATUS.MORE);
                    }

                    this.journeyCreated = true;
                    this.context.get("parentModel").set(parentData);
                    this.context.get("parentModel").trigger("customer_journey:active-cycle:click", null);
                    this.reloadJourneys();
                }, this),
                error: function (result) {
                    app.alert.show("error", {
                        level: "error",
                        messages: result.message,
                        autoClose: true
                    });
                },
                complete: _.bind(function () {
                    this.startingJourney = false;
                    this.$(".dri-workflows-actions-spinner").addClass('hide');
                    this.$el.children().fadeTo("slow", 1);
                }, this)
            });
        }
    };
}(DOTB.App))
