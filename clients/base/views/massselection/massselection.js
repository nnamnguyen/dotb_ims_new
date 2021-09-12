
/**
 * @class View.Views.Base.MassaddtolistView
 * @alias DOTB.App.view.views.BaseMassaddtolistView
 * @extends View.Views.Base.MassupdateView
 */
({
    extendsFrom: 'MassupdateView',
    className: 'extend',
    plugins: ['MassCollection'],

    initialize: function(options) {
        var additionalEvents = {};
        additionalEvents['click .btn[name=select_button]'] = 'selectionOption';
        this.events = _.extend({}, this.events, additionalEvents);
        this._super("initialize", [options]);
    },

    /**
     * Listen for just the massaddtolist event from the list view
     */
    delegateListFireEvents: function() {
        this.layout.on("list:massselection:fire", this.show, this);
        this.layout.on("list:massaction:hide", this.hide, this);
    },

    /**
     * Pull out the target list link field from the field list and treat it like a relate field for later rendering
     * @param options
     */
    setMetadata: function(options) {
        var moduleMetadata = app.metadata.getModule(options.module);

        if (!moduleMetadata) {
            return;
        }

        this.addToListField = {name:"number_select",label:"LBL_SELECT_OPTION"};
    },

    /**
     * Hide the view if we were not able to find the appropriate list field and somehow render is triggered
     */
    _render: function() {
        var result = this._super("_render");

        if(_.isUndefined(this.addToListField)) {
            this.hide();
        }
        return result;
    },

    /**
     * There is only one field for this view, so it is the default as well
     */
    setDefault: function() {
        this.defaultOption = this.addToListField;
    },

    /**
     * When adding to a target list, the API is expecting an array of IDs
     */
    getAttributes: function() {
        var attributes = {};
        attributes[this.addToListFieldName] = [
            this.model.get(this.addToListField.id_name)
        ];
        return attributes;
    },

    /**
     * Build dynamic success messages to be displayed if the API call is successful
     * Overridden to build different success messages from massupdate
     *
     * @param massUpdateModel - contains the attributes of what records are being updated
     */
    buildSaveSuccessMessages: function(massUpdateModel) {
        var doneLabel = 'TPL_MASS_ADD_TO_LIST_SUCCESS',
            queuedLabel = 'TPL_MASS_ADD_TO_LIST_QUEUED',
            listName = this.model.get(this.addToListField.name),
            listId = this.model.get(this.addToListField.id_name),
            listUrl = '#' + app.router.buildRoute(this.listModule, listId);

        return {
            done: app.lang.get(doneLabel, null, {
                listName: listName,
                listUrl: listUrl
            }),
            queued: app.lang.get(queuedLabel, null, {
                listName: listName,
                listUrl: listUrl
            })
        };
    },

    /**
     * Create a new target list and select it in the list
     */
    selectionOption:async function (evt) {
        this.createMassCollection();
        this._initTemplates();
        this.massCollection.entire = true;
        var numberSelect = this.model.get('number_select');
         var selectOptions = {
             fields: ['id','name','email'],
            limit: Number(numberSelect),
            // use the last filterDef applied to the collection
            filter: this.context.get('collection').filterDef,
            showAlerts: true,
            success: _.bind(function(collection) {
                if (_.isEmpty(collection.filterDef)) {
                    // This property represents the maximum number of
                    // records that the user can select. We need it to
                    // add or remove the `all` word in the `selectAll`
                    // alert.
                    this.massCollection.maximum = this.massCollection.length;
                }
                this.toggleSelectAllAlert();
            }, this),
             error: function (e) {
             }
        };

        _.extend(this.massCollection, {
            orderBy: this.context.get('collection').orderBy,
        });

        this.massCollection.trigger('massupdate:estimate');
        this.massCollection.fetch(selectOptions);

    }
})
