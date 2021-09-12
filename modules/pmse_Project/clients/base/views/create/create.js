
/**
 * @class View.Views.Base.pmse_Project.CreateView
 * @alias DOTB.App.view.views.pmse_ProjectCreateView
 * @extends View.Views.Base.CreateView
 */
({
    extendsFrom: 'CreateView',

    saveOpenDesignName: 'save_open_design',

    SAVEACTIONS: {
        SAVE_OPEN_DESIGN: 'saveOpenDesign'
    },

    initialize: function(options) {
        options.meta = _.extend({}, app.metadata.getView(null, 'create'), options.meta);
        this._super('initialize', [options]);
        this.context.on('button:' + this.saveOpenDesignName + ':click', this.saveOpenDesign, this);
    },

    save: function () {
        switch (this.context.lastSaveAction) {
            case this.SAVEACTIONS.SAVE_OPEN_DESIGN:
                this.saveOpenDesign();
                break;
            default:
                this.saveAndClose();
        }
    },

    saveOpenDesign: function() {
        this.context.lastSaveAction = this.SAVEACTIONS.SAVE_OPEN_DESIGN;
        this.initiateSave(_.bind(function () {
            app.navigate(this.context, this.model, 'layout/designer');
        }, this));
    }
})
