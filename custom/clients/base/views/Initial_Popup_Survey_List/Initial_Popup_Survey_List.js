({
    /**
     * The file used to show popup of send survey & perfoem related actions of send survey 
     *
     * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
     * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
     * agreed to the terms and conditions of the License, and you may not use this file except in compliance
     * with the License.
     *
     * @author     Biztech Consultancy
     */

    extendsFrom: 'BaseeditmodalView',
    fallbackFieldTemplate: 'edit',
    isSendNow: false,
    events: {
        'click #create_new_survey': 'create_new_survey',
        'click #create_from_survey_template': 'create_from_survey_template',
        'focus .show_datepicker': 'show_datepicker',
        'focus .show_timepicker': 'show_timepicker',
        'click .fa-clock-o': 'show_timepickerfromicon',
    },
    initialize: function (options) {
        this.selected_record_ids = options.selected_record_ids;
        this.module = options.context.attributes.module;
        if (options.totalSelectedRecord)
        {
            this.totalSelectedRecord = options.totalSelectedRecord;
        } else {
            this.totalSelectedRecord = 1;
        }
        this.send_type = options.send_type;
        //Take survey changes 03-08-2019
        this.record_name = options.record_name;
        this.send_type_header = 'Send ' + this.send_type;
        if (this.send_type == 'take_survey') {
            this.send_type_header = 'Take Survey';
        }
        if (options.isSendNow) {
            this.isSendNow = true;
        }
        this.events = _.extend({}, this.events, {
            'click [name=open_survey_list]': 'getSurveyLists',
            'click [name=back_button]': 'go_back',
            'click [name=search_button]': 'getSurveyListsBySearch',
            'click [name=search_template_button]': 'getSurveyTemplateListsBySearch',
            'click [name=clear_search]': 'clearTextAndGetAllSurveyList',
            'click [name=clear_template_search]': 'clearTextAndGetAllSurveyTemplateList',
            'click [name=create_using_survey_button]': 'createusingTemplate',
            'click [name=preview_emailTemplate]': 'redirectToEmailTemplate',
            'click [name=preview_survey]': 'redirectToPreviewSurvey', //Take survey Changes for previewing before submission 03-08-2019
            'click [name=take_survey_button]': 'take_surveyButtonClicked', //Take survey changes of Take survey button 03-08-2019
            'click [name=send_later_button]': 'schedule_survey_form',
            'click [name=schedule_button]': 'schedule_survey',
            'click [name=schedule_cancel_button]': 'cancel_schedule_survey',
            'click [name=send_survey_button]': 'schedule_survey',
            'click [name=ViewPendingRes]': 'openPendingResView',
            'click [name=ViewOptedOutRes]': 'openOptedOutView',
            'click [name=ViewOptedOutResSMS]': 'openOptedOutViewSMS',
            'click [name=open_Initial_Popup_Survey_List_email]': 'open_Initial_Popup_Survey_List_email',
            'click [name=open_Initial_Popup_Survey_List_sms]': 'open_Initial_Popup_Survey_List_sms',
            'click [name=open_Initial_Popup_Survey_List_whatsapp]': 'open_Initial_Popup_Survey_List_whatsapp',
            'click [name=send_sms_select_number]': 'send_sms_select_number',
            'click [name=send_cancel_button]': 'cancel_send_survey',
        });
        app.view.View.prototype.initialize.call(this, options);
        if (this.layout) {
            this.layout.on('app:view:Initial_Popup_Survey_List', function () {
                this.render();
                this.$('.modal').modal({
                    backdrop: 'static'
                });
                //changes regarding the take survey in other module popup
                if ((this.send_type).toLowerCase() == 'take_survey') {
                    $('.Initial_Popup_Survey_List').find('.pop_upName').text('Take Survey');
                }
                this.$('.modal').modal('show');
                $('.datepicker').css('z-index', '20000');
                app.$contentEl.attr('aria-hidden', true);
                $('.modal-backdrop').insertAfter($('.modal'));
                if ((this.send_type).toLowerCase() == 'take_survey' || (this.send_type).toLowerCase() == 'poll') {
                    $('#survey_main_div').hide();
                }
                /**If any validation error occurs, system will throw error and we need to enable the buttons back*/
                this.context.get('model').on('error:validation', function () {
                    this.disableButtons(false);
                }, this);
            }, this);
        }
        this.bindDataChange();
        if ((this.send_type).toLowerCase() == 'poll')
        {
            $('#survey_main_div').hide();
            this.getSurveyLists();
            this.isSurvey = false;
        } else if ((this.send_type).toLowerCase() == 'take_survey')
        {
            //Take survey changes for survey list 03-08-2019
            $('#survey_main_div').hide();
            this.getSurveyLists();
            this.isSurvey = false;
        } else {
            this.isSurvey = true;
            $('#survey_main_div').show(); //Take survey changes 03-08-2019
        }
    },
    _render: function () {

        this._super('_render');
        if ((this.send_type).toLowerCase() == 'poll')
        {
            this.getSurveyLists();
            this.isSurvey = false;
        } else if (this.send_type == 'take_survey')
        {
            //Take survey changes for survey list 03-08-2019
            this.getSurveyLists();
            this.isSurvey = true;
        } else {
            this.isSurvey = true;
            $('#survey_main_div').show(); //Take survey changes 03-08-2019
        }
    },
    /**
     * open pending response view to new tab
     * 
     * @el current element
     */
    openPendingResView: function (el) {
        var survey_id = el.currentTarget.attributes.getNamedItem('data-survey-id').value;
        var survey_module = el.currentTarget.attributes.getNamedItem('data-survey-module').value;
        var pending_res_records = el.currentTarget.attributes.getNamedItem('data-pending-response-record').value;
        var surveyPendingResArray = {"survey_module": survey_module, "pending_res_records": pending_res_records};
        localStorage['pending_res_type_' + survey_id] = JSON.stringify(surveyPendingResArray);
        var url = '#bc_survey/' + survey_id + '/layout/survey_sent_summary_view/pending_res';
        var newWin = window.open(url, "_blank");
        if (typeof newWin == "undefined") {
            app.alert.show('info', {
                level: 'info',
                messages: 'Please allow your browser to show pop-ups.',
                autoClose: true
            });
        }
    },
    /**
     * open opted out view to new tab
     * 
     * @el current element
     */
    openOptedOutView: function (el) {
        var survey_id = el.currentTarget.attributes.getNamedItem('data-survey-id').value;
        var survey_module = el.currentTarget.attributes.getNamedItem('data-survey-module').value;
        var opted_out_record = el.currentTarget.attributes.getNamedItem('data-opted-out-record').value;
        var surveyOptedOutArray = {"survey_module": survey_module, "opted_out_record": opted_out_record};
        localStorage['opted_out_type_' + survey_id] = JSON.stringify(surveyOptedOutArray);
        var url = '#bc_survey/' + survey_id + '/layout/survey_sent_summary_view/opted_out';
        var newWin = window.open(url, "_blank");
        if (typeof newWin == "undefined") {
            app.alert.show('info', {
                level: 'info',
                messages: 'Please allow your browser to show pop-ups.',
                autoClose: true
            });
        }
    },
    /**
     * open opted out view to new tab for SMS
     * 
     * @el current element
     */
    openOptedOutViewSMS: function (el) {
        var self = this;
        self.send_survey_by = 'sms';
        var survey_id = el.currentTarget.attributes.getNamedItem('data-survey-id').value;
        var survey_module = el.currentTarget.attributes.getNamedItem('data-survey-module').value;
        var opted_out_record = el.currentTarget.attributes.getNamedItem('data-opted-out-record').value;
        var surveyOptedOutArray = {"send_type": "sms", "survey_module": survey_module, "opted_out_record": opted_out_record};
        localStorage['opted_out_type_' + survey_id] = JSON.stringify(surveyOptedOutArray);
        var url = '#bc_survey/' + survey_id + '/layout/survey_sent_summary_view/opted_out';
        var newWin = window.open(url, "_blank");
        if (typeof newWin == "undefined") {
            app.alert.show('info', {
                level: 'info',
                messages: 'Please allow your browser to show pop-ups.',
                autoClose: true
            });
        }
    },
    /**
     * show date picker
     * 
     * @el current element
     */
    show_datepicker: function (el) {
        var self = this;
        var element = el;
        var options = {
            dateFormat: app.user.getPreference('datepref'),
        };
        $('.show_datepicker').datepicker(options);
        $('.modal-body').scroll(function () {
            // make sure the dom element exists before trying to place the datepicker
            if (self._getAppendToTarget()) {
                // $('.datepicker').focus();
                $('.datepicker').datepicker('place');
            }
        });
    },
    /**
     * show time picker
     * 
     * @el current element
     */
    show_timepicker: function (el) {
        var self = this;
        var element = el;
        var options = {
            timeFormat: app.user.getPreference('timepref'),
        };
        $('.show_timepicker').timepicker(options);
        $('.modal-body').scroll(function () {
            // make sure the dom element exists before trying to place the datepicker
            if (self._getAppendToTarget()) {
                $('.ui-timepicker-wrapper').hide();
            }
        });
    },
    /**
     * Retrieve an element against which the date picker should be appended to.
     *
     * FIXME: find a proper way to do this and avoid scrolling issues SC-2739
     *
     * @return {jQuery/undefined} Element against which the date picker should
     *   be appended to, `undefined` if none.
     * @private
     */
    _getAppendToTarget: function () {
        var component = this;
        if (component) {
            return component.$el;
        }

        return;
    },
    /**
     * show time picker on click of picker icon
     * 
     * @el current element
     */
    show_timepickerfromicon: function (el) {
        $(el.currentTarget.parentElement.parentElement.children.show_timepicker).focus();
    },
    /**
     * Get All Survey Lists When Click On Select Survey List Button
     * 
     * @el current element
     */
    getSurveyLists: function () {
        var self = this;
        var search_string = '';
        var html = '';
        var surveyModule = $('input[name="send_module_name"]').val();
        if ((this.send_type).toLowerCase() == 'poll')
        {
            surveyModule = 'poll';
            self.send_survey_by = 'email';
        }
        var url = App.api.buildURL("bc_survey", "GetSurveys", "", {surveyModule: surveyModule, search_string: search_string, current_recipient_module: this.module});
        App.api.call('GET', url, {}, {
            success: function (data) {
                $('#survey_initialpopup_content').hide();
                $("#customerMailPopup").hide();
                //Take survey changes for survey List HTML 03-08-2019
                if ((self.send_type).toLowerCase() == 'take_survey') {
                    var html = self.surveyListTakSurveyHtml(data);
                } else {
                    var html = self.surveyListHtml(data);
                }

                $('#survey_list_content').html(html);
                $('#survey_list_content').show();
                if ((self.send_type).toLowerCase() == 'survey')
                {
                    $('.modal-footer').show();
                }
                $('.schedule_later_div').hide();
            }
        });
    },
    /**
     * Get All Survey Lists When Click On Select Survey List Button
     * 
     * @el current element
     */
    open_Initial_Popup_Survey_List_sms: function () {
        this.open_Initial_Popup_Survey_List('sms');
    },
    /**
     * Get All Survey Lists When Click On Select Survey List Button
     * 
     * @el current element
     */
    open_Initial_Popup_Survey_List_whatsapp: function () {
        this.open_Initial_Popup_Survey_List('whatsapp');
    },
    /**
     * Get All Survey Lists When Click On Select Survey List Button
     * 
     * @el current element
     */
    open_Initial_Popup_Survey_List_email: function () {
        this.open_Initial_Popup_Survey_List('email');
    },
    /**
     * Get All Survey Lists When Click On Select Survey List Button
     * 
     * @el current element
     */
    open_Initial_Popup_Survey_List: function (send_survey_through) {
        var self = this;
        self.send_survey_by = send_survey_through;
        var title = $(".pop_upName").text();
        if (send_survey_through == "sms") {
            $(".pop_upName").text(title + " Link via SMS");
        } else if (send_survey_through == "whatsapp") {
            $(".pop_upName").text(title + " Link via WhatsApp");
        } else {
            $(".pop_upName").text(title + " Link via Email");
        }
        var search_string = '';
        var html = '';
        var surveyModule = $('input[name="send_module_name"]').val();
        if ((this.send_type).toLowerCase() == 'poll')
        {
            surveyModule = 'poll';
        }
        $('#survey_main_div').hide();
        $("#customerMailPopup").hide();
        var html = '';
        html += '<div id="survey_content">';
        html += '  <div id="button_div">';
        html += '     <table class="zebra" style="width: 100%;" cellpadding="0" cellspacing="0">';
        html += '     <tbody style="height: 65px;">';
        html += '          <tr>';
        html += '              <td style="width: 97%; padding: 25px;" align="center">';
        html += '                <div style="width:26%; white-space: nowrap;" class="btn btn-primary" name="open_survey_list"><i class="fa fa-check"></i>&nbsp;Select Existing ' + this.send_type + '</div>&nbsp;';
        html += '                <div style="width:23%; white-space: nowrap;" class="btn btn-primary" id="create_new_survey"><i class="fa fa-plus"></i>&nbsp;Create New ' + this.send_type + '</div><br/><br/>';
        html += '                <div style="width:54%; white-space: nowrap;" class="btn btn-primary" id="create_from_survey_template" ><i class="fa fa-plus"></i>&nbsp;Create ' + this.send_type + ' From Existing Template</div>';
        html += '              </td>';
        html += '          </tr>';
        html += '     </tbody>';
        html += ' </table>';
        html += '</div>';
        $('#survey_initialpopup_content').html(html);
        $('#survey_initialpopup_content').show();
//        $('#survey_initialpopup_content').after('<div  id="survey_list_content" style="display:none;">');
        $('.modal-footer').show();
    },
    /**
     * create survey list html
     * 
     * @data survey data
     * @search_string search string to search for survey
     */
    surveyListHtml: function (data, search_string) {
        //check survey search condition
        var search_type = 'Survey';
        var self = this;
        if ((this.send_type).toLowerCase() == 'poll')
        {
            search_type = 'Poll';
        }
        var condition = '';
        if (data[1] != null && search_string != null && search_string != "undefined") {
            condition = search_string;
        }
        var html = '';
        if (data[1] != null && data[1]['id'] != null) {
            // generate survey list table
            html += "<table class='zebra table table-bordered table-striped' style='width: 99%;'>";
            html += "             <thead>";
            html += "                 <tr>";
            html += "                    <th style='width: 8%;height: 21px;'><div style='text-align:left; padding:10px 10px 8px 10px; font-size: 14px;'>No.</div></th>";
            html += "                    <th style='width: 86%; padding:10px 10px 10px 10px;height: 21px;' colspan='2'><div style='float:left; margin-top: 4px; font-size:14px;'>" + search_type + "</div><div style='float:right;'><input type='text' name='survey_search_text' value='" + condition + "' style='vertical-align: bottom;'> <input  class='btn btn-primary' type='button' name='search_button' value='Search'>&nbsp;<input class='btn' type='button' value='Clear' name='clear_search' ></div></th>";
            html += "                 </tr>";
            html += "             </thead>";
            html += "             <tbody>";
            $.each(data, function (index, list) {
                html += "<tr>";
                html += "        <td style = 'width: 8%;text-align:center;' > " + index + " </td>";
//                html += "        <td style = 'width: 55%;text-align: left;' > " + list['title'] + " </td>";
//For whatsapp
                if (self.send_survey_by == "sms" || self.send_survey_by == "whatsapp") {
                    html += "        <td style = 'width: 55%;text-align: left;' > " + self.htmlspecialchars(list['title']) + " </td>";
                    html += "        <td style = 'width: 20%; text-align: right;white-space: nowrap;' colspan = '3' >";
                    html += "        <div class = 'btn btn-primary' title = 'Select Number' name = 'send_sms_select_number' survey-id-data-value = '" + list['id'] + "' >";
                    if (self.send_survey_by == "whatsapp") {
                        html += "        <i> </i>&nbsp;Select WhatsApp Number</div> ";
                    } else {
                        html += "        <i> </i>&nbsp;Select SMS Number</div> ";
                    }
                    html += "        </td>";
                } else if (self.send_survey_by == "email") {
                    /** Changes for script tag in survey List in Html 13th JUNE 2019*/
                    html += "        <td style = 'width: 55%;text-align: left;' > " + self.htmlspecialchars(list['title']) + " </td>";
                    html += "        <td style = 'width: 20%; text-align: right;white-space: nowrap;' colspan = '3' >";
                    html += "        <div class = 'btn btn-primary' title = 'Send' name = 'send_survey_button' currnet-date-data-value = '" + list['current_date'] + "' survey-id-data-value = '" + list['id'] + "' >";
                    html += "        <i class = 'fa fa-envelope' > </i>&nbsp;Send</div> ";
                    html += "        <div class = 'btn' title = 'Send Later' name = 'send_later_button' send-later-data-value = '" + list['id'] + "' >";
                    html += "        <i class = 'fa fa-clock-o' > </i>&nbsp;Send Later</div > ";
                    html += "        <div class = 'btn' title = 'Preview Email-Template' name = 'preview_emailTemplate' preview-data-value = '" + list['id'] + "' >";
                    html += "        <i class = 'fa  fa-envelope' > </i></div>";
                    html += "        </td>";
                }
                html += "</tr>";
                if (self.send_survey_by == "email") {
                    html += "<tr class = 'schedule_later_div' id = '" + list['schedule_surveyTRID'] + "' >";
                    html += "        <td colspan = '5' align = 'left' style = 'width: 99%;' >";
                    html += "        <div id = '" + list['schedule_surveyDivID'] + "' style = 'display: none; background-color: rgb(232, 232, 232); border-radius:5px; box-shadow:2px 2px 2px #e8e8e8; padding:5px; margin-bottom:10px; border:1px solid #e8e8e8; width:96%'>";
                    html += '        <div class = "fieldset-field" data-type = "datetimecombo" data-name = "start_date" >';
                    html += '        <div class = "record-label" style = "text-align:left;" data-name = "start_date" > Select Date </div>';
                    html += '        <span sfuuid = "335" class = "edit" >';
                    html += '        <div class = "input-append date datetime" >';
                    html += '        <input style = "width:150px;margin-left:3px;" name = "show_datepicker" class = "show_datepicker datepicker" type = "text" data-type = "date" class = "ui-timepicker-input" placeholder = "(Required)Date" aria-label = "Start Date">';
                    html += '        <span name = "date_error" class = "error-tooltip add-on " style = "display:none;" data-container = "body" rel = "tooltip"  title = "Error. The date and time of this field is require and must be after current Date and Time." > <i class = "fa fa-exclamation-circle" > </i></span >';
                    html += '        <span class = "add-on date" data-icon = "calendar" > <i class = "fa fa-calendar" > </i></span >';
                    html += '        <input style = "width:120px;" type = "text" name = "show_timepicker"  class = "show_timepicker ui-timepicker-input timepicker" data-type = "time" autocomplete = "off" placeholder = "(Required)Time" class = "ui-timepicker-input" aria-label = "Start &amp; End Date" >';
                    html += '        <span name = "time_error" class = "error-tooltip add-on" style = "display:none;" data-container = "body" rel = "tooltip" title = "Error. The date and time of this field is require and must be after current Date and Time." > <i class = "fa fa-exclamation-circle" > </i></span >';
                    html += '        <span class = "add-on time" data-action = "show-timepicker" tabindex = "-1" > <i class = "fa fa-clock-o" > </i></span >';
                    html += "        <div class = 'btn' name = 'schedule_button' send-later-data-value = '" + list['id'] + "' > Schedule </div>&nbsp;&nbsp;";
                    html += "        <div style = 'margin-left:5px;' class = 'btn'  name = 'schedule_cancel_button' cancel-data-value = '" + list['id'] + "' > Cancel </div>";
                    html += "        </div>";
                    html += "        </span>";
                    html += "        </div></div>";
                    html += "        </td>";
                    html += "</tr>";
                } else if (self.send_survey_by == "sms" || self.send_survey_by == "whatsapp") {
                    html += "<tr class='select_number_row' id='select_number_row_" + list['id'] + "' >";
                    html += "<td colspan='5' align='left' style='width: 99%;display:none;' >";
                    html += "<div id='select_number_div_" + list['id'] + "' style = 'display: none; background-color: rgb(232, 232, 232); border-radius:5px; box-shadow:2px 2px 2px #e8e8e8; padding:5px; margin-bottom:10px; border:1px solid #e8e8e8; width:96%'>";
                    html += "<div class = 'btn btn-primary' title = 'Send' name = 'send_survey_button' currnet-date-data-value = '" + list['current_date'] + "' survey-id-data-value = '" + list['id'] + "' style='margin-left:0px;'>";
                    html += "<i class = 'fa fa-comments' > </i>&nbsp;Send Survey Link</div> ";
                    html += "<div style = 'margin-left:5px;' class = 'btn'  name = 'send_cancel_button' cancel-data-value = '" + list['id'] + "' > Cancel </div>";
                    html += "</div>";
                    html += "        </td>";
                    html += "</tr>";
                }

            });
            html += "       </tbody>";
            html += "</table>";
        } else {
            // generate survey list table
            html += "<table class='zebra table table-bordered table-striped' style='width: 99%;'>";
            html += "             <thead>";
            html += "                 <tr>";
            html += "                    <th style='width: 8%;height: 21px;'><div style='text-align:left; padding:10px 10px 8px 10px; font-size: 14px;'>No.</div></th>";
            html += "                    <th style='width: 86%; padding:10px 10px 10px 10px;height: 21px;' colspan='2'><div style='float:left; margin-top: 4px; font-size:14px;'>" + search_type + "</div><div style='float:right;'><input type='text' name='survey_search_text' value='" + condition + "' style='vertical-align: bottom;'> <input  class='btn btn-primary' type='button' name='search_button' value='Search'>&nbsp;<input class='btn' type='button' value='Clear' name='clear_search' ></div></th>";
            html += "                 </tr>";
            html += "             </thead>";
            html += "             <tbody>";
            html += "                <tr><td colspan='3'><p align='center' > No records found. </p></td></tr>";
            html += "             </tbody>";
            html += "</table>";
        }

        return html;
    },
    /**
     * create survey list html
     * 
     * @data survey data
     * @search_string search string to search for survey
     */
    surveyListTakSurveyHtml: function (data, search_string) {
        //check survey search condition
        var search_type = 'Survey';
        if (this.send_type == 'poll')
        {
            search_type = 'Poll';
        }
        var condition = '';
        if (data[1] != null && search_string != null && search_string != "undefined") {
            condition = search_string;
        }
        var html = '';
        if (data[1] != null && data[1]['id'] != null) {
            // generate survey list table
            html += "<table class='zebra table table-bordered table-striped' style='width: 98%;'>";
            html += "             <thead>";
            html += "                 <tr>";
            html += "                    <th style='width: 8%;height: 21px;'><div style='text-align:left; padding:10px 10px 8px 10px; font-size: 14px;'>No.</div></th>";
            html += "                    <th style='width: 86%; padding:10px 10px 10px 10px;height: 21px;' colspan='2'><div style='float:left; margin-top: 4px; font-size:14px;'>" + search_type + "</div><div style='float:right;'><input type='text' name='survey_search_text' value='" + condition + "' style='vertical-align: bottom;'> <input  class='btn btn-primary' type='button' name='search_button' value='Search'>&nbsp;<input class='btn' type='button' value='Clear' name='clear_search' ></div></th>";
            html += "                 </tr>";
            html += "             </thead>";
            html += "             <tbody>";
            $.each(data, function (index, list) {

                html += "<tr>";
                html += "        <td style = 'width: 8%;text-align:center;' > " + index + " </td>";
                html += "        <td style = 'width: 55%;text-align: left;' > " + list['title'] + " </td>";
                html += "        <td style = 'width: 20%; text-align: right;white-space: nowrap;' colspan = '3' >";
                html += "        <div class = 'btn btn-primary' title = 'Take Survey' name = 'take_survey_button' currnet-date-data-value = '" + list['current_date'] + "' survey-id-data-value = '" + list['id'] + "' >";
                html += "        <i class = 'fa fa-envelope' > </i>&nbsp;Take Survey</div> ";
                html += "        <div class = 'btn' title = 'Preview Survey' name = 'preview_survey' preview-data-value = '" + list['id'] + "' >";
                html += "        <i class = 'fa  fa-eye' > </i></div>";
                html += "        </td>";
                html += "</tr>";
            });
            html += "       </tbody>";
            html += "</table>";
        } else {
            // generate survey list table
            html += "<table class='zebra table table-bordered table-striped' style='width: 98%;'>";
            html += "             <thead>";
            html += "                 <tr>";
            html += "                    <th style='width: 8%;height: 21px;'><div style='text-align:left; padding:10px 10px 8px 10px; font-size: 14px;'>No.</div></th>";
            html += "                    <th style='width: 86%; padding:10px 10px 10px 10px;height: 21px;' colspan='2'><div style='float:left; margin-top: 4px; font-size:14px;'>" + search_type + "</div><div style='float:right;'><input type='text' name='survey_search_text' value='" + condition + "' style='vertical-align: bottom;'> <input  class='btn btn-primary' type='button' name='search_button' value='Search'>&nbsp;<input class='btn' type='button' value='Clear' name='clear_search' ></div></th>";
            html += "                 </tr>";
            html += "             </thead>";
            html += "             <tbody>";
            html += "                <tr><td colspan='3'><p align='center' > No records found. </p></td></tr>";
            html += "             </tbody>";
            html += "</table>";
        }

        return html;
    },
    /**
     * Get All Survey Lists By Search Value
     */
    getSurveyListsBySearch: function () {
        var self = this;
        var search_string = $('input[name="survey_search_text"]').val();
        var surveyModule = $('input[name="send_module_name"]').val();
        if ((this.send_type).toLowerCase() == 'poll')
        {
            surveyModule = 'poll';
        }
        var url = App.api.buildURL("bc_survey", "GetSurveys", "", {surveyModule: surveyModule, search_string: search_string, current_recipient_module: this.module});
        App.api.call('GET', url, {}, {
            success: function (data) {
                if (data == 0) {
                    data = new Array();
                    data[1] = Array('condition');
                    data[1]['condition'] = search_string;
                }
                $('#survey_main_div').hide();
                $("#customerMailPopup").hide();
                if (self.send_type == 'take_survey') {
                    var html = self.surveyListTakSurveyHtml(data);
                } else {
                    var html = self.surveyListHtml(data, search_string);
                }
                $('#survey_list_content').html(html);
                $('#survey_list_content').show();
                //Take survey changes 03-08-2019
                if ((self.send_type).toLowerCase() != 'poll' && self.send_type != 'take_survey')
                {
                    $('.modal-footer').show();
                }
                $('.schedule_later_div').hide();
            }
        });
    },
    /**
     * Get All Survey Template Lists By Search Value
     */
    getSurveyTemplateListsBySearch: function () {
        var self = this;
        var search_string = $('input[name="survey_search_text"]').val();
        var surveyModule = $('input[name="send_module_name"]').val();
        var url = App.api.buildURL("bc_survey", "GetSurveyTemplates", "", {surveyModule: surveyModule, search_string: search_string});
        App.api.call('GET', url, {}, {
            success: function (data) {
                if (data == 0) {
                    data = new Array();
                    data[1] = Array('condition');
                    data[1]['condition'] = search_string;
                }
                $('#survey_main_div').hide();
                $("#customerMailPopup").hide();
                var html = self.surveyTemplateListHtml(data, search_string);
                $('#survey_list_content').html(html);
                $('#survey_list_content').show();
                //Take survey changes 03-08-2019 Show only for survey
                if (self.send_type != 'poll' && self.send_type != 'take_survey')
                {
                    $('.modal-footer').show();
                }
            }
        });
    },
    /**
     * Get All Survey Lists By Search Clear Value
     */
    clearTextAndGetAllSurveyList: function () {
        var search_string = '';
        var self = this;
        var surveyModule = $('input[name="send_module_name"]').val();
        if ((this.send_type).toLowerCase() == 'poll')
        {
            surveyModule = 'poll';
        }
        var url = App.api.buildURL("bc_survey", "GetSurveys", "", {surveyModule: surveyModule, search_string: search_string, current_recipient_module: this.module});
        App.api.call('GET', url, {}, {
            success: function (data) {
                $('input[name="survey_search_text"]').val('');
                $('#survey_main_div').hide();
                $("#customerMailPopup").hide();
                //Take survey changes 03-08-2019
                if (self.send_type == 'take_survey') {
                    var html = self.surveyListTakSurveyHtml(data);
                } else {
                    var html = self.surveyListHtml(data);
                }
                $('#survey_list_content').html(html);
                $('#survey_list_content').show();
                if ((self.send_type).toLowerCase() == 'survey')
                {
                    $('.modal-footer').show();
                }
                $('.schedule_later_div').hide();
            }
        });
    },
    /**
     * Get All Survey Template Lists By Search Clear Value
     */
    clearTextAndGetAllSurveyTemplateList: function () {
        var search_string = '';
        var self = this;
        var surveyModule = $('input[name="send_module_name"]').val();
        var url = App.api.buildURL("bc_survey", "GetSurveyTemplates", "", {surveyModule: surveyModule, search_string: search_string});
        App.api.call('GET', url, {}, {
            success: function (data) {
                $('input[name="survey_search_text"]').val('');
                $('#survey_main_div').hide();
                $("#customerMailPopup").hide();
                var html = self.surveyTemplateListHtml(data, search_string);
                $('#survey_list_content').html(html);
                $('#survey_list_content').show();
                $('.modal-footer').show();
            }
        });
    },
    /**
     *Get Confirmation for Preview Email Template On Click Preview Button
     * 
     * @el current element
     */
    redirectToEmailTemplate: function (el) {
        var self = this;
        var survey_ID = el.currentTarget.attributes.getNamedItem('preview-data-value').value;
        var url = App.api.buildURL("bc_survey", "checkEmailTemplateForSurvey", "", {survey_ID: survey_ID});
        App.api.call('GET', url, {}, {
            success: function (data) {
                if (data && data.trim() != '') {
                    var newWin = window.open("#bwc/index.php?module=EmailTemplates&action=DetailView&record=" + data);
                    if (typeof newWin == "undefined") {
                        app.alert.show('info', {
                            level: 'info',
                            messages: 'Please allow your browser to show pop-ups.',
                            autoClose: true
                        });
                    }
                } else {
                    app.alert.show('stop_confirmation', {
                        level: 'confirmation',
                        title: '',
                        messages: 'Preview is not available because email template does not exist. Click Confirm to create email template.',
                        onConfirm: _.bind(self.confirmRedirect, self),
                        onCancel: function () {
                            app.alert.dismiss('stop_confirmation');
                            el.currentTarget.setAttribute('class', 'btn btn-primary');
                        },
                        autoClose: false
                    });
                }
            }
        });
    },
    redirectToPreviewSurvey: function (el) {
        //Take survey changes 03-08-2019 for Preview before taking survey
        var self = this;
        var survey_ID = el.currentTarget.attributes.getNamedItem('preview-data-value').value;
        var newWin = window.open("preview_survey.php?survey_id=" + survey_ID);
        if (typeof newWin == "undefined") {
            app.alert.show('info', {
                level: 'info',
                messages: 'Please allow your browser to show pop-ups.',
                autoClose: true
            });
        }
    },
    /**
     * Preview Email Template On Click Confirm Button
     */
    confirmRedirect: function (survey_ID, surveyModule) {
        var newWin = window.open('#bwc/index.php?module=EmailTemplates&action=EditView&return_module=EmailTemplates&return_action=DetailView&survey_id=' + survey_ID + '&survey_module=' + surveyModule);
        if (typeof newWin == "undefined") {
            app.alert.show('info', {
                level: 'info',
                messages: 'Please allow your browser to show pop-ups.',
                autoClose: true
            });
        }
    },
    /**
     * cancel clicked for not redirecting to email template
     **/
    cancelRedirect: function () {
        app.alert.dismiss('stop_confirmation');
        //  this.srcElement.setAttribute('class', 'btn btn-primary');
    },
    /**
     * schadeule later survey layout set
     * 
     * @el current element
     */
    schedule_survey_form: function (el) {
        $('[name=send_survey_button]').addClass('disabled');
        // hide other schedule div
        $.each($('.schedule_later_div'), function () {
            $(this).hide();
        });
        var survey_ID = el.currentTarget.attributes.getNamedItem('send-later-data-value').value;
        $('#sehedule_row_' + survey_ID).slideDown();
        $('#sehedule_div_' + survey_ID).slideDown();
        $('#sehedule_div_' + survey_ID).find('.show_datepicker').val('');
        $('#sehedule_div_' + survey_ID).find('.show_timepicker').val('');
        $('#sehedule_div_' + survey_ID).find('[name=date_error]').hide();
        $('#sehedule_div_' + survey_ID).find('[name=time_error]').hide();
        $.each($('#sehedule_div_' + survey_ID).find('.error'), function () {
            $(this).removeClass('error');
        });
        $('.show_datepicker').datepicker();
        $('.show_timepicker').timepicker();
    },
    /**
     * schadeule later survey layout set
     * 
     * @el current element
     */
    send_sms_select_number: function (el) {
        var self = this;
        $('[name=send_sms_select_number]').addClass('disabled');
        // hide other schedule div
        $.each($('.schedule_later_div'), function () {
            $(this).hide();
        });
        var survey_ID = $(el.currentTarget).attr('survey-id-data-value');
        var Html = "";
        /** Changes for SMS integration survey List in Html 21st November 2019*/
        var url = App.api.buildURL("bc_survey", "getFromAndToNumber", "", {sendBy: self.send_survey_by, module: self.module});
        App.api.call('GET', url, {}, {
            success: function (data) {
                if ($("#select_to_number_div_" + survey_ID).length == 0) {
                    if (data['survey_sms_fromPhoneNumber'] == null) {
                        Html += "<div style='display:inline-block;float:left;margin: 0 3px;' id='select_from_number_div_" + survey_ID + "'>";
                        Html += "<div>From Number:</div>";
                        Html += "<div id='from_number_div_" + survey_ID + "' style='display:inline-block;'>";
                        Html += "<select style='width:125px;' id='from_number_dropdown'>";
                        Html += data['fromPhnNoList'];
                        Html += "</select>";
                        Html += "</div>";
                        Html += "<span name='from_number_error' class='error-tooltip add-on' style='display:none;margin-left:5px;' data-container='body' rel='tooltip' title='' data-original-title='Error. From Number field is required.'> <i class='fa fa-exclamation-circle' style='color:red;'> </i></span>";
                        Html += "</div>";
                    }
                    Html += "<div style='display:inline-block;width: 34%;' id='select_to_number_div_" + survey_ID + "'>";
                    Html += "<div>To Number Field:</div>";
                    Html += "<div id='select_to_number_div_" + survey_ID + "' style='display:inline-block;width:150px;'>";
                    Html += "<select style='width:125px;' id='to_number_dropdown' multiple='true'>";
                    Html += data['toPhnFields'];
                    Html += "</select>";
                    Html += "</div>";
                    Html += "<span name='to_number_error' class='error-tooltip add-on' style='display:none;margin-left:5px;' data-container='body' rel='tooltip' title='' data-original-title='Error. To Number field is required.'> <i class='fa fa-exclamation-circle' style='color:red;'> </i></span>";
                    Html += "</div>";
                    $("#select_number_div_" + survey_ID).prepend(Html);
                }
                $("#select_number_div_" + survey_ID).find('#to_number_dropdown').select2({
                    width: '100%',
                    minimumResultsForSearch: 7,
                    closeOnSelect: false,
                    containerCssClass: 'select2-choices-pills-close'
                });
            },
        });
        $('#select_number_div_' + survey_ID).parent().slideDown();
        $('#select_number_row_' + survey_ID).slideDown();
        $('#select_number_div_' + survey_ID).slideDown();
        $.each($('#sehedule_div_' + survey_ID).find('.error'), function () {
            $(this).removeClass('error');
        });
    },
    /**
     * Cancel schedule survey so hide schedule tab
     * 
     * @el current element
     */
    cancel_schedule_survey: function (el) {
        $('[name=send_survey_button]').removeClass('disabled');
        $('[name=send_later_button]').removeClass('disabled');
        var survey_ID = el.currentTarget.attributes.getNamedItem('cancel-data-value').value;
        $('#show_error').html('&nbsp;');
        $('#sehedule_div_' + survey_ID).slideUp();
        $('#sehedule_row_' + survey_ID).slideUp();
    },
    /**
     * Cancel send survey so hide schedule tab
     * 
     * @el current element
     */
    cancel_send_survey: function (el) {
        self = this;
        $('[name=send_sms_select_number]').removeClass('disabled');
        var survey_ID = el.currentTarget.attributes.getNamedItem('cancel-data-value').value;
        $('#show_error').html('&nbsp;');
        if (self.send_survey_by == "sms" || self.send_survey_by == "whatsapp") {
            $("[name='from_number_error']").css('display', 'none');
            $("[name='to_number_error']").css('display', 'none');
            $(el.currentTarget).parent().find('.select2-choices').css('border', 'none');
        }
        $('#select_number_div_' + survey_ID).slideUp();
        $('#select_number_row_' + survey_ID).slideUp();
    },
    /**
     * Immidiate send mail from record view
     * 
     * @el current element
     */
    Immidiate_send_survey: function (el) {
        var self = this;
        var surveyType = '';
        if (typeof self.send_type !== 'undefined') {
            surveyType = self.send_type.charAt(0).toUpperCase() + self.send_type.slice(1);
        }
        var dateNow = app.date();
        var schedule_later_flag = 0;
        var current_date = dateNow.format(app.date.convertFormat(app.user.getPreference('datepref')));
        var current_time = dateNow.format(app.date.convertFormat(app.user.getPreference('timepref')));
        if (el.currentTarget.attributes.getNamedItem('send-later-data-value') == null) {
            var survey_ID = el.currentTarget.attributes.getNamedItem('survey-id-data-value').value;
        } else {
            schedule_later_flag = 1;
            var survey_ID = el.currentTarget.attributes.getNamedItem('send-later-data-value').value;
            var get_date_unformated = el.currentTarget.parentElement.children.show_datepicker.value;
            var get_date = app.date(get_date_unformated).format(app.date.convertFormat(app.user.getPreference('datepref')));
            var get_time = el.currentTarget.parentElement.children.show_timepicker.value;
        }

        var records = this.selected_record_ids;
        var surveyModule = this.module;
        var surveySingularModule = App.lang.getAppListStrings("moduleListSingular")[surveyModule];
        var sendPeopleCount = this.totalSelectedRecord;
        var schedule_on_date = undefined, schedule_on_time = undefined;
        if (typeof schedule_on_date == 'undefined' && typeof schedule_on_time == 'undefined' && get_date != '' && get_time != '') {

            if (this.isDateRangeValid(dateNow, get_date_unformated)) {
                schedule_on_date = get_date;
                schedule_on_time = get_time;
            } else {
                if (schedule_later_flag != 0) {
                    el.currentTarget.parentElement.attributes.getNamedItem('class').value = "input-append date datetime error";
                    el.currentTarget.parentElement.children.show_datepicker.attributes.getNamedItem('class').value = "show_datepicker datepicker ui-datepicker-input error";
                    el.currentTarget.parentElement.children.show_timepicker.attributes.getNamedItem('class').value = "show_timepicker  ui-timepicker-input error";
                    el.currentTarget.parentElement.children.date_error.attributes.getNamedItem('style').value = "";
                    el.currentTarget.parentElement.children.time_error.attributes.getNamedItem('style').value = "";
                }
            }
            if (schedule_later_flag != 1) {
                schedule_on_date = 'current_date';
                schedule_on_time = 'current_time';
            }
        } else if (get_date == '' || get_time == '') {
            if (schedule_later_flag != 0) {
                el.currentTarget.parentElement.attributes.getNamedItem('class').value = "input-append date datetime error";
                el.currentTarget.parentElement.children.show_datepicker.attributes.getNamedItem('class').value = "show_datepicker datepicker ui-datepicker-input error";
                el.currentTarget.parentElement.children.show_timepicker.attributes.getNamedItem('class').value = "show_timepicker  ui-timepicker-input error";
                el.currentTarget.parentElement.children.date_error.attributes.getNamedItem('style').value = "";
                el.currentTarget.parentElement.children.time_error.attributes.getNamedItem('style').value = "";
            }
        }
        if ((typeof schedule_on_date != 'undefined' && typeof schedule_on_time != 'undefined') || schedule_later_flag == 0) {
            var url = App.api.buildURL("bc_survey", "checkEmailTemplateForSurvey", "", {survey_ID: survey_ID});
            App.api.call('GET', url, {}, {
                success: function (data) {

                    el.currentTarget.setAttribute('class', 'btn active disabled');
                    if (data && data.trim() != '') {
                        if (schedule_on_date == null || schedule_on_time == null && (get_date == null && get_time == null)) {
                            schedule_on_date = 'current_date';
                            schedule_on_time = 'current_time';
                        } else if (get_date != null && get_time != null) {
                            schedule_on_date = get_date;
                            schedule_on_time = get_time;
                        }
                        var url = App.api.buildURL("bc_survey", "SendImmediateEmail?module_name=" + surveyModule +
                                "&id_survey=" + survey_ID +
                                "&records=" + records +
                                "&schedule_on_date=" + schedule_on_date +
                                "&schedule_on_time=" + schedule_on_time +
                                "&total_selected=" + sendPeopleCount +
                                "&surveySingularModule=" + surveySingularModule,
                                {});
                        App.api.call('GET', url, {}, {
                            success: function (result) {

                                var resultObj = JSON.parse(result);
                                var content = resultObj.contentPopUP;
                                $('#survey_main_div').hide();
                                $('#survey_list_content').hide();
                                $("#customerMailPopup").show();
                                $("#customerMailPopup").html(content);
                                $('.modal-footer').hide();
                            }
                        });
                    } else {
                        $('[name=send_survey_button]').removeClass('disabled');
                        $('[name=send_later_button]').removeClass('disabled');
                        el.currentTarget.setAttribute('class', 'btn active');
                        app.alert.show('stop_confirmation', {
                            level: 'confirmation',
                            messages: 'Email template does not exist.Click Confirm to create email template for this ' + surveyType + '.',
                            onConfirm: _.bind(self.confirmRedirect, self, survey_ID, surveyModule),
                            onCancel: _.bind(self.cancelRedirect, self),
                            autoClose: false
                        });
                    }
                }
            });
        }
    },
    /**
     * Scadule, Send survey
     * 
     * @el current element
     */
    schedule_survey: function (el) {
        var self = this;
        if (self.send_survey_by == "email") {
            if (!el.currentTarget.classList.contains('disabled'))
            {
                $('[name=send_survey_button]').addClass('disabled');
                $('[name=send_later_button]').addClass('disabled');
                //if sending from record view to one record and not scheduling survey then immidiate send
                if (this.isSendNow && el.currentTarget.attributes.getNamedItem('send-later-data-value') == null) {
                    this.Immidiate_send_survey(el);
                } else {
                    var self = this;
                    var surveyType = '';
                    if (typeof self.send_type !== 'undefined') {
                        surveyType = self.send_type.charAt(0).toUpperCase() + self.send_type.slice(1);
                    }
                    var dateNow = app.date();
                    var schedule_later_flag = 0;
                    var current_date = dateNow.format(app.date.convertFormat(app.user.getPreference('datepref')));
                    var current_time = dateNow.format(app.date.convertFormat(app.user.getPreference('timepref')));
                    if (el.currentTarget.attributes.getNamedItem('send-later-data-value') == null) {
                        var survey_ID = el.currentTarget.attributes.getNamedItem('survey-id-data-value').value;
                    } else {
                        schedule_later_flag = 1;
                        var survey_ID = el.currentTarget.attributes.getNamedItem('send-later-data-value').value;
                        var get_date_unformated = el.currentTarget.parentElement.children.show_datepicker.value;
                        var get_date = app.date(get_date_unformated).format(app.date.convertFormat(app.user.getPreference('datepref')));
                        var get_time = el.currentTarget.parentElement.children.show_timepicker.value;
                    }

                    var records = this.selected_record_ids;
                    var surveyModule = this.module;
                    var surveySingularModule = App.lang.getAppListStrings("moduleListSingular")[surveyModule];
                    var sendPeopleCount = this.totalSelectedRecord;
                    var schedule_on_date = undefined, schedule_on_time = undefined;
                    if (typeof schedule_on_date == 'undefined' && typeof schedule_on_time == 'undefined' && get_date != '' && get_time != '') {

                        if (this.isDateRangeValid(dateNow, app.date(get_date_unformated))) {
                            schedule_on_date = get_date;
                            schedule_on_time = get_time;
                            /** Changes for schedule date css 13 JUNE 2019*/
//                        el.currentTarget.parentElement.attributes.getNamedItem('class').value = "input-append date datetime";
//                        el.currentTarget.parentElement.children.show_datepicker.attributes.getNamedItem('class').value = "show_datepicker datepicker ui-datepicker-input";
//                        el.currentTarget.parentElement.children.show_timepicker.attributes.getNamedItem('class').value = "show_timepicker ui-timepicker-input";
                        } else {
                            if (schedule_later_flag != 0) {
                                el.currentTarget.parentElement.attributes.getNamedItem('class').value = "input-append date datetime error";
                                el.currentTarget.parentElement.children.show_datepicker.attributes.getNamedItem('class').value = "show_datepicker datepicker ui-datepicker-input error";
                                el.currentTarget.parentElement.children.show_timepicker.attributes.getNamedItem('class').value = "show_timepicker ui-timepicker-input error";
                                el.currentTarget.parentElement.children.date_error.attributes.getNamedItem('style').value = "";
                                el.currentTarget.parentElement.children.time_error.attributes.getNamedItem('style').value = "";
                            }
                        }
                        if (schedule_later_flag != 1) {
                            schedule_on_date = 'current_date';
                            schedule_on_time = 'current_time';
                        }
                    } else if (get_date == '' || get_time == '') {
                        if (schedule_later_flag != 0) {
                            el.currentTarget.parentElement.attributes.getNamedItem('class').value = "input-append date datetime error";
                            el.currentTarget.parentElement.children.show_datepicker.attributes.getNamedItem('class').value = "show_datepicker datepicker ui-datepicker-input error";
                            el.currentTarget.parentElement.children.show_timepicker.attributes.getNamedItem('class').value = "show_timepicker ui-timepicker-input error";
                            el.currentTarget.parentElement.children.date_error.attributes.getNamedItem('style').value = "";
                            el.currentTarget.parentElement.children.time_error.attributes.getNamedItem('style').value = "";
                        }
                    }
                    if ((typeof schedule_on_date != 'undefined' && typeof schedule_on_time != 'undefined') || schedule_later_flag == 0) {
                        var url = App.api.buildURL("bc_survey", "checkEmailTemplateForSurvey", "", {survey_ID: survey_ID});
                        App.api.call('GET', url, {}, {
                            success: function (data) {
                                el.currentTarget.setAttribute('class', 'btn active disabled');
                                if (data && data.trim() != '') {
                                    if (schedule_on_date == null || schedule_on_time == null && (get_date == null && get_time == null)) {
                                        schedule_on_date = 'current_date';
                                        schedule_on_time = 'current_time';
                                    } else if (get_date != null && get_time != null) {
                                        schedule_on_date = get_date;
                                        schedule_on_time = get_time;
                                    }
                                    App.alert.show('loading_send_survey', {level: 'process', title: 'Please wait while survey is getting scheduled.', autoclose: false});
                                    var url = App.api.buildURL("bc_survey/" + survey_ID + "/SendSurveyEmail");
                                    App.api.call('create', url, {module_name: surveyModule, id_survey: survey_ID, records: records, schedule_on_date: schedule_on_date, schedule_on_time: schedule_on_time, total_selected: sendPeopleCount, surveySingularModule: surveySingularModule}, {
                                        success: function (result) {
                                            var resultObj = JSON.parse(result);
                                            var content = resultObj.contentPopUP;
                                            $('#survey_main_div').hide();
                                            $('#survey_list_content').hide();
                                            $("#customerMailPopup").show();
                                            $("#customerMailPopup").html(content);
                                            $('.modal-footer').hide();
                                            app.alert.dismiss('loading_send_survey');
                                        }
                                    });
                                } else {
                                    $('[name=send_survey_button]').removeClass('disabled');
                                    $('[name=send_later_button]').removeClass('disabled');
                                    el.currentTarget.setAttribute('class', 'btn active');
                                    app.alert.show('stop_confirmation', {
                                        level: 'confirmation',
                                        messages: 'Email template does not exist.Click Confirm to create email template for this ' + surveyType + '.',
                                        onConfirm: _.bind(self.confirmRedirect, self, survey_ID, surveyModule),
                                        onCancel: _.bind(self.cancelRedirect, self),
                                        autoClose: false
                                    });
                                }
                            }
                        });
                    }
                }
            }
        } else if (self.send_survey_by == "sms" || self.send_survey_by == "whatsapp") {
            var surveyType = '';
            if (typeof self.send_type !== 'undefined') {
                surveyType = self.send_type.charAt(0).toUpperCase() + self.send_type.slice(1);
            }
            var surveyModule = this.module;
            var toNumberFieldData = new Object();
            var survey_id = $(el.currentTarget).attr('survey-id-data-value');
            var surveySingularModule = App.lang.getAppListStrings("moduleListSingular")[surveyModule];
            var selected_data_id = self.selected_record_ids;
            var fromNumber = $('#select_from_number_div_' + survey_id).find('#from_number_dropdown').val();
            var toNumberField = $('#select_to_number_div_' + survey_id).find('#to_number_dropdown').val();
            var i = 0
            $.each($($('#select_to_number_div_' + survey_id).find('#to_number_dropdown').find("option")), function (index, list) {
                if (list["selected"] == true) {
                    toNumberFieldData[list["value"]] = list["text"];
                    i++;
                }
            });
            var sendPeopleCount = this.totalSelectedRecord;
            if (this.isSendNow) {
                if ((fromNumber != null && $('#select_from_number_div_' + survey_id).length != 0) || ($('#select_from_number_div_' + survey_id).length == 0 && fromNumber == null)) {
                    if (toNumberField != "") {
                        if (selected_data_id != "") {
                            var url = App.api.buildURL("bc_survey", "checkSMSTemplateForSurvey", "", {survey_ID: survey_id});
                            App.api.call('GET', url, {}, {
                                success: function (data) {
                                    el.currentTarget.setAttribute('class', 'btn active disabled');
                                    if (data["smsTemplateID"] && (data["smsTemplateID"]).trim() != '') {
                                        var url = App.api.buildURL("bc_survey", "immediateSendSurveyFromSMS", "", {
                                            sendBy: self.send_survey_by,
                                            fromNumber: fromNumber,
                                            toNumberField: toNumberField,
                                            toNumberData: toNumberFieldData,
                                            survey_id: survey_id,
                                            selected_data_id: selected_data_id,
                                            module: self.module,
                                            total_selected: sendPeopleCount,
                                            template_id: data['smsTemplateID'],
                                            surveySingularModule: surveySingularModule
                                        }
                                        );
                                        App.api.call('GET', url, {}, {
                                            success: function (data) {
                                                var resultObj = JSON.parse(data);
                                                var content = resultObj.contentPopUP;
                                                $('#survey_main_div').hide();
                                                $('#survey_list_content').hide();
                                                $("#customerMailPopup").show();
                                                $("#customerMailPopup").html(content);
                                                $('.modal-footer').hide();
                                            },
                                        });
                                    } else {
                                        $('[name=send_survey_button]').removeClass('disabled');
                                        el.currentTarget.setAttribute('class', 'btn active');
                                        var sendBy;
                                        if (self.send_survey_by == "sms") {
                                            sendBy = "SMS";
                                        } else if (self.send_survey_by == "whatsapp") {
                                            sendBy = "WhatsApp";
                                        }
                                        app.alert.show('stop_confirmation', {
                                            level: 'confirmation',
                                            messages: sendBy + ' template does not exist.Click Confirm to create ' + sendBy + ' template for this ' + surveyType + '.',
                                            onConfirm: function () {
                                                var newWin = window.open('#bc_survey_sms_template/create/' + survey_id);
                                                if (typeof newWin == "undefined") {
                                                    app.alert.show('info', {
                                                        level: 'info',
                                                        messages: 'Please allow your browser to show pop-ups.',
                                                        autoClose: true
                                                    });
                                                }
                                            },
                                            onCancel: _.bind(self.cancelRedirect, self),
                                            autoClose: false
                                        });
                                    }
                                }
                            });
                        }
                    } else {
                        $("[name='to_number_error']").css('display', 'inline-block');
                        $("#select_to_number_div_" + survey_id).find(".select2-choices").css('border', '1px solid red');
                    }
                } else {
                    $("[name='from_number_error']").css('display', 'inline-block');
                    $("#select_from_number_div_" + survey_id).find("select").css('border', '1px solid red').css('border', '1px solid red');
                }
            } else {
                if ((fromNumber != null && $('#select_from_number_div_' + survey_id).length != 0) || ($('#select_from_number_div_' + survey_id).length == 0 && fromNumber == null)) {
                    if (toNumberField != "") {
                        if (selected_data_id != "") {
                            var url = App.api.buildURL("bc_survey", "checkSMSTemplateForSurvey", "", {survey_ID: survey_id});
                            App.api.call('GET', url, {}, {
                                success: function (data) {
                                    el.currentTarget.setAttribute('class', 'btn active disabled');
                                    if (data["smsTemplateID"] && (data["smsTemplateID"]).trim() != '') {
                                        var url = App.api.buildURL("bc_survey", "SendSurveyFromSMS", "", {
                                            sendBy: self.send_survey_by,
                                            fromNumber: fromNumber,
                                            toNumberField: toNumberField,
                                            toNumberData: toNumberFieldData,
                                            survey_id: survey_id,
                                            selected_data_id: selected_data_id,
                                            module: self.module,
                                            total_selected: sendPeopleCount,
                                            surveySingularModule: surveySingularModule
                                        }
                                        );
                                        App.api.call('GET', url, {}, {
                                            success: function (data) {
                                                var resultObj = JSON.parse(data);
                                                var content = resultObj.contentPopUP;
                                                $('#survey_main_div').hide();
                                                $('#survey_list_content').hide();
                                                $("#customerMailPopup").show();
                                                $("#customerMailPopup").html(content);
                                                $('.modal-footer').hide();
                                            },
                                        });
                                    } else {
                                        $('[name=send_survey_button]').removeClass('disabled');
                                        el.currentTarget.setAttribute('class', 'btn active');
                                        var sendBy;
                                        if (self.send_survey_by == "sms") {
                                            sendBy = "SMS";
                                        } else if (self.send_survey_by == "whatsapp") {
                                            sendBy = "WhatsApp";
                                        }
                                        app.alert.show('stop_confirmation', {
                                            level: 'confirmation',
                                            messages: sendBy + ' template does not exist.Click Confirm to create ' + sendBy + ' template for this ' + surveyType + '.',
                                            onConfirm: function () {
                                                var newWin = window.open('#bc_survey_sms_template/create/' + survey_id);
                                                if (typeof newWin == "undefined") {
                                                    app.alert.show('info', {
                                                        level: 'info',
                                                        messages: 'Please allow your browser to show pop-ups.',
                                                        autoClose: true
                                                    });
                                                }
                                            },
                                            onCancel: _.bind(self.cancelRedirect, self),
                                            autoClose: false
                                        });
                                    }
                                }
                            });
                        }
                    } else {
                        $("[name='to_number_error']").css('display', 'inline-block');
                        $("#select_to_number_div_" + survey_id).find(".select2-choices").css('border', '1px solid red');
                    }
                } else {
                    $("[name='from_number_error']").css('display', 'inline-block');
                    $("#select_from_number_div_" + survey_id).find("select").css('border', '1px solid red').css('border', '1px solid red');
                }
            }
        }
    },
    //Take survey changes 03-08-2019
    take_surveyButtonClicked: function (el) {
        // check whether survey is already attended by recipient or not
        var self = this;
        var records = this.selected_record_ids;
        var surveyModule = this.module;
        var sendPeopleCount = this.totalSelectedRecord;
        var survey_ID = el.currentTarget.attributes.getNamedItem('survey-id-data-value').value;
        var url = App.api.buildURL("bc_survey/" + survey_ID + "/SendSurveyEmail");
        App.api.call('create', url, {module_name: surveyModule, id_survey: survey_ID, records: records, total_selected: sendPeopleCount, isTakeSurvey: 1}, {
            success: function (result) {
                var resultObj = JSON.parse(result);
                var status = resultObj.survey_status;
                var content = resultObj.contentPopUP;
                if (status == 'Submitted')
                {
                    app.alert.show('stop_confirmation', {
                        level: 'confirmation',
                        messages: 'Survey already taken for ' + self.record_name + '. Do you want to re-edit and submit again ?',
                        onConfirm: _.bind(self.getSurveyURL, self, survey_ID, surveyModule, records),
                        onCancel: _.bind(self.cancelRedirect, self),
                        autoClose: false
                    });
                } else {
                    self._disposeView();
                    self.getSurveyURL(survey_ID, surveyModule, records);
                }
            }
        });
    },
    //Take survey changes 03-08-2019
    /**get survey url for attending survey y admin
     * 
     * @param {type} survey_id
     * @param {type} module_type
     * @param {type} module_id
     * @returns {undefined}
     */
    getSurveyURL: function (survey_id, module_type, module_id) {
        var self = this;
        var url = App.api.buildURL("bc_survey", "getSurveyURL", "", {survey_id: survey_id, module_type: module_type, module_id: module_id});
        App.api.call('GET', url, {}, {
            success: function (result) {

                if (result != null) {
                    self._disposeView();
                    var newWin = window.open(result.trim(), "_blank");
                }
            }
        });
    },
    /**
     * Is this date range valid? It returns true when start date is before end date.
     * 
     * @curr_date current date
     * @get_date user given date
     * @return {boolean}
     */
    isDateRangeValid: function (curr_date, get_date) {
        var isValid = false;
        // check if curr date & compare to schedule later date exist or not if exist then compare it
        if (typeof curr_date != "undefined" && typeof get_date != "undefined") {
            var curr_date_formated = curr_date._d.getDate() + '-' + curr_date._d.getMonth() + '-' + curr_date._d.getFullYear();
            var get_date_formated = get_date._d.getDate() + '-' + get_date._d.getMonth() + '-' + get_date._d.getFullYear();
            if (app.date.compare(curr_date, get_date) < 1 || curr_date_formated == get_date_formated) {
                isValid = true;
            }
        }

        return isValid;
    },
    /**
     * Go back to prev page
     */
    go_back: function () {
        if ($('#survey_list_content').css('display') != "none") {
            $('#survey_list_content').hide();
            $('#survey_initialpopup_content').show();
        } else if ($('#survey_initialpopup_content').css('display') != "none") {
            $('#survey_initialpopup_content').hide();
            $('#survey_main_div').show();
            $(".pop_upName").text("Send Survey");
            $('.modal-footer').hide();
        }
    },
    /**Overriding the base saveComplete method*/
    close_popup: function () {
        this._disposeView();
    },
    /**
     * create new survey
     */
    create_new_survey: function () {
        var self = this;
        var url = App.api.buildURL("bc_survey", "isSurveySend", {});
        App.api.call('GET', url, {}, {
            success: function (data) {
                if (data['dotb_latest'] == '1')
                {
                    var create_view = 'create';
                } else {
                    var create_view = 'create-actions';
                }
                self.$('.Initial_Popup_Survey_List').modal('hide'); // hide the current popup
                App.drawer.open({
                    layout: create_view,
                    context: {
                        create: true,
                        module: 'bc_survey',
                        isCreateFromSendSurveyNew: true,
                        selected_record_ids: self.selected_record_ids,
                        totalSelectedRecord: self.totalSelectedRecord,
                        module_to_send: self.module,
                    }
                });
            }
        });
        // javascript:parent.DOTB.App.router.navigate("bc_survey/create", {trigger: true});
    },
    /**
     * Create survey from survey template
     */
    create_from_survey_template: function () {
        var self = this;
        var search_string = '';
        var surveyModule = $('input[name="send_module_name"]').val();
        var url = App.api.buildURL("bc_survey", "GetSurveyTemplates", {surveyModule: surveyModule, search_string: search_string});
        App.api.call('GET', url, {}, {
            success: function (data) {
                $('#survey_main_div').hide();
                $("#customerMailPopup").hide();
                var html = self.surveyTemplateListHtml(data);
                $('#survey_list_content').html(html);
                $('#survey_list_content').show();
                $('.modal-footer').show();
            }
        });
    },
    /**
     * Survey Template list html
     */
    surveyTemplateListHtml: function (data, search_string) {
        //check survey search condition
        var html = '';
        var condition = '';
        var self = this;
        if (data[1] != null && search_string != null && search_string != "undefined") {
            var condition = search_string;
        }
        if (data[1] != null && data[1]['id'] != null) {

            html += "<div id='survey_template_list'>";
            html += "<table class=\"zebra table table-bordered table-striped\"  style='width: 99%;'>";
            html += "          <thead><tr><th style='width: 6%;height: 21px;'><div style='text-align:left; padding:10px 10px 8px 10px; font-size: 14px;'>No.</div></th><th style='width: 93%; padding:10px 10px 10px 10px;height: 21px;' colspan='2'><div style='float:left; margin-top: 4px; font-size:14px;'>Templates</div>";
            html += "          <div style='float:right;'><input type='text' name='survey_search_text' value='" + condition + "' style='vertical-align: bottom;'> <input  class='btn btn-primary' type='button' name='search_template_button' value='Search'>&nbsp;";
            html += "         <input type='button' class='btn' value='Clear' name='clear_template_search' ></div></th></tr></thead>";
            html += "          <tbody>";
            if (data[1] != "undefined") {
                $.each(data, function (index, list) {
                    html += "<tr><td style='width: 8%;text-align:center;'>" + index + "</td><td style='width: 70%;text-align: left;'>" + self.htmlspecialchars(list['title']) + "</td><td style='width: 5%; text-align: right;white-space: nowrap;' colspan='3'>"
                    html += "<div class='btn btn-primary' title='Create Survey' name='create_using_survey_button' survey-id-data-value = '" + list['id'] + "'>Create Survey</div>&nbsp;</td></tr>";
                });
            } else {
                html += "<tr>";
                html += "        <td colspan = '4' align = 'center' > No records found. </td><td></td>";
                html += "</tr>";
            }
            html += "       </tbody>";
            html += "</table>";
        } else {
            html += "<table class=\"zebra table table-bordered table-striped\"  style='width: 99%;'>";
            html += "          <thead><tr><th style='width: 6%;height: 21px;'><div style='text-align:left; padding:10px 10px 8px 10px; font-size: 14px;'>No.</div></th><th style='width: 93%; padding:10px 10px 10px 10px;height: 21px;' colspan='2'><div style='float:left; margin-top: 4px; font-size:14px;'>Templates</div>";
            html += "          <div style='float:right;'><input type='text' name='survey_search_text' value='" + condition + "' style='vertical-align: bottom;'> <input  class='btn btn-primary' type='button' name='search_template_button' value='Search'>&nbsp;";
            html += "         <input type='button' class='btn' value='Clear' name='clear_template_search' ></div></th></tr></thead>";
            html += "          <tbody>";
            html += "            <tr><td colspan='3'><p align='center' >No records found.</p></td></tr>";
            html += "       </tbody>";
            html += "</table>";
        }

        return html;
    },
    /* Create survey using Survey Template
     * * 
     * @el current element
     */
    createusingTemplate: function (el) {
        //Create duplicate record as a survey
        if (!$(el.currentTarget).hasClass('disabled'))
        {
            $(el.currentTarget).addClass('disabled');
            var templ_id = el.currentTarget.attributes.getNamedItem('survey-id-data-value').nodeValue;
            var SurveyTemplateBean = app.data.createBean('bc_survey_template', {id: templ_id});
            var self = this,
                    prefill = app.data.createBean('bc_survey');
            var request = SurveyTemplateBean.fetch();
            request.xhr.done(function () {
                SurveyTemplateBean.attributes.description = SurveyTemplateBean.get('description');
                SurveyTemplateBean.attributes.name = SurveyTemplateBean.get('name');
                prefill.copy(SurveyTemplateBean);
                prefill.unset('id');
                var url = App.api.buildURL("bc_survey", "isSurveySend", {});
                App.api.call('GET', url, {}, {
                    success: function (data) {
                        if (data['dotb_latest'] == '1')
                        {
                            var create_view = 'create';
                        } else {
                            var create_view = 'create-actions';
                        }
                        //Set id to storage for getting survey pages
                        localStorage['survey_record_id'] = SurveyTemplateBean.get('id');
                        app.drawer.open({
                            layout: create_view,
                            context: {
                                create: true,
                                model: prefill,
                                module: 'bc_survey',
                                isCreateFromSendSurvey: true,
                                copiedFromModelPopupId: SurveyTemplateBean.get('id')
                            }
                        }, function (context, newModel) {
                            if (newModel && newModel.id) {
                                app.router.navigate('bc_survey' + '/' + newModel.id, {trigger: true});
                            }
                        });
                        self.$('.Initial_Popup_Survey_List').modal('hide'); // hide the current popup
                        prefill.trigger('duplicate:field', 'bc_survey');
                    }
                });
            });
        }
    },
    /**Custom method to dispose the view*/
    _disposeView: function () {
        /**Find the index of the view in the components list of the layout*/
        var index = _.indexOf(this.layout._components, _.findWhere(this.layout._components, {name: 'Initial_Popup_Survey_List'}));
        if (index > -1) {
            /** dispose the view so that the evnets, context elements etc created by it will be released*/
            this.layout._components[index].dispose();
            /**remove the view from the components list**/
            this.layout._components.splice(index, 1);
        }
    },
    /** Changes for Script tag in popup 13th june 2019*/
    htmlspecialchars: function (str) {
        return str.replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#039;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    },
})
