({
    data: {
        users: '',
        teams: '',
        students: '',
        storage: false,
        package: false,
        date_expired: false,
        is_expired: false,
        date_expired_color: 'success'
    },
    initialize: function (options) {
        this._super('initialize', [options]);
        options = options || {};
        _.extend(options, {
            success: _.bind(function (res) {
                this.data.users = res.users + ' / ' + app.config.dotbheart.users;
                this.data.teams = res.teams + ' / ' + app.config.dotbheart.teams;
                this.data.date_expired = app.config.dotbheart.heartbeat;
                this.data.storage = res.storage + ' / ' + app.config.dotbheart.storage + ' GB';
                this.data.students = res.students + ' / ' + app.config.dotbheart.students;
                this.data.package = app.config.dotbheart.package;
                this.data.date_update = app.config.dotbheart.date_update;
                if (App.date.parse(app.config.dotbheart.heartbeat, "Y-m-d") < new Date()) {
                    this.data.date_expired_color = "important";
                    this.data.is_expired = true;
                }
                this.render();
            }, this)
        });
        app.api.call("read", app.api.buildURL('adminconfig/get_dotbheart'), null, options);
    }
})
