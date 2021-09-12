({
    extendsFrom: "LoginView",

    demoUser: [
        {user: 'Admin'},
        {user: 'Sale'},
        {user: 'Marketing'},
        {user: 'Sheduler'}
    ],

    initialize: function (options) {
        this._super('initialize', [options]);
        1
        this.defaultView = false;

        this.events = _.extend(this.events, {
            'change .change-language': 'setLanguage',
            'click .login_trial_button': 'hackLogin'
        });
        this.lbl_username = app.lang.get('LBL_USERNAME');
        this.lbl_password = app.lang.get('LBL_PASSWORD');
        this.lbl_btn_login = app.lang.get('LBL_LOGIN');
    },

    _renderHtml: function () {
        this.currentLang = app.lang.getLanguage() || "en_us";
        this.languageList = this.formatLanguageList();
        this.loginTrial = app.config.login_trial;
        this._super('_renderHtml');
    },

    showErrorAlert: function () {
        app.alert.show('verify_key_fail', {
            level: 'error',
            messages: app.lang.get('LBL_VERIFY_KEY_FAIL'),
            autoClose: true
        });
    },

    hackLogin: function () {
        var username = $('[name="username_trial"]').val().trim(),
            verifykey = $('[name="verify_key_trial"]').val().trim();
        if(username=='' || verifykey==''){
            app.alert.show('required_input_full', {
                level: 'error',
                messages: app.lang.get('LBL_PLEASE_INPUT_USER_VERIFY_KEY', 'Users'),
                autoClose: true
            });
            return;
        }
        app.alert.show(this._alertKeys.login, {
            level: 'process',
            title: app.lang.get('LBL_LOADING'),
            autoClose: false
        });
        var key = $('[name="verify_key_trial"]').val().trim();
        $.ajax({
            url: 'trialLoginValidate.php?key=' + key + '&username=' + $('[name="username_trial"]').val().trim(),
            method: 'GET',
            dataType: 'json',
            data: {},
            success: _.bind(function (data) {
                if (data.success) {
                    var username = $('[name="username_trial"]').val().trim();

                    if (username == "Admin") {
                        var user = {
                            username: "admin",
                            password: data.password
                        }
                    }

                    this.model.set({
                        password: user.password,
                        username: user.username
                    });

                    if (app.api.isExternalLogin() &&
                        app.config.externalLogin === true &&
                        !_.isNull(app.config.externalLoginSameWindow) &&
                        app.config.externalLoginSameWindow === false
                    ) {
                        app.config.externalLogin = false;
                        app.config.externalLoginUrl = undefined;
                        app.api.setExternalLogin(false);
                        this.closeLoginPopup();
                    }

                    this.model.doValidate(null,
                        _.bind(function (isValid) {
                            if (isValid) {
                                app.$contentEl.hide();

                                app.alert.show(this._alertKeys.login, {
                                    level: 'process',
                                    title: app.lang.get('LBL_LOADING'),
                                    autoClose: false
                                });

                                var args = {
                                    password: this.model.get('password'),
                                    username: this.model.get('username')
                                };

                                app.login(args, null, {
                                    error: _.bind(function (error) {
                                        this.showDotbLoginForm(error);
                                    }, this),
                                    success: _.bind(function () {
                                        app.logger.debug('logged in successfully!');
                                        app.alert.dismiss(this._alertKeys.invalidGrant);
                                        app.alert.dismiss(this._alertKeys.needLogin);
                                        app.alert.dismiss(this._alertKeys.login);
                                        //External login URL should be cleaned up if the login form was successfully used instead.
                                        app.config.externalLoginUrl = undefined;

                                        app.events.on('app:sync:complete', function () {
                                            app.events.trigger('data:sync:complete', 'login', null, {
                                                'showAlerts': {'process': true}
                                            });
                                            app.api.setRefreshingToken(false);
                                            app.logger.debug('sync in successfully!');
                                            _.defer(_.bind(this.postLogin, this));
                                        }, this);
                                    }, this),
                                    complete: _.bind(function (request) {
                                        if (request.xhr.status == 401) {
                                            this.showDotbLoginForm();
                                        }
                                    }, this)
                                });
                            }
                        }, this)
                    );

                    app.alert.dismiss('offset_problem');
                } else {
                    this.showErrorAlert();
                    app.alert.dismiss(this._alertKeys.login);
                }
            }, this)
        });
    },

    setLanguage: function (e) {
        var langKey = $(e.currentTarget).val();
        app.alert.show('language', {level: 'warning', title: app.lang.get('LBL_LOADING_LANGUAGE'), autoclose: false});
        app.lang.setLanguage(langKey, function () {
            app.alert.dismiss('language');
        });
    },

    /**
     * Formats the language list for the template
     *
     * @return {Array} of languages
     */
    formatLanguageList: function () {
        // Format the list of languages for the template
        var list = [],
            languages = app.lang.getAppListStrings('available_language_dom');

        _.each(languages, function (label, key) {
            if (key !== '') {
                list.push({key: key, value: label});
            }
        });
        return list;
    }
})
