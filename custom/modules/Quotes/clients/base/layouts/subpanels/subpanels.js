({
    extendsFrom: 'SubpanelsLayout',

    _hiddenSubpanels: [],

    initialize: function(options) {
        this._super('initialize', [options]);
        this.registerModelEvents();
    },

    /**
     * Add the model change events for fields that determine when a subpanel should be hidden
     */
    _render: function(){
        this._super('_render');
        this.registerModelEvents();
    },

    registerModelEvents: function(){
        // this.model.on('change:quote_stage',function(model) {
        //     this.controllerSubpanel(model)
        // },this);
        this.controllerSubpanel(this.model);
    },

    controllerSubpanel:function(model){
        window.self = this;
        model.fetch({
            success:function (data) {
                if (data.get('quote_stage') != "Closed won"){
                    window.self.hideSubpanel('quote_paymentdetails');
                    window.self.hideSubpanel('quotes_b_invoices_1');
                    window.self.hideSubpanel('quotes_j_payment_1');
                    window.self.hideSubpanel('quotes_c_sitedeployment_1');
                }else{
                    window.self.unhideSubpanel('quote_paymentdetails');
                    window.self.unhideSubpanel('quotes_b_invoices_1');
                    window.self.unhideSubpanel('quotes_j_payment_1');
                    window.self.unhideSubpanel('quotes_c_sitedeployment_1');
                }
                window.self = undefined;
            }
        })
    },

    /**
     * Override showSubpanel to re-hide subpanels when outside changes occur, like reordering subpanel
     * @inheritdoc
     */
    showSubpanel: function(linkName) {
        this._super('showSubpanel',[linkName]);

        _.each(this._hiddenSubpanels, function(link) {
            this.hideSubpanel(link);
        },this);
    },

    /**
     * Helper for getting the Subpanel View for a specific link
     */
    getSubpanelByLink: function(link){
        return this._components.find(function(component){
            return component.context.get('link') === link;
        });
    },

    /**
     * Add to the _hiddenSubpanels array, and hide the subpanel
     */
    hideSubpanel: function(link){
        this._hiddenSubpanels.push(link);
        var component = this.getSubpanelByLink(link);
        if (!_.isUndefined(component)){
            component.hide();
        }
        this._hiddenSubpanels = _.unique(this._hiddenSubpanels);
    },

    /**
     * Unhide the Subpanel and remove from _hiddenSubpanels array
     */
    unhideSubpanel: function(link){
        var index = this._hiddenSubpanels.findIndex(function(l){
            return l == link;
        });
        if (_.isUndefined(index)){
            delete this._hiddenSubpanels[index];
        }
        var component = this.getSubpanelByLink(link);
        if (!_.isUndefined(component)){
            component.show();
        }
    }
})