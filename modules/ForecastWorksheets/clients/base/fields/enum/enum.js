
/**
 * @class View.Fields.Base.ForecastsWorksheets.EnumField
 * @alias DOTB.App.view.fields.BaseForecastsWorksheetsEnumField
 * @extends View.Fields.Base.EnumField
 */
({
    extendsFrom: 'EnumField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        // we need to make a clone of the plugins and then push to the new object. this prevents double plugin
        // registration across ExtendedComponents
        this.plugins = _.clone(this.plugins) || [];
        this.plugins.push('ClickToEdit');
        this._super("initialize", [options]);
    },

    /**
     * @inheritdoc
     */
    bindDataChange: function() {
        if(this.name === 'sales_stage') {
            this.model.on('change:sales_stage', function(model, newValue) {
                var salesStageWon = app.metadata.getModule('Forecasts', 'config').sales_stage_won;
                if(_.contains(salesStageWon, newValue)) {
                    this.context.trigger('forecasts:cteRemove:' + model.id)
                }
            }, this);
        }

        if(this.name === 'commit_stage') {
            this.context.on('forecasts:cteRemove:' + this.model.id, function() {
                this.$el.removeClass('isEditable');
                var $divEl = this.$('div.clickToEdit');
                if($divEl.length) {
                    $divEl.removeClass('clickToEdit');
                }
            }, this);
        }
    },

    /**
     * @inheritdoc
     */
    _render: function() {
        this._super('_render');

        // make sure commit_stage enum maintains 'list' class for style reasons
        if(this.name === 'commit_stage' && this.$el.hasClass('disabled')) {
            this.$el.addClass('list');
        }
    }
})
