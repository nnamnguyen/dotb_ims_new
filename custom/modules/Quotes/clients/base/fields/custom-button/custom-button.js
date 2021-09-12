
({
    events:{
        'click #use_balance':'chooseBalance',
    },

    /**
     * @inheritdoc
     *
     * Some plugins use events which prevents {@link View.Field#delegateEvents}
     * to fallback to metadata defined events.
     * This will make sure we merge metadata events with the ones provided by
     * the plugins.
     *
     * The Base Field will always clear any tooltips after `render`.
     */
    chooseBalance: function (evt) {
        var seft =this;
        app.alert.show('message-id', {
            level: 'confirmation',
            messages: app.lang.get('LBL_USE_FREE_BALANCE', 'Quotes'),
            autoClose: false,
            onConfirm: function(){
                app.alert.show('message-process', {
                    level: 'process',
                    title: 'In Process...'
                });
                app.api.call("create", App.api.buildURL('use/freeBalance'), {model:seft.model.attributes}, {
                    success: function (data) {
                        if(data.success == 1){
                            app.alert.show('message-id', {
                                level: 'success',
                                messages: 'Successfull',
                                autoClose: true
                            });
                            // app.alert.dismiss('message-process');
                            // seft.render();
                            // seft.context.trigger('subpanel:reload', {links: ['j_balance_quotes_1', 'j_balance']});
                            location.reload(true);
                        }
                    },
                    error: function (data) {
                        app.alert.dismiss('message-process');
                    }
                });
            },
            onCancel: function(){
            }
        });
    }

})
