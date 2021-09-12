
/**
 * @class View.Views.Base.Quotes.ConfigDrawerHowtoView
 * @alias DOTB.App.view.views.BaseQuotesConfigDrawerHowtoView
 * @extends View.Views.Base.BaseConfigDrawerHowtoView
 */
({
    extendsFrom: 'BaseConfigDrawerHowtoView',

    /**
     * @inheritdoc
     */
    events: {
        'keyup .searchbox': 'onSearchFilterChanged'
    },

    /**
     * List of field defs for the left column of the howto area
     */
    fieldsListLeft: undefined,

    /**
     * List of field defs for the right column of the howto area
     */
    fieldsListRight: undefined,

    /**
     * Contains all fields hidden by search
     */
    hiddenFields: undefined,

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.fieldsListLeft = [];
        this.fieldsListRight = [];
        this.hiddenFields = [];
    },

    /**
     * @inheritdoc
     */
    bindDataChange: function() {
        this._super('bindDataChange');
        this.context.on('config:fields:change', this.onFieldsChange, this);
    },

    /**
     * Handles when the list of fields changes for the howto panel
     *
     * @param {string} eventName The name of the event
     * @param {Array} fieldsList The list of fields to add to the view
     */
    onFieldsChange: function(eventName, fieldsList) {
        var len = fieldsList.length;
        var listRightIndex = len >> 1;
        var listLeftIndex = len - listRightIndex;

        this.hiddenFields = [];
        this.fieldsListLeft = _.initial(fieldsList, listLeftIndex);
        this.fieldsListRight = _.rest(fieldsList, listRightIndex);

        this.render();
    },

    /**
     * Handles when search term is changed, hides and shows fields
     */
    onSearchFilterChanged: _.debounce(function(evt) {
        var searchTerm = $(evt.currentTarget).val();
        var lowerName;
        var lowerLabel;

        if (searchTerm) {
            searchTerm = searchTerm.toLowerCase();
        }

        // re-show all fields
        _.each(this.hiddenFields, function(field) {
            field.show();
        }, this);

        // reset hidden fields
        this.hiddenFields = [];

        _.each(this.fields, function(field) {
            if (field.name) {
                lowerName = field.name.toLowerCase();
            }

            if (field.label) {
                lowerLabel = field.label.toLowerCase();
            }

            if ((lowerName && lowerName.indexOf(searchTerm) === -1) &&
                (lowerLabel && lowerLabel.indexOf(searchTerm) === -1)) {
                // the field name AND label DO NOT CONTAIN the search term,
                // hide the field
                field.hide();
                this.hiddenFields.push(field);
            }
        }, this);
    }, 400),

    /**
     * @inheritdoc
     */
    render: function() {
        this._super('render');

        // set the indeterminate checkbox input
        this.$('.indeterminate').prop('indeterminate', true);
    },

    /**
     * @inheritdoc
     */
    _dispose: function() {
        // get rid of any field references
        this.fieldsListLeft = [];
        this.fieldsListRight = [];
        this.hiddenFields = [];

        this._super('_dispose');
    }
})
