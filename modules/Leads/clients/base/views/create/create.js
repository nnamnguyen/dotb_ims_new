
/**
 * @class View.Views.Base.Leads.CreateView
 * @alias DOTB.App.view.views.LeadsCreateView
 * @extends View.Views.Base.CreateView
 */
({
    extendsFrom: 'CreateView',

    getCustomSaveOptions: function(){
        var options = {};

        if(this.context.get('prospect_id')) {
            options.params = {};
            // Needed for populating the relationship
            options.params.relate_to = 'Prospects';
            options.params.relate_id = this.context.get('prospect_id');
            this.context.unset('prospect_id');
        }

        return options;
    }
})
