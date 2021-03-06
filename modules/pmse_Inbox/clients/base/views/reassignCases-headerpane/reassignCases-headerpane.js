
/**
 * @class View.Views.Base.pmse_Inbox.ReassignCasesHeaderpaneView
 * @alias DOTB.App.view.views.Basepmse_InboxReassignCasesHeaderpaneView
 * @extends View.Views.Base.HeaderpaneView
 */
({
    extendsFrom: "HeaderpaneView",

    events: {
        'click [name=done_button]':   '_done',
        'click [name=cancel_button]': '_cancel'
    },

     /**
      * Clicking the Done button will update the process with the new process user
      * and close the drawer
      *
      * @private
      */
     _done: function() {
         // If collection.models is missing or empty then there is nothing to save
         if (_.isUndefined(this.collection.models) || (this.collection.models.length == 0)) {
             app.drawer.close();
             return;
         }

         var attributes = {};
         app.alert.show('saving', {level: 'process', title: 'LBL_SAVING', autoclose: false});
         var url = app.api.buildURL('pmse_Inbox', 'reassignFlows', null, null);

         // we only have one model
         var model = _.first(this.collection.models);
         attributes.flow_data = [{
             'cas_id': model.get('cas_id'),
             'cas_index': model.get('cas_index'),
             'user_id': model.get('id')
         }];

         app.api.call('update', url, attributes, {
             success: function (data) {
                 app.alert.dismiss('saving');
                 app.drawer.close('saving');
                 app.router.refresh();
             },
             error: function (err) {
             }
         });
     },

    /**
     * Close the drawer.
     *
     * @private
     */
    _cancel: function() {
        app.drawer.close();
    }
})
