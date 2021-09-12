({
    /**
     * The file used to customize create action of survey 
     *
     * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
     * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
     * agreed to the terms and conditions of the License, and you may not use this file except in compliance
     * with the License.
     *
     * @author     Biztech Consultancy
     */

    extendsFrom: 'CreateView',
    /**
     * @inheritdoc
     *
     * Wires up the save buttons.
     */
    delegateButtonEvents: function () {
        this.context.on('button:save_button:click', this.save, this);
        this.context.on('button:cancel_button:click', this.cancel, this);
        this.context.on('button:restore_button:click', this.restoreModel, this);
    },
    /**
     * Determine appropriate save action and execute it
     * Default to saveAndClose
     */
//    save: function () {
////        this.saveAndClose();
//    },
    events: {
        'click .insert_field_name_in_content': 'insert_field_name_sms',
        'click .insert_survey_link_in_content': 'insert_survey_link_sms'
    },
    /**
     * Handle click on the cancel link
     */
//    cancel: function () {
//        this._super('cancel');
////        delete localStorage['copyFromSurvey']; // delete local variable to re use in another survey
//    },
    initialize: function (options) {

        this._super('initialize', [options]);
    },
    _render: function () {
        var self = this;
        this._super('_render');
        if (self.action != "edit" && self.action != "detail") {
            var survey_id = self.action;
        } else {
            var survey_id = "";
        }
        //retrive all survey data
        var url = App.api.buildURL("bc_survey_sms_template", "get_survey_list", "", {'survey_id': survey_id});
        App.api.call('create', url, {}, {
            success: function (data) {
                // add "Get Shareable Link" Button to record view
                if ($($("#drawers").find('[data-name="sms_content"]')[0]).length == 1) {
                    $("#drawers").find('[data-name="sms_field_name"]').parents('.panel_body').append('<div class="span4 record-cell edit" data-type="enum" data-name="sms_insert_field_button"><div class="btn btn-primary insert_field_name_in_content" rel="tooltip" data-original-title="Insert field in Content" style="margin-top:15px;">Add Field</div></div>');
                } else {
                    $('[data-name="sms_field_name"]').parents('.panel_body').append('<div class="span4 record-cell edit" data-type="enum" data-name="sms_insert_field_button"><div class="btn btn-primary insert_field_name_in_content" rel="tooltip" data-original-title="Insert field in Content" style="margin-top:15px;">Add Field</div></div>');
                }
                if ($($("#drawers").find('[data-name="sms_content"]')[0]).length == 1) {
                    $("#drawers").find('[data-name="sms_content"]').parents('.panel_body').parent().append('<div class="row-fluid panel_body"><div class="span4 record-cell" data-type="textarea" data-name="sms_survey_list"><div class="record-label" data-name="sms_survey_list">Survey List</div><span class="normal index" data-fieldname="sms_survey_list" data-index=""><span sfuuid="24" class="detail"><div>' + data['html'] + '</div></span></span></div><div class="span6 record-cell" data-type="textarea" data-name="sms_survey_list"><div class="btn btn-primary insert_survey_link_in_content" rel="tooltip" data-original-title="Insert survey in Content" style="margin-top:20px;">Add survey link</div></span></div></div>');
                } else {
                    $('[data-name="sms_content"]').parents('.panel_body').parent().append('<div class="row-fluid panel_body"><div class="span4 record-cell" data-type="textarea" data-name="sms_survey_list"><div class="record-label" data-name="sms_survey_list">Survey List</div><span class="normal index" data-fieldname="sms_survey_list" data-index=""><span sfuuid="24" class="detail"><div>' + data['html'] + '</div></span></span></div><div class="span6 record-cell" data-type="textarea" data-name="sms_survey_list"><div class="btn btn-primary insert_survey_link_in_content" rel="tooltip" data-original-title="Insert survey in Content" style="margin-top:20px;">Add survey link</div></span></div></div>');
                }
//               
                $('[data-name="sms_content"]').append('<input type="hidden" id="survey_selected_value" value=""/>');
            }
        });
    },
    insert_field_name_sms: function () {
        var self = this;
        if ($($("#drawers").find('[data-name="sms_content"]')[0]).length == 1) {
            var module_name = $("#drawers").find('[name="sms_sync_module_list"]').val();
            var field_name = $("#drawers").find('[name="sms_field_name"]').val();
            var sms_content = $("#drawers").find('[name="sms_content"]').val();
            var new_content = sms_content + "$" + module_name + "_" + field_name;
            $("#drawers").find('[name="sms_content"]').val(new_content);
        } else {
            var module_name = $('[name="sms_sync_module_list"]').val();
            var field_name = $('[name="sms_field_name"]').val();
            var sms_content = $('[name="sms_content"]').val();
            var new_content = sms_content + "$" + module_name + "_" + field_name;
            $('[name="sms_content"]').val(new_content);
        }
    },
    insert_survey_link_sms: function () {
        var self = this;
        var origin = Backbone.history.location.origin
        var pathname = Backbone.history.location.pathname
        var site_url = origin + pathname + "/survey_submission.php?q=";
        if ($($("#drawers").find('[data-name="sms_content"]')[0]).length == 1) {
            var survey_selected_id = $("#drawers").find("#survey_list").val();
            var sms_content = $("#drawers").find('[name="sms_content"]').val();
            var survey_selected_value = $("#drawers").find('#survey_selected_value').val();
        } else {
            var survey_selected_id = $("#survey_list").val();
            var sms_content = $('[name="sms_content"]').val();
            var survey_selected_value = $('#survey_selected_value').val();
        }
        var url = App.api.buildURL("bc_survey_sms_template", "find_survey_sms_template_exist", "", {'survey_id': survey_selected_id});
        App.api.call('create', url, {}, {
            success: function (data) {
                if (data['selected_survey_id_template_exist'] == "sms_template_do_not_exists") {
                    if (survey_selected_id != "") {
                        if (sms_content.includes("$survey_link") == true && survey_selected_value != "" && survey_selected_id != survey_selected_value) {
                            app.alert.show('error', {
                                level: 'error',
                                messages: 'Remove survey Link of another survey.',
                                autoClose: true
                            });
                        } else {
                            var new_content = sms_content + site_url + "$survey_link ";
                            $('[name="sms_content"]').val(new_content);
                            $('#survey_selected_value').val(survey_selected_id);
                        }
                    } else {
                        app.alert.show('error', {
                            level: 'error',
                            messages: 'You must select survey for insert survey link.',
                            autoClose: true
                        });
                    }
                } else {
                    app.alert.show('error', {
                        level: 'error',
                        messages: 'SMS template has already created for this survey.',
                        autoClose: true
                    });
                }
            }
        });

    },
    save: function () {
        var self = this;
        var sms_content_enter = "";
        var survey_id_selected = "";
        var survey_list_id = $("#survey_list").val();
        var survey_sms_template_name = $("[name='name']").val();
        if ($($("#drawers").find('[data-name="sms_content"]')[0]).length == 1) {
            sms_content_enter = $("#drawers").find("[name='sms_content']").val();
            survey_id_selected = $("#drawers").find("#survey_selected_value").val();
        } else {
            sms_content_enter = $("[name='sms_content']").val();
            survey_id_selected = $("#survey_selected_value").val();
        }
        self.model.attributes.sms_content = sms_content_enter;
        self.model.attributes.sms_survey_linked = survey_id_selected;

        if ((survey_id_selected == survey_list_id) && (sms_content_enter.includes("$survey_link")) && survey_sms_template_name != "") {
            var content_without_link = sms_content_enter;
            if (content_without_link.length > 140) {
                App.alert.show('msg', {
                    level: 'error',
                    messages: 'Sms content should not have character more than ' + 140 + '.',
                    autoClose: true
                });
                $("[name='sms_content']").css("border", "1px solid red");
            } else {
                $('[data-name="sms_insert_field_button"]').hide();
                $('[data-name="sms_survey_list"]').parent().hide();
                this._super('save');

            }
        } else {
            if (survey_sms_template_name == "") {
                this._super('save');
            }
            if (((survey_id_selected != survey_list_id) || (survey_id_selected == "" && survey_list_id == "")) && (!sms_content_enter.includes("$survey_link"))) {
                App.alert.show('msg', {
                    level: 'error',
                    messages: ' Survey link not added to sms template. Please add.',
                    autoClose: true
                });
                $("[name='sms_content']").css("border", "1px solid red");
            } else {
                $("[name='sms_content']").css("border", "1px solid #ebedef")
            }
            if (!sms_content_enter.includes("$survey_link")) {
                App.alert.show('msg', {
                    level: 'error',
                    messages: ' Survey link not added to sms template. Please add.',
                    autoClose: true
                });
                $("[name='sms_content']").css("border", "1px solid red");
            } else {
                $("[name='sms_content']").css("border", "1px solid #ebedef")
            }
        }

    },
    cancel: function () {
        this._super('cancel');
    },
    restoreModel: function () {
        this._super('restoreModel');
    },
    duplicateClicked: function () {
        this._super('duplicateClicked');
    },
    validateSubpanelModelsWaterfall: function (callback) {
        this._super('validateSubpanelModelsWaterfall', [callback]);
    },
    validateModelWaterfall: function (callback) {
        this._super('validateModelWaterfall', [callback]);
    },
    createRecordWaterfall: function (callback) {
        this._super('createRecordWaterfall', [callback]);
    },

    /**
     * Disable buttons
     */
    disableButtons: function () {
        this._super('disableButtons');
    },
    /**
     * Enable buttons
     */
    enableButtons: function () {
        this._super('enableButtons');
    },
    _dispose: function () {
        //additional stuff before calling the core create _dispose goes here
        this._super('_dispose');
    }

})
