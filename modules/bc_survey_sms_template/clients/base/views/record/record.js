({
    extendsFrom: 'RecordView',
    inlineEditMode: false,
    initialize: function (options) {
        this._super('initialize', [options]);
        // checking licence configuration ///////////////////////

    },
    delegateButtonEvents: function () {
        this.context.on('button:edit_button:click', this.editClicked, this);
        this.context.on('button:save_button:click', this.saveClicked, this);
        this.context.on('button:cancel_button:click', this.cancelClicked, this);
        this.context.on('button:delete_button:click', this.deleteClicked, this);
        this.context.on('button:duplicate_button:click', this.duplicateClicked, this);
    },
    _render: function () {
        var self = this;
        var record_id = self.model.id;
        this._super('_render');
        var display = "";
        if (self.action == "edit") {
            display = "inline-block;";
        } else {
            display = "none;";
        }
        var url = App.api.buildURL("bc_survey_sms_template", "get_survey_list", "", {record: record_id});
        App.api.call('create', url, {}, {
            success: function (data) {
                // add Button to record view
                if ($('[data-name="sms_insert_field_button"]').length == 0) {
                    $('[data-name="sms_field_name"]').parents('.panel_body').append('<div class="span4 record-cell edit" data-type="enum" data-name="sms_insert_field_button"><div class="btn btn-primary insert_field_name_in_content" rel="tooltip" data-original-title="Insert field in Content" style="margin-top:15px;display:' + display + '">Add Field</div></div>');
                } else {
                    $('[data-name="sms_insert_field_button"]').find(".insert_field_name_in_content").show();
                    $('[data-name="sms_insert_field_button"]').show();
                }
                if ($('[data-name="sms_survey_list"]').length == 0) {
                    $('[data-name="sms_content"]').parents('.panel_body').parent().append('<div class="row-fluid panel_body" style="display:' + display + '"><div class="span4 record-cell" data-type="textarea" data-name="sms_survey_list"><div class="record-label" data-name="sms_survey_list">Survey List</div><span class="normal index" data-fieldname="sms_survey_list" data-index=""><span sfuuid="24" class="detail"><div>' + data['html'] + '</div></span></span></div><div class="span6 record-cell" data-type="textarea" data-name="sms_survey_list"><div class="btn btn-primary insert_survey_link_in_content" rel="tooltip" data-original-title="Insert survey in Content" style="margin-top:20px;">Add survey link</div></span></div></div>');
                } else {
                    $('[data-name="sms_survey_list"]').parent().css('display', 'inline-block');
                }
                if ($("#survey_selected_value").length == 0) {
                    $('[data-name="sms_content"]').append('<input type="hidden" id="survey_selected_value" value="' + data['selected_survey_id'] + '"/>');
                }
            }
        });
    },
    events: {
        'click .insert_field_name_in_content': 'insert_field_name_sms',
        'click .insert_survey_link_in_content': 'insert_survey_link_sms'
    },
    editClicked: function () {
        var self = this;
        var record_id = self.model.id;
        var display = "";
        if (self.action == "edit") {
            display = "none;";
        } else {
            display = "inline-block;";
        }
        var url = App.api.buildURL("bc_survey_sms_template", "get_survey_list", "", {record: record_id});
        App.api.call('create', url, {}, {
            success: function (data) {
                // add Button to record view
                if ($('[data-name="sms_insert_field_button"]').length == 0) {
                    $('[data-name="sms_field_name"]').parents('.panel_body').append('<div class="span4 record-cell edit" data-type="enum" data-name="sms_insert_field_button"><div class="btn btn-primary insert_field_name_in_content" rel="tooltip" data-original-title="Insert field in Content" style="margin-top:15px;display:' + display + '">Add Field</div></div>');
                } else {
                    $('[data-name="sms_insert_field_button"]').find(".insert_field_name_in_content").show();
                    $('[data-name="sms_insert_field_button"]').show();
                }
                if ($('[data-name="sms_survey_list"]').length == 0) {
                    $('[data-name="sms_content"]').parents('.panel_body').parent().append('<div class="row-fluid panel_body" style="display:' + display + '"><div class="span4 record-cell" data-type="textarea" data-name="sms_survey_list"><div class="record-label" data-name="sms_survey_list">Survey List</div><span class="normal index" data-fieldname="sms_survey_list" data-index=""><span sfuuid="24" class="detail"><div>' + data['html'] + '</div></span></span></div><div class="span6 record-cell" data-type="textarea" data-name="sms_survey_list"><div class="btn btn-primary insert_survey_link_in_content" rel="tooltip" data-original-title="Insert survey in Content" style="margin-top:20px;">Add survey link</div></span></div></div>');
                } else {
                    $('[data-name="sms_survey_list"]').parent().css('display', 'inline-block');
                }
                if ($("#survey_selected_value").length == 0) {
                    $('[data-name="sms_content"]').append('<input type="hidden" id="survey_selected_value" value="' + data['selected_survey_id'] + '"/>');
                }
            }
        });
        self._super('editClicked');
    },
    cancelClicked: function () {
        var self = this;
        var display = "";
        if (self.action == "edit") {
            display = "none;";
        } else {
            display = "inline-block;";
        }
        var url = App.api.buildURL("bc_survey_sms_template", "get_survey_list", "", {});
        App.api.call('create', url, {}, {
            success: function (data) {
                // add Button to record view
                $('[data-name="sms_insert_field_button"]').hide();
                $('[data-name="sms_survey_list"]').parent().hide();

            }
        });
        this._super('cancelClicked');
    },
    saveClicked: function () {
        var self = this;
        var sms_content_enter = $("[name='sms_content']").val();
        var survey_id_selected = $("#survey_selected_value").val();
        var survey_list_id = $("#survey_list").val();
        self.model.attributes.sms_content = sms_content_enter;
        self.model.attributes.sms_survey_linked = survey_id_selected;
        var survey_sms_template_name = $("[name='name']").val();
//        this.model.get('sms_content') = new_content;
        var url = App.api.buildURL("bc_survey_sms_template", "get_survey_list", "", {});
        App.api.call('create', url, {}, {
            success: function (data) {
                // add Button to record view

            }
        });
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
                this._super('saveClicked');

            }
        } else {
            if (survey_sms_template_name == "") {
                this._super('saveClicked');
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
    deleteClicked: function () {
        this._super('deleteClicked');
    },
    duplicateClicked: function () {
        this._super('duplicateClicked');
    },
    paginateRecord: function (evt) {
        this._super('paginateRecord', [evt]);
    },
    togglePanel: function (e) {
        this._super('togglePanel', [e]);
    },
    setActiveTab: function (event) {
        this._super('setActiveTab', [event]);
    },
    triggerNavTab: function (e) {
        this._super('triggerNavTab', [e]);
    },
    /**
     * Handler for intent to edit. This handler is called both as a callback
     * from click events, and also triggered as part of tab focus event.
     *
     * @param {Event} e Event object (should be click event).
     * @param {jQuery} cell A jQuery node cell of the target node to edit.
     */
    handleEdit: function (e, cell) {

        var target,
                cellData,
                field;
        if (e) { // If result of click event, extract target and cell.
            target = this.$(e.target);
            cell = target.parents('.record-cell');
        }

        cellData = cell.data();
        field = this.getField(cellData.name);
        // check for target_module and execution_occurs and ignore for inline edit default functionality

        // Set Editing mode to on.
//            this.inlineEditMode = true;
//            this.setButtonStates(this.STATE.EDIT);
//            this.toggleField(field);


        if (cell.closest('.headerpane').length > 0) {
            this.toggleViewButtons(true);
            this.adjustHeaderpaneFields();
        }

    },
    insert_field_name_sms: function () {
        var self = this;
        var module_name = $('[name="sms_sync_module_list"]').val();
        var field_name = $('[name="sms_field_name"]').val();
        var sms_content = $('[name="sms_content"]').val();
        var new_content = sms_content + "$" + module_name + "_" + field_name;
        $('[name="sms_content"]').text(new_content);
        $('[name="sms_content"]').val(new_content);
    },
    insert_survey_link_sms: function () {
        var self = this;
        var origin = Backbone.history.location.origin
        var pathname = Backbone.history.location.pathname
        var site_url = origin + pathname + "/survey_submission.php?q=";
        var survey_selected_id = $("#survey_list").val();
        var sms_content = $('[name="sms_content"]').val();
        var survey_selected_value = $('#survey_selected_value').val();
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
                    if (survey_selected_id == survey_selected_value) {
                        var new_content = sms_content + site_url + "$survey_link ";
                        $('[name="sms_content"]').val(new_content);
                    } else {
                        app.alert.show('error', {
                            level: 'error',
                            messages: 'SMS template has already created for this survey.',
                            autoClose: true
                        });
                    }
                }
            }
        });
    },
})


