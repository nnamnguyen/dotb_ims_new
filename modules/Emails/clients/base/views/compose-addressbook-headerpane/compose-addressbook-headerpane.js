
/**
 * @class View.Views.Base.Emails.ComposeAddressbookHeaderpaneView
 * @alias DOTB.App.view.views.BaseEmailsComposeAddressbookHeaderpaneView
 * @extends View.Views.Base.HeaderpaneView
 */
({
    extendsFrom: 'HeaderpaneView',

    events: {
        'click [name=done_button]': '_done',
        'click [name=cancel_button]': '_cancel'
    },

     /**
      * The user clicked the Done button so trigger an event to add selected recipients from the address book to the
      * target field and then close the drawer.
      *
      * @private
      */
     _done: function() {
         var recipients = this.model.get('to_collection');

         if (recipients) {
             app.drawer.close(recipients);
         } else {
             this._cancel();
         }
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
