({
    extendsFrom: 'TogglepanelLayout',
    initialize: function (opts) {
        // The filter options default to true.
        var defaultOptions = {
            'auto_apply': true,
            'stickiness': true,
            'show_actions': true
        };

        this.events = _.extend({}, this.events, {
            'click [data-action=refreshList]': '_refreshList',
        });

        var moduleMeta = app.metadata.getModule(opts.module) || {};
        this.disableActivityStreamToggle(opts.module, moduleMeta, opts.meta || {});

        this.on("filterpanel:change:module", function (module, link) {
            this.currentModule = module;
            this.currentLink = link;
        }, this);

        this.on('filter:create:open', function () {
            this.$('.filter-options').removeClass('hide');

            // "filter:create:open" is triggered even when the edit drawer is
            // being closed, so protect against saving the shortcuts when that
            // happens
            var activeShortcutSession = app.shortcuts.getCurrentSession();
            if (_.isNull(activeShortcutSession)
                || (activeShortcutSession && activeShortcutSession.layout !== this)) {
                app.shortcuts.saveSession();
                app.shortcuts.createSession([
                    'Filter:Add',
                    'Filter:Remove',
                    'Filter:Close',
                    'Filter:Save',
                    'Filter:Delete',
                    'Filter:Reset'
                ], this);
            }
        }, this);

        this.on('filter:create:close', function () {
            this.$('.filter-options').addClass('hide');

            // "filter:create:close" is triggered even when filter:create:open has not been called
            var activeShortcutSession = app.shortcuts.getCurrentSession();
            if (activeShortcutSession && (activeShortcutSession.layout === this)) {
                app.shortcuts.restoreSession();
            }
        }, this);

        // This is required, for example, if we've disabled the subapanels panel so that app doesn't attempt to render later
        this.on('filterpanel:lastviewed:set', function (viewed) {
            this.toggleViewLastStateKey = this.toggleViewLastStateKey || app.user.lastState.key('toggle-view', this);
            var lastViewed = app.user.lastState.get(this.toggleViewLastStateKey);
            if (lastViewed !== viewed) {
                app.user.lastState.set(this.toggleViewLastStateKey, viewed);
            }
        }, this);

        this._super("initialize", [opts]);

        // Set the filter that's currently being edited.
        this.context.editingFilter = null;

        // Obtain any options set in the metadata and override the defaultOptions with them
        // to set on the context.
        var filterOptions = _.extend(defaultOptions, this.meta.filter_options, this.context.get('filterOptions'));
        this.context.set('filterOptions', filterOptions);

        // The `defaultModule` will either evaluate to the model's module (more
        // specific, and used on dashablelist filters), or the module on the
        // current context.
        var lastViewed = app.user.lastState.get(this.toggleViewLastStateKey),
            defaultModule = this.module || this.model.get('module') || this.context.get('module');

        this.trigger('filterpanel:change:module', (moduleMeta.activityStreamEnabled && lastViewed === 'activitystream') ? 'Activities' : defaultModule);
    },
    applyLastFilter: function (collection, condition) {
        var triggerFilter = true;
        if (_.size(collection.origFilterDef)) {
            if (condition === 'favorite') {
                //Here we are verifying the filter applied contains $favorite otherwise we don't really care about
                //refreshing the listview
                triggerFilter = !_.isUndefined(_.find(collection.origFilterDef, function (value, key) {
                    return key === '$favorite' || (value && !_.isUndefined(value.$favorite));
                }));
            }
            if (triggerFilter) {
                var query = this.$('.search input.search-name').val();
                this.trigger('filter:apply', query, collection.origFilterDef);
            }
        }
    },
    _refreshList: function () {
        this.trigger('filter:apply');
    },
    disableActivityStreamToggle: function (moduleName, moduleMeta, viewMeta) {
        if (moduleName !== 'Activities' && !moduleMeta.activityStreamEnabled) {
            _.each(viewMeta.availableToggles, function (toggle) {
                if (toggle.name === 'activitystream') {
                    toggle.disabled = true;
                    toggle.label = 'LBL_ACTIVITY_STREAM_DISABLED';
                }
            });
        }
    },
    _render: function () {
        this._super('_render');
        this.trigger('filter:reinitialize');
        if (this.context.attributes.layout == 'record') {
            $('.main-content .filter-view').remove();
            $('.search-filter .has-refresh .filter-view').css('border', 'none').css('background', 'none');
            $('.search-filter .has-refresh .filter-view').html('');
            $('.search-filter .controls.btn-group-fit .btn-group').css('right', '50%');
            $('.search-filter .controls.btn-group-fit .btn-group.refresh').css('right', '10px');
        }
    }
})
