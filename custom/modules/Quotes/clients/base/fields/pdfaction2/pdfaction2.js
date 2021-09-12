({
    extendsFrom: 'RowactionField',
    events: {
        'click [data-action=pdfaction2]': 'pdfaction2'
    },

    initialize: function (options) {
        this._super('initialize', [options]);
    },

    pdfaction2: function () {
        const urlParams = $.param({
            'm': this.module,
            'r': this.model.id,
            'name': this.model.get('name'),
            'download_type': this.def.download_type
        });
        window.location.href = app.config.site_url +'/rest/v11_3/adminconfig/download_order_pdf?' + urlParams;
    }
})
