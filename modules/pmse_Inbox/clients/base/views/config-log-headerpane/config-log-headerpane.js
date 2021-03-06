
({
    extendsFrom: "HeaderpaneView",

    events: {
        "click [name=save_button]":   "_save",
        "click [name=cancel_button]": "_cancel"
    },
    /**
     * Save the drawer.
     *
     * @private
     */
    _save: function() {
        app.alert.show('txtConfigLog', {level: 'process', title: 'Saving', autoclose: false})
        var value = this.model.attributes;
        value.frm_action = 'Approve';
        value.cfg_value=this.model.get('comboLogConfig');
        var url = app.api.buildURL('pmse_Inbox/logSetConfig','',{},{});
        app.api.call('update', url, value,{
            success: function (){
                app.alert.dismiss('txtConfigLog');
                app.drawer.close();
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
