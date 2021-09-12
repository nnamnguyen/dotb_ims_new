({
    extendsFrom: 'RecordlistView',
    initialize: function(options) {
        this._super("initialize", [options]);
        this.context.on('list:composeSMS:fire',this.composeSMS,this);
    },
    composeSMS:function(){
        openPopupSendSMSForMulti('Contacts','');
    },
})