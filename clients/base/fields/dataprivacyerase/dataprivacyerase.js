
/**
 * @class View.Fields.Base.DataPrivacyEraseField
 * @alias DOTB.App.view.fields.BaseDataPrivacyEraseField
 * @extends View.Fields.Base.RowactionField
 */
({
    extendsFrom: 'RowactionField',

    events: {
        'click [name="dataprivacy-erase"]': 'showMarkForErasePanel'
    },

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.type = 'rowaction';
    },

    /**
     * Check if the given module has any PII fields
     * @private
     */
    _hasPIIFields: function(baseModule) {
        return _.some(app.metadata.getModule(baseModule, 'fields'), function(field) {
            return field.pii;
        });
    },

    /**
     * @inheritdoc
     * Add ability to hide/show the erase action based on conditions
     */
    _render: function() {
        // only show erase link if all these donditions are met
        if (this.context.parent.get('module') == 'DataPrivacy' &&
            this.context.parent.get('model').get('status') == 'Open' &&
            this.context.parent.get('model').get('type') == 'Request to Erase Information' &&
            this._hasPIIFields(this.module) &&
            app.acl.hasAccess('admin', 'DataPrivacy') &&
            app.acl.hasAccess('admin', this.module)) {
            this._super('_render');
        } else {
            this.hide();
        }
    },

    bindDataChange: function() {
        this._super('bindDataChange', arguments);
        //When the parent record resaves, check if we need to show/hide
        this.listenTo(this.context.parent.get('model'), 'sync', this.render);
    },

    /**
     * Trigger event to open the Mark for Erasure drawer.
     */
    showMarkForErasePanel: function() {
        this.context.parent.trigger('mark-erasure:click', this.model);
    }
})
