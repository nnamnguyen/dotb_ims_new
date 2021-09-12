({
    extendsFrom: 'PanelTopView',

    /**
     * Addes by HieuPham to create a demo schedule via bwc
     * @param event
     */
    createDemoSchedule: function (event) {
        var id = app.controller.context.attributes.modelId;
        var module = app.controller.context.attributes.module;
        window.location.replace('#bwc/index.php?module=Meetings&action=EditView&return_module=' + module + '&return_action=DetailView&return_id=' + id + '&type=Demo');
    },

    /**
     * Addes by HieuPham to create a PT schedule via bwc
     * @param event
     */
    createPTSchedule: function (event) {
        var id = app.controller.context.attributes.modelId;
        var module = app.controller.context.attributes.module;
        window.location.replace('#bwc/index.php?module=Meetings&action=EditView&return_module=' + module + '&return_action=DetailView&return_id=' + id + '&type=PT');
    },

    /**
     * Addes by HieuPham to open drawer to select a Demo Schedule
     * @param event
     */
    selectDemoSchedule: function (event) {
        var self = this;
        var filterOptions = new app.utils.FilterOptions().config({
            initial_filter_label: 'Demo',
            initial_filter: 'by_type_demo',
            filter_populate: ['meeting_type']
        });

        app.drawer.open({
            layout: 'selection-list',
            context: {
                fields: ['meeting_type'],
                module: 'Meetings',
                filterOptions: filterOptions.format()
            }
            }, function (model) {
                if (model) {
                    self.setReturnLeadDemo(model);
                }
        });

    },

    /**
     * Addes by HieuPham to open drawer to select a PT Schedule
     * @param event
     */
    selectPTSchedule: function (event) {
        var self = this;
        var filterOptions = new app.utils.FilterOptions().config({
            initial_filter_label: 'Placement Test',
            initial_filter: 'by_type_pt',
            filter_populate: ['meeting_type']
        });

        app.drawer.open({
            layout: 'selection-list',
            context: {
                fields: ['meeting_type'],
                module: 'Meetings',
                filterOptions: filterOptions.format()
            }
            }, function (model) {
                if (model) {
                    self.setReturnLeadPT(model);
                }
        });


    },

    setReturnLeadPT: function (model, filter) {
        var id = app.controller.context.attributes.modelId;
        var module = app.controller.context.attributes.module;
        var self = this;


        if (model.meeting_type != 'Placement Test') {
            self.alertUser( app.lang.get('LBL_ONLY_PT', 'Meetings'), 'error');
            return false;
        }
        app.alert.show('wait', {
            level: 'process',
            title: 'Waiting'
        });

        var preferences = {};
        preferences['meeting_id'] = model.id;
        preferences['parent'] = module;
        preferences['id'] = id;
        preferences['name'] = app.controller.context.attributes.model.get('name');

        DOTB.App.api.call('update', DOTB.App.api.buildURL(module, 'save-pt'), preferences, {
            success: function (data) {
                if (data) {
                    self.alertUser(app.lang.get('LBL_COMPLETE', 'Meetings'), 'success');
                    $('[data-action=refreshList]').trigger('click');
                } else {
                    self.alertUser(app.lang.get('LBL_ERROR_EXISTS_PT', 'Meetings'), 'error');
                }
                app.alert.dismiss('wait');
            },
            error: function (data) {
                console.log(data);
                self.alertUser(app.lang.get('LBL_ERROR', 'Meetings'), 'error');
                app.alert.dismiss('wait');
            }
        });

    },

    setReturnLeadDemo: function (model, filter) {
        var id = app.controller.context.attributes.modelId;
        var module = app.controller.context.attributes.module;
        var name = app.controller.context.attributes.model.get('name');
        var self = this;


        if (model.meeting_type != 'Demo') {
            self.alertUser( app.lang.get('LBL_ONLY_DEMO', 'Meetings'), 'error');
            return false;
        }

        app.alert.show('wait', {
            level: 'process',
            title: 'Waiting'
        });

        var preferences = {};
        preferences['meeting_id'] = model.id;
        preferences['parent'] = module;
        preferences['id'] = id;
        preferences['name'] = name;

        DOTB.App.api.call('update', DOTB.App.api.buildURL(module, 'save-demo'), preferences, {
            success: function (data) {
                if (data) {
                    self.alertUser(app.lang.get('LBL_COMPLETE', 'Meetings'), 'success');
                    $('[data-action=refreshList]').trigger('click');
                } else {
                    self.alertUser(app.lang.get('LBL_ERROR_EXISTS_DEMO', 'Meetings'), 'error');
                }
                app.alert.dismiss('wait');
            },
            error: function (data) {
                console.log(data);
                self.alertUser(app.lang.get('LBL_ERROR', 'Meetings'), 'error');
                app.alert.dismiss('wait');
            }
        });
    },


    /**
     * Addes by Hieu Pham to redirect to create payment
     * @param event
     */
    studentCreatePayment: function (event) {
        var id = app.controller.context.attributes.modelId;
        window.location.replace('#bwc/index.php?module=J_Payment&action=EditView&return_module=J_Payment&return_action=DetailView&payment_type=Cashholder&student_id=' + id);
    },

    /**
     * Addes by Hieu Pham to redirect to create enrollment
     * @param event
     */
    studentCreateEnrollment: function (event) {
        var id = app.controller.context.attributes.modelId;
        window.location.replace('#bwc/index.php?module=J_Payment&action=EditView&return_module=J_Payment&return_action=DetailView&payment_type=Enrollment&student_id=' + id);
    },

    /**
     * Addes by Hieu Pham to redirect to create payment
     * @param event
     */
    leadCreatePayment: function (event) {
        var id = app.controller.context.attributes.modelId;
        window.location.replace('#bwc/index.php?module=J_Payment&action=EditView&return_module=J_Payment&return_action=DetailView&payment_type=Deposit&lead_id=' + id);
    },

    /**
     * Addes by HieuPham to open drawer select class to add demo
     * @param event
     */
    addDemoToClass: function (event) {
        var self = this;

        app.drawer.open({
            layout: 'selection-list',
            context: {
                fields: ['short_schedule'],
                module: 'J_Class'
            }
            }, function (model) {
                if (model) {
                    self.setReturnClass(model);
                }

        });


    },

    addLoyalty: function (event) {

        var student_id = app.controller.context.attributes.modelId;
        var student_name = app.controller.context.attributes.model.get('name');
        window.location.replace('#bwc/index.php?module=J_Loyalty&action=EditView&student_id='+student_id+'&student_name='+student_name);
    },

    setReturnClass: function (model, filter) {
        app.alert.show('wait', {
            level: 'process'
        });

        var id = app.controller.context.attributes.modelId;
        var module = app.controller.context.attributes.module;
        var name = app.controller.context.attributes.model.get('name');
        var self = this;

        var preferences = {};
        preferences['model'] = model;
        preferences['student_type'] = module;
        preferences['student_id'] = id;
        preferences['student_name'] = name;

        app.api.call('update', app.api.buildURL('J_Class', 'add-demo-popup'), preferences, {
            success: function (data) {
                if (data) {
                    window.top.$.openPopupLayer({
                        name: "dialog_demo",
                        width: "auto",
                        height: "auto",
                        html: data
                    });

                    options = {
                        format: app.date.toDatepickerFormat(app.user.attributes.preferences.datepref),
                        weekStart: parseInt(app.user.getPreference('first_day_of_week'), 10),
                    };

                    $('input[name="dm_lesson_date"]').datepicker(options);
                    $('input[name="dm_lesson_to_date"]').datepicker(options);
                    $('div.datepicker').css('z-index', '9000');

                    $('#btn_add_demo').live('click', function () {
                        self.addDemo('create', '',model.id);
                    });
                    app.alert.dismiss('wait');
                }
            },
            error: function (data) {
                console.log(data);
                self.alertUser(app.lang.get('LBL_ERROR', 'Meetings'), 'error');
                app.alert.dismiss('wait');
            }
        });

        console.log(model);
    },

    /**
     * Added By HP
     * To Add/Remove a Lead/Student into a Demo Class
     * @param action_demo
     * @param situa_id
     */
    addDemo: function (action_demo, situa_id, dm_class_id) {
        var dm_student_id = $('#dm_student_id').val();
        var dm_lesson_date = $('#dm_lesson_date').val();
        var dm_lesson_to_date = $('#dm_lesson_to_date').val();
        var dm_type_student = $('#dm_type_student').val();
        var self = this;

        if(!self.isInSchedule(dm_lesson_date))
        return false;

        if(!self.isInSchedule(dm_lesson_to_date))
        return false;

        if( dm_student_id == '' || dm_lesson_date == '' || dm_lesson_to_date == '' || dm_type_student == '')
            return false;



        app.alert.show('wait', {
            level: 'process'
        });
        $.ajax({
            type: "POST",
            url: "index.php?module=J_Class&action=handleAjaxJclass&dotb_body_only=true",
            data:
            {
                dm_student_id: dm_student_id,
                dm_lesson_date: dm_lesson_date,
                dm_lesson_to_date: dm_lesson_to_date,
                dm_type_student: dm_type_student,
                dm_class_id: dm_class_id,
                action_demo: action_demo,
                situa_id: situa_id,
                type: "addDemo",
            },
            dataType: "json",
            success: function (data) {
                if (data.success == "1") {
                    window.top.$.closePopupLayer('dialog_demo');
                    $('[data-action=refreshList]').trigger('click');
                    self.alertUser(data.notify, 'success');
                } else {
                    self.alertUser(data.error, 'error');
                }
                app.alert.dismiss('wait');
                $('#btn_add_demo').show();
            },
            error: function(data){
                window.top.$.closePopupLayer('dialog_demo');
                console.log(data);
                app.alert.dismiss('wait');
            }
        });
    },

    /**
     * Added by HP
     * To check date demo have in lession list
     * @param start_study
     * @param end_study
     */
    isInSchedule: function (checking_date) {
        var rs = new Object();
        var json_sessions     = $("#json_sessions").val();
        var flag = false;
        if( checking_date != '' && json_sessions != ''){
            var checking_date = DOTB.util.DateUtils.parse(checking_date,app.user.attributes.preferences.datepref);

            obj = JSON.parse(json_sessions);
            flag = DOTB.util.DateUtils.formatDate(checking_date,false,"Y-m-d") in obj;
            if(!flag)
                this.alertUser(app.lang.get('LBL_DATE_NOT_IN_SCHEDULE', 'J_Class'),'error');
        }
        return flag;
    },



    /**
     * Added by Hieu Pham to show alert
     * @param msg - Label message in Module ( ex: LBL_ERROR)
     * @param level - level of alert (ex: error, success)
     */
    alertUser: function (msg, level) {
        app.alert.show('no-lumia-access', {
            level: level,
            title: app.lang.get(msg, app.controller.context.attributes.module),
            autoClose: true,
        });
    }
});
