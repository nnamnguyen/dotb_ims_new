
({
    extendsFrom: 'RowactionField',


    initialize: function (options) {

        if (typeof options.def.linkToSMS != "undefined") {
            if (typeof options.model.attributes != "undefined" && typeof options.model.attributes.phone_mobile != "undefined" && options.model.attributes.phone_mobile != '') {
                options.def.phone_mobile = options.model.attributes.phone_mobile;
                options.def.id = options.model.attributes.id;
                options.def.module = options.module;
                options.def.tooltip = options.model.attributes.phone_mobile;
            }else{
                options.def.linkToSMS = false;
                options.def.icon = 'fa-comment-slash smallerFont';

            }
        }

        options.def.events = _.extend({}, options.def.events, {
            'click .rowaction': 'rowActionSelect'
        });
        this._super('initialize', [options]);



    },

})
