({
    events: {
        'click #generate_license': 'generationLicense',
    },
    initialize: function (options) {
        this._super('initialize', [options]);
    },
    generationLicense: function () {
        app.api.call("create", app.api.buildURL('adminconfig/generation_license'), {
            users: $('input[name="lic-users"]').val(),
            teams: $('input[name="lic-teams"]').val(),
            students: $('input[name="lic-students"]').val(),
            storage: $('input[name="lic-storage"]').val(),
            package: $('input[name="lic-package"]').val(),
            date_expired: $('input[name="lic-date_expired"]').val()
        }, {
            success: function (res) {
                $('.lic-result').val(res);
            }
        });
    }
})
