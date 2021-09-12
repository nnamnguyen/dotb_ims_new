({
    plugins: ['ErrorDecoration'],
    fallbackFieldTemplate: 'edit',
    className: 'rtSbSettings',
    events: {
        'change .successDom': 'setStage',
        'change .failureDom': 'setStage',
    },
    stepTwoDom: {},
    initialize: function (options) {
        this._super('initialize', [options]);

        if (app.progress) {
            app.progress.hide();
        }
        if (app.user.get('type') == 'admin') {
            this.isAdministrator = true;
        }
        if (document.cookie.search('rtSbSet=Seen') == -1) {
            document.cookie = "rtSbSet = Seen; expires=Thu, 18 Dec 2033 12:00:00 UTC; path=/";
            app.alert.show('rtDotbBoards', {
                level: 'warning',
                title: app.lang.get('LBL_SB_CLEARCACHE'),
                messages: app.lang.get('LBL_SB_CLEARCACHE_MSG'),
            });
        }

        if (this.module == "RT_DotbBoards") {
            this.displayConfig = true;
            this.verifyLicense();
            this.stepTwo();
        } else {
            this.validationCompleted();
            this.displayConfig = false;
        }
    },


    verifyLicense: function () {
        var verifyURL = app.api.buildURL('rtDotbBoards/verify/', null, null, {
            oauth_token: app.api.getOAuthToken()
        });
        var thisVar = this;
        app.api.call('GET', verifyURL, null, {
            success: _.bind(function (result) {
                this.validate = !result;
                this.verify = result;
                this.validationCompleted();
            }, this),

            error: _.bind(function (e) {
                console.error(e);
            }, this)
        });
    },

    validationCompleted: function () {
        if (this.module == "RT_DotbBoards") {
            this.getLicKeyandErrMsg();
            this.render();
        } else {
            var rtDotbBoards = this.layout.getComponent('rtDotbBoards');
            if (rtDotbBoards.validate != undefined) {
                this.validate = !rtDotbBoards.validate;
                this.verify = rtDotbBoards.validate;
                if (this.validate) {
                    this.getLicKeyandErrMsg();
                    this.render();
                } else {
                    this.render();
                }
            }
        }
    },

    getLicKeyandErrMsg: function () {
        var licKeyURL = app.api.buildURL('rtDotbBoards/licKey/', null, null, {
            oauth_token: app.api.getOAuthToken()
        });
        app.api.call('GET', licKeyURL, null, {
            success: _.bind(function (result) {
                if (result != "") {
                    this.currLicKey = result;
                    var licenseURL = app.api.buildURL('rtDotbBoards/validate/' + this.currLicKey, null, null, {
                        oauth_token: app.api.getOAuthToken()
                    });
                    app.api.call('GET', licenseURL, null, {
                        success: _.bind(function (result) {
                            if (_.isString(result.data)) {
                                this.errMsg = result.data;
                                this.render();
                            } else {
                                this.render();
                            }
                        }, this),
                    });
                }
            }, this),
            error: _.bind(function (e) {
                console.error(e);
            }, this)
        });
    },

    render: function () {
        if (this.module == "RT_DotbBoards") {
            this.displayConfig = true;
            this.configMenu = true;
            this.licMenu = true;
            this.inSettings = true;
        } else if (this.module != "RT_DotbBoards" && this.verify == false) {
            this.configMenu = false;
            this.licMenu = true;
            this.inSettings = false;
        } else {
            this.configMenu = true;
            this.inSettings = false;
            this.licMenu = false;
        }

        this._super('render');

        if (this.module == "RT_DotbBoards" && this.module != undefined) {
            $(".rtSbSettingsMainDiv").css('display', 'block');
            $(".rtSbSettingsMainDiv .headerpane").css('display', 'block');
        } else if (this.module != "RT_DotbBoards" && this.verify == false && this.module != undefined) {
            $(".rtSbSettingsMainDiv").css('display', 'block');
        } else if (this.displayConfig == true) {
            $(".rtSbSettingsMainDiv").css('display', 'block');
        } else if (this.displayConfig == false) {
            $(".rtSbSettingsMainDiv").hide();
        }


        if (this.currLicKey) {
            if (document.getElementById("license_key")) {
                document.getElementById("license_key").value = this.currLicKey;
            }
        }
        $('.rtSbLicErrorMsg').text(this.errMsg);
        if (!this.isAdministrator) {
            $(".container").css('border-color', "#ffffff");
            $(".container").css('width', "auto");
        }
        var acc = document.getElementsByClassName("rtSbAccordion");
        var i;
        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }


    },

    setStage: function (event) {
        var reqCollection = app.data.createBeanCollection('RT_DotbBoards');

        if (event.currentTarget.value !== "") {
            app.alert.show('rtDotbBoards_processStage', {
                level: 'process'
            });
            reqCollection.fetch({
                fields: ['boardModule', 'groupBy', 'successStage', 'failureStage'],
                success: _.bind(function (data) {
                    var collAtts = _.pluck(reqCollection.models, "attributes");
                    var rec = _.findWhere(collAtts, {
                        boardModule: event.currentTarget.dataset.module,
                        groupBy: event.currentTarget.dataset.groupby
                    });
                    if (rec) {
                        var bean = app.data.createBean('RT_DotbBoards', {
                            id: rec.id
                        });
                        bean.fetch({
                            error: _.bind(function (err) {
                                app.alert.dismiss('rtDotbBoards_processStage');
                                console.error(err);
                            }, this),
                            success: _.bind(function (model) {
                                if (event.currentTarget.classList.value == 'successDom') {
                                    model.set('successStage', event.currentTarget.value);
                                } else {
                                    model.set('failureStage', event.currentTarget.value);
                                }
                                model.save().xhr.success(function (a) {
                                    app.alert.dismiss('rtDotbBoards_processStage');
                                    app.alert.show('rtDotbBoards', {
                                        autoClose: true,
                                        level: 'success',
                                        title: app.lang.get('LBL_SB_SAVED')
                                    });
                                }).error(function (e) {
                                    app.alert.dismiss('rtDotbBoards_processStage');
                                    app.alert.show('rtDotbBoards', {
                                        level: 'error',
                                        title: app.lang.get('LBL_SB_ERROR')
                                    });
                                    console.error('Kanban Error: ', e);
                                });
                            })
                        });
                    } else {
                        if (event.currentTarget.classList.value == 'successDom') {
                            app.alert.dismiss('rtDotbBoards_processStage');
                            app.alert.show('rtDotbBoards', {
                                autoClose: true,
                                level: 'success',
                                title: app.lang.get('LBL_SB_SAVED')
                            });
                            var bean = app.data.createBean('RT_DotbBoards', {
                                boardModule: event.currentTarget.dataset.module,
                                groupBy: event.currentTarget.dataset.groupby,
                                successStage: event.currentTarget.value,
                            });
                            //bean.attributes.module = event.currentTarget.dataset.module;
                            bean.save();
                        } else {
                            app.alert.dismiss('rtDotbBoards_processStage');
                            app.alert.show('rtDotbBoards', {
                                autoClose: true,
                                level: 'success',
                                title: app.lang.get('LBL_SB_SAVED')
                            });
                            var bean = app.data.createBean('RT_DotbBoards', {
                                boardModule: event.currentTarget.dataset.module,
                                groupBy: event.currentTarget.dataset.groupby,
                                failureStage: event.currentTarget.value,
                            });
                            //bean.attributes.module = event.currentTarget.dataset.module;
                            bean.save();
                        }
                    }
                })
            });
        }
    },


    stepTwo: function () {
        var thisVar = this;
        var reqCollection = app.data.createBeanCollection('RT_DotbBoards');
        var collAtts;
        reqCollection.fetch({
            fields: ['boardModule', 'groupBy', 'successStage', 'failureStage'],
            success: _.bind(function (data) {
                collAtts = _.pluck(reqCollection.models, "attributes");
                thisVar.makeStepTwoObject(collAtts);
                thisVar.render();
            })
        });
    },

    makeStepTwoObject: function (collAtts) {
        var thisVar = this;
        var modToDisp = app.metadata.getView('RT_DotbBoards', 'rtSbSettings')['Modules'];
        var stepTwo = {};

        if (this.module !== "RT_DotbBoards") {
            modToDisp = [this.module];
        }

        $.each(modToDisp, function (key, value) {
            var sfStageMeta = app.metadata.getView(value, 'rtDotbBoards')['successFailureStage'];
            if (sfStageMeta) {
                $.each(sfStageMeta, function (key2, value2) {
                    var modMeta = app.metadata.getModule(value, 'fields')[key2];
                    value2['dom'] = app.lang.getAppListStrings(modMeta['options']);
                    if (value2['dom'] !== "") {
                        value2['dom'] = Object.assign({
                            "": ""
                        }, value2['dom']);
                    }
                    var rec = _.findWhere(collAtts, {
                        boardModule: value,
                        groupBy: key2
                    });
                    if (rec) {
                        if (rec.successStage) {
                            value2['success'] = rec.successStage;
                        }
                        if (rec.failureStage) {
                            value2['failure'] = rec.failureStage;
                        }
                    }
                    value2['mod'] = value;
                    value2['groupBy'] = key2;
                    stepTwo[value] = {};
                    stepTwo[value][app.lang.get(modMeta.vname, value)] = value2;
                    thisVar.stepTwoDom = stepTwo;
                });
            }
        })
    },

    loadData: function () {
        if (app.user.get('type') == 'admin') {
            this.isAdministrator = true;
        }

    },

    validateLicense: function () {
        this.key = $('input[name=license_key]').val();
        if (!this.key) {
            return;
        }
        var licenseURL = app.api.buildURL('rtDotbBoards/validate/' + this.key, null, null, {
            oauth_token: app.api.getOAuthToken()
        });
        app.alert.show('rtDotbBoards_process', {
            level: 'process',
            title: app.lang.get('LBL_SB_VALIDATING')
        });
        app.api.call('GET', licenseURL, null, {
            success: _.bind(function (result) {
                if (_.isString(result.data)) {
                    app.alert.dismiss('rtDotbBoards_process');
                    this.errMsg = result.data;
                    app.alert.show(this.className, {
                        level: 'error',
                        title: app.lang.get('LBL_SB_INVALID_KEY')
                    });
                    this.verifyLicense();
                } else {
                    app.alert.dismiss('rtDotbBoards_process');
                    app.alert.show(this.className, {
                        autoClose: true,
                        level: 'success',
                        messages: app.lang.get('LBL_SB_VALIDATED')
                    });
                    this.errMsg = "";
                    if (this.module != 'RT_DotbBoards') {
                        location.reload();
                    } else {
                        this.verifyLicense();
                    }
                }
            }, this),

            error: _.bind(function (e) {
                app.alert.dismiss('rtDotbBoards_process');
                app.alert.show(this.className, {
                    level: 'error',
                    title: app.lang.get('LBL_SB_ERROR')
                });
                console.error('rtDotbBoards -- ', e);
            }, this)
        });
    },
})