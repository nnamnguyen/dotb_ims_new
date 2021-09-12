({
    extendsFrom: 'BadgeSelectField',
    initialize: function (options) {
        this._super('initialize', [options]);
        this.statusClasses = {
            'Held': 'textbg_green',
            'Not Held': 'label-important',
            'Planned': 'label-pending',
            'New': 'textbg_green',
            'In Process': 'textbg_blue',
            'In Progress': 'textbg_blue',
            'Converted': 'textbg_red',
            'Waiting payment': 'textbg_crimson',
            'Delayed': 'textbg_black',
            'Finished': 'textbg_crimson',
            'OutStanding': 'textbg_orange',
            'Recycled': 'textbg_orange',
            'Ready to PT': 'textbg_bluelight',
            'Ready to Demo': 'textbg_bluelight',
            'Assigned': 'textbg_bluelight',
            'PT/Demo': 'textbg_violet',
            "Deposit": "textbg_crimson",
            'Dead': 'textbg_black',

            'Not Started':'label-pending',
            'Completed':'textbg_green',
            'Pending Input':'textbg_bluelight',
            'Deferred':'label-important',
            'Not Applicable':'textbg_black',
            'Demo':'textbg_orange',
            'Qualified':'textbg_bluelight',
            'Converted':'textbg_red',
            'Draw data':'textbg_green',
            'Transferred':'textbg_red',
            'Junk':'textbg_orange',
            'Balance': 'textbg_green',
            'Cashholder': 'textbg_green',
            'Available' : 'textbg_green',
            'Draft' :'textbg_black',
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
