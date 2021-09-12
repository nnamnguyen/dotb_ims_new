
({
    initialize: function(options) {
        this._super('initialize', [options]);
        var request = this.context.get('request');
        this.page = request.page_details;
    }
})
