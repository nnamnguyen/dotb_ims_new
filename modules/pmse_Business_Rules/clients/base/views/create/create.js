
/**
 * @class View.Views.Base.pmse_Business_Rules.CreateView
 * @alias DOTB.App.view.views.pmse_Business_RulesCreateView
 * @extends View.Views.Base.CreateView
 */
({
    extendsFrom: 'CreateView',

    saveOpenBusinessRulesName: 'save_open_businessrules',

    SAVEACTIONS: {
        SAVE_OPEN_BUSINESRULES: 'saveOpenBusinessRules'
    },

    initialize: function(options) {
        options.meta = _.extend({}, app.metadata.getView(null, 'create'), options.meta);
        this._super('initialize', [options]);
        this.context.on('button:' + this.saveOpenBusinessRulesName + ':click', this.saveOpenBusinessRules, this);
    },

    save: function () {
        switch (this.context.lastSaveAction) {
            case this.SAVEACTIONS.SAVE_OPEN_BUSINESRULES:
                this.saveOpenBusinessRules();
                break;
            default:
                this.saveAndClose();
        }
    },

    saveOpenBusinessRules: function() {
        this.context.lastSaveAction = this.SAVEACTIONS.SAVE_OPEN_BUSINESRULES;
        this.initiateSave(_.bind(function () {
            app.navigate(this.context, this.model, 'layout/businessrules');
        }, this));
    }
})
