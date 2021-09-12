({
    extendsFrom: 'BadgeSelectField',
    initialize: function (options) {
        this._super('initialize', [options]);
        this.statusClasses = {
            'Active': 'textbg_green',
            'Inactive': 'textbg_red',
            'Expired': 'textbg_red'
        };

        this.type = 'badge-select';
    }
})
