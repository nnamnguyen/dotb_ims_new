({
    extendsFrom: "RecordlistView",

    initialize: function (options) {
        // make sure to use recordlist templates
        options.meta.type = "recordlist";

        this._super('initialize', [options]);

        this.context.on("list:revoke:fire", this.revokeClicked, this);
        this.context.parent.on('users:add', this.addUsersClicked, this);
        this.context.parent.on('users:reload', function () {
            this.collection.fetch();
        }, this);

        this.collection.filterDef = {
            '$and': [
                {'customer_journey_access': 1},
                {'$or': [
                    {'is_group': 0},
                    {'is_group': {'$is_null': 1}}
                ]},
                {'$or': [
                    {'portal_only': 0},
                    {'portal_only': {'$is_null': 1}}
                ]}
            ],
            status: 'Active'
        };
    },

    batchModelIds: function (models) {
        // build a list of ids
        var ids = _.map(models, function (model) {
            return model.id;
        });

        // ensure the current user is deactivated in the last batch.
        // if the current users is deactivated in the first request of many if next request will
        // throw an error to rebuild the metadata and not all users will be deactivated.
        if (-1 !== _.indexOf(ids, app.user.id)) {
            ids = _.filter(ids, function (id) {
                return id !== app.user.id;
            });

            ids.push(app.user.id);
        }

        var batchSize = 50;

        // batch the ids
        return _.groupBy(ids, function (element, index) {
            return Math.floor(index / batchSize);
        });
    },

    revokeClicked: function (model) {
        var models = [];

        if (this.context.get('mass_collection').length) {
            models = this.context.get('mass_collection').models;
        } else {
            models = [model];
        }

        var batches = this.batchModelIds(models);

        var tasks = [];

        _.each(batches, function (batch) {
            tasks.push(function(callback) {
                var url = app.api.buildURL('DRI_Workflows/config/deactivate-users');

                app.api.call('update', url, { ids: batch }, {
                    success: _.bind(function () {
                        callback(null);
                    }, this),
                    error: function (response) {
                        callback(true, response);
                    }
                });
            });
        });

        app.alert.show("customer_journey_deactivating_users", {
            level: "info",
            messages: "Deactivating users",
            autoClose: false
        });

        async.waterfall(tasks, _.bind(function (err, result) {
            app.alert.dismiss("customer_journey_deactivating_users");
            this.collection.fetch();
            this.context.parent.trigger("settings:reload");

            if (err && result) {
                app.alert.show("error", {
                    level: "error",
                    messages: result.message,
                    autoClose: true
                });
            }
        }, this));
    },

    addUsersClicked: function () {
        // Dotb changed multi-selection-list became
        var bwc = ! app.metadata.getLayout('Users', 'multi-selection-list');

        // don't use any callback if multi-selection-list is not available
        var callback = bwc ? function () {} : this.usersSelected;

        var context = {
            module: 'Users',
            isMultiSelect: true,
            filterOptions: new app.utils.FilterOptions()
                .config({
                    initial_filter: 'missing_customer_journey_access',
                    initial_filter_label: 'LBL_FILTER_MISSING_CUSTOMER_JOURNEY_ACCESS',
                    filter_populate: {
                        '$and': [
                            {'$or': [
                                {'customer_journey_access': 0},
                                {'customer_journey_access': {'$is_null': 1}}
                            ]},
                            {'$or': [
                                {'is_group': 0},
                                {'is_group': {'$is_null': 1}}
                            ]},
                            {'$or': [
                                {'portal_only': 0},
                                {'portal_only': {'$is_null': 1}}
                            ]}
                        ],
                        status: 'Active'
                    }
                }).format()
        };

        if (bwc) {
            // trick selection-list to think we should select multiple records
            context.recLink = "teams";
        }

        app.drawer.open({
            // use multi-selection-list if available (not available in 7.6 )
            layout: bwc ? 'selection-list' : 'multi-selection-list',
            context: context
        }, _.bind(callback, this));

        if (bwc) {
            // this is a hack to get around the behaviour in 7.6
            // where the clean multi-selection-list is not available
            var layout = _.last(app.drawer._components);

            var lay = layout._components[0]._components[0]._components[1];
            lay.off('list:masslink:fire');
            lay.on('list:masslink:fire', function () {
                this.usersSelected(lay.context.get('mass_collection').models);
                app.drawer.close();
            }, this);
        }
    },

    usersSelected: function (models) {
        var batches = this.batchModelIds(models);

        var tasks = [];

        _.each(batches, function (batch) {
            tasks.push(function(callback) {
                var url = app.api.buildURL('DRI_Workflows/config/activate-users');

                app.api.call('update', url, { ids: batch }, {
                    success: _.bind(function () {
                        callback(null);
                    }, this),
                    error: function (response) {
                        callback(true, response);
                    }
                });
            });
        });

        app.alert.show("customer_journey_activating_users", {
            level: "info",
            messages: "Activating users",
            autoClose: false
        });

        async.waterfall(tasks, _.bind(function (err, result) {
            app.alert.dismiss("customer_journey_activating_users");
            this.collection.fetch();
            this.context.parent.trigger("settings:reload");

            if (err && result) {
                app.alert.show("error", {
                    level: "error",
                    messages: result.message,
                    autoClose: true
                });
            }
        }, this));
    },

    render: function () {
        this._super("render");

        // we need to set the viewName to list for all row action fields here because of a bug in 7.6 & 7.7
        _.each(this.fields, function (field) {
            if (field.model.id && field.type === "fieldset") {
                field.setViewName("list");
                field.render();
            }
        });
    }
})
