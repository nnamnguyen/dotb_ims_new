({
    extendsFrom: 'BadgeSelectField',
    initialize: function (options) {
        this._super('initialize', [options]);
        this.statusClasses = {
            'Activated' : 'textbg_green',
            'Inactive'  : 'textbg_bluelight',
            'Expired'   : 'textbg_crimson'
        };

        this.type = 'badge-select';
    },

    _loadTemplate: function () {
        var action = this.action || this.view.action;
        if (action === 'edit') {
            this.type = 'enum';
        }

        this._super('_loadTemplate');
        this.type = 'badge-select';
    }
})
