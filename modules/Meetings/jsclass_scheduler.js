

//////////////////////////////////////////////////
// class: DotbWidgetListView
// widget to display a list view
//
//////////////////////////////////////////////////

DotbClass.inherit("DotbWidgetListView","DotbClass");

function DotbWidgetListView() {
	this.init();
}

DotbWidgetListView.prototype.init = function() {

}

DotbWidgetListView.prototype.load = function(parentNode) {
	this.parentNode = parentNode;
	this.display();
}

DotbWidgetListView.prototype.display = function() {

	if(typeof GLOBAL_REGISTRY['result_list'] == 'undefined') {
		return;
	}

	var div = document.getElementById('list_div_win');
	div.style.display = 'block';
	var html = '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="list view">';
	html += '<tr>';
	html += '<th width="2%" nowrap="nowrap">&nbsp;</th>';
	html += '<th width="20%" nowrap="nowrap">'+GLOBAL_REGISTRY['meeting_strings']['LBL_NAME']+'</th>';
	html += '<th width="20%" nowrap="nowrap">'+GLOBAL_REGISTRY['meeting_strings']['LBL_EMAIL']+'</th>';
	html += '<th width="20%" nowrap="nowrap">'+GLOBAL_REGISTRY['meeting_strings']['LBL_PHONE']+'</th>';
    html += '<th width="20%" nowrap="nowrap">'+GLOBAL_REGISTRY['meeting_strings']['LBL_ACCOUNT_NAME']+'</th>';
	html += '<th width="18%" nowrap="nowrap">&nbsp;</th>';
	html += '</tr>';
	for(var i=0;i<GLOBAL_REGISTRY['result_list'].length;i++) {
		var bean = GLOBAL_REGISTRY['result_list'][i];
		var disabled = false;
		var className='evenListRowS1';

		if(typeof(GLOBAL_REGISTRY.focus.users_arr_hash[ bean.fields.id]) != 'undefined') {
			disabled = true;
		}
		if((i%2) == 0) {
			className='oddListRowS1';
		} else {
			className='evenListRowS1';
		}
		if(typeof (bean.fields.first_name) == 'undefined') {
			bean.fields.first_name = '';
		}
		if(typeof (bean.fields.email1) == 'undefined' || bean.fields.email1 == "") {
			bean.fields.email1 = '&nbsp;';
		}
		if(typeof (bean.fields.phone_work) == 'undefined' || bean.fields.phone_work == "") {
			bean.fields.phone_work = '&nbsp;';
		}
		if (!bean.fields.account_name || typeof (bean.fields.account_name) == 'undefined' || bean.fields.account_name == 'null') {
			bean.fields.account_name = '&nbsp;';
		}
		html += '<tr class="'+className+'">';
		html += '<td><img src="'+GLOBAL_REGISTRY.config['site_url']+'/index.php?entryPoint=getImage&themeName='+DOTB.themes.theme_name+'&imageName='+bean.module+'s.gif"/></td>';
		html += '<td>'+bean.fields.full_name+'</td>';
		html += '<td>'+bean.fields.email1+'</td>';
		html += '<td>'+bean.fields.phone_work+'</td>';
        html += '<td>'+bean.fields.account_name+'</td>';
		html += '<td align="right">';
		hidden = 'visible';
		html += '<input type="button" id="invitees_add_'+(i+1)+'" class="button" onclick="this.disabled=true;DotbWidgetSchedulerAttendees.form_add_attendee('+i+');" value="'+GLOBAL_REGISTRY['meeting_strings']['LBL_ADD_BUTTON']+'"/ style="visibility: '+hidden+'"/>';
		html += '</td>';

		html += '</tr>';
	}
	html += '</table>';

	div.innerHTML = html;
}

//////////////////////////////////////////////////
// class: DotbWidgetSchedulerSearch
// widget to display the meeting scheduler search box
//
//////////////////////////////////////////////////

DotbClass.inherit("DotbWidgetSchedulerSearch","DotbClass");

function DotbWidgetSchedulerSearch() {
	this.init();
}

DotbWidgetSchedulerSearch.prototype.init = function() {
	this.form_id = 'scheduler_search';
	GLOBAL_REGISTRY['widget_element_map'] = new Object();
	GLOBAL_REGISTRY['widget_element_map'][this.form_id] = this;
    GLOBAL_REGISTRY.scheduler_search_obj = this;
}

DotbWidgetSchedulerSearch.prototype.load = function(parentNode) {
	this.parentNode = parentNode;
	this.display();
}

DotbWidgetSchedulerSearch.submit = function(form) {

	DotbWidgetSchedulerSearch.hideCreateForm();

	//construct query obj:
	var conditions	= new Array();

	var queryModules = ["Users","Contacts"
        ,"Leads"
    ];
	if(form.search_first_name.value != '') {
		conditions[conditions.length] = {"name":"first_name","op":"starts_with","value":form.search_first_name.value}
	}
	if(form.search_last_name.value != '') {
		conditions[conditions.length] = {"name":"last_name","op":"starts_with","value":form.search_last_name.value}
	}
	if(form.search_email.value != '') {
		conditions[conditions.length] = {"name":"email1","op":"starts_with","value":form.search_email.value}
	}
	if (form.search_account_name.value != '') {
		conditions[conditions.length] = {"name" : "account_name","op" : "starts_with","value" : form.search_account_name.value}
        var queryModules = [ "Contacts", "Leads" ];
	}

	var query = {"modules":queryModules,"group":"and","field_list":['id','full_name','email1','phone_work','account_name'],"conditions":conditions};
	global_request_registry[req_count] = [this,'display'];
	req_id = global_rpcClient.call_method('query',query);
	global_request_registry[req_id] = [ GLOBAL_REGISTRY['widget_element_map'][form.id],'refresh_list'];
}

DotbWidgetSchedulerSearch.prototype.refresh_list = function(rslt) {

	GLOBAL_REGISTRY['result_list'] = rslt['list'];

	if (rslt['list'].length > 0) {
		this.list_view.display();
		document.getElementById('empty-search-message').style.display = 'none';
	}else{
		document.getElementById('list_div_win').style.display = 'none';
		document.getElementById('empty-search-message').style.display = '';
	}

}

DotbWidgetSchedulerSearch.prototype.display = function() {
	var html ='<div class="schedulerInvitees"><h3>'+GLOBAL_REGISTRY['meeting_strings']['LBL_ADD_INVITEE']+'</h5><table border="0" cellpadding="0" cellspacing="0" width="100%" class="edit view">';
	html +='<tr><td>';
	html += '<form name="schedulerwidget" id="'+this.form_id+'" onsubmit="DotbWidgetSchedulerSearch.submit(this);return false;">';

	html += '<table width="100%" cellpadding="0" cellspacing="0" width="100%" >'
	html += '<tr>';
	html += '<td scope="col" nowrap><label for="search_first_name">'+GLOBAL_REGISTRY['meeting_strings']['LBL_FIRST_NAME']+':</label>&nbsp;&nbsp;<input  name="search_first_name" id="search_first_name" value="" type="text" size="10"></td>';
	html += '<td scope="col" nowrap><label for="search_last_name">'+GLOBAL_REGISTRY['meeting_strings']['LBL_LAST_NAME']+':</label>&nbsp;&nbsp;<input  name="search_last_name" id="search_last_name" value="" type="text" size="10"></td>';
	html += '<td scope="col" nowrap><label for="search_email">'+GLOBAL_REGISTRY['meeting_strings']['LBL_EMAIL']+':</label>&nbsp;&nbsp;<input name="search_email" id="search_email" type="text" value="" size="15"></td>';
	html += '<td scope="col" nowrap><label for="search_account_name">'+GLOBAL_REGISTRY['meeting_strings']['LBL_ACCOUNT_NAME']+':</label>&nbsp;&nbsp;<input  name="search_account_name" id="search_account_name" type="text" value="" size="15"></td>';
	html += '<td valign="center"><input id="invitees_search" type="submit" class="button" value="'+GLOBAL_REGISTRY['meeting_strings']['LBL_SEARCH_BUTTON']+'" ></td></tr>';
	html += '</table>';
	html += '</form>';
	html += '</td></tr></table></div>';

	// append the list_view as the third row of the outside table
	this.parentNode.innerHTML += html;


	var div = document.createElement('div');
	div.setAttribute('id','list_div_win');
	div.style.overflow = 'auto';
	div.style.width = '100%';
	div.style.height= '100%';
	div.style.display = 'none';
    this.parentNode.appendChild(div);


	html = '';
	html += '<div id="create-invitees" style="margin-bottom: 10px;">';
	html += '<div id="empty-search-message" style="display: none;">' + GLOBAL_REGISTRY['meeting_strings']['LBL_EMPTY_SEARCH_RESULT'] + '</div>';
	html += '<h3 id="create-invitees-title">' + GLOBAL_REGISTRY['meeting_strings']['LBL_CREATE_INVITEE'] + '</h3>';
	html += '<div id="create-invitees-buttons">';
	html += '<button type="button" id="create_invitee_as_contact" onclick="DotbWidgetSchedulerSearch.showCreateForm(\'Contacts\');">' + GLOBAL_REGISTRY['meeting_strings']['LBL_CREATE_CONTACT'] + '</button> ';
	html += '<button type="button" id="create_invitee_as_lead" onclick="DotbWidgetSchedulerSearch.showCreateForm(\'Leads\');">' + GLOBAL_REGISTRY['meeting_strings']['LBL_CREATE_LEAD'] + '</button> ';
	html += '</div>';

	html += '<div id="create-invitee-edit" style="display: none;">';
	html += '<form name="createInviteeForm" id="createInviteeForm" onsubmit="DotbWidgetSchedulerSearch.createInvitee(this); return false;">';
	html += '<input type="hidden" name="inviteeModule" value="Contacts">';
	html += '<table class="edit view" cellpadding="0" cellspacing="0" style="width: 330px; margin-top: 2px;">'
	html += '<tr>';
	html += '<td valign="top" width="33%">' + GLOBAL_REGISTRY['meeting_strings']['LBL_FIRST_NAME'] + ': </td><td valign="top"><input name="first_name" type="text" size="19"></td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td valign="top" width="33%">' + GLOBAL_REGISTRY['meeting_strings']['LBL_LAST_NAME'] + ': <span class="required">*</span></td><td valign="top"><input name="last_name" type="text" size="19"></td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td valign="top" width="33%">' + GLOBAL_REGISTRY['meeting_strings']['LBL_EMAIL'] + ': </td><td valign="top"><input name="email1" type="text" size="19"></td>';
	html += '</tr>';
	html += '</table>';
	html += '<button type="button" id="create-invitee-btn" onclick="DotbWidgetSchedulerSearch.createInvitee(this.form);">' + GLOBAL_REGISTRY['meeting_strings']['LBL_CREATE_AND_ADD'] + '</button> ';
	html += '<button type="button" id="cancel-create-invitee-btn" onclick="DotbWidgetSchedulerSearch.hideCreateForm();">' + GLOBAL_REGISTRY['meeting_strings']['LBL_CANCEL_CREATE_INVITEE'] + '</button> ';
	html += '</form>';
	html += '</div>';
	html += '</div>';
	this.parentNode.innerHTML += html;

	addToValidate('createInviteeForm', 'last_name', 'last_name', true, GLOBAL_REGISTRY['meeting_strings']['LBL_LAST_NAME']);

    this.list_view = new DotbWidgetListView();
	this.list_view.load(div);
}

DotbWidgetSchedulerSearch.showCreateForm = function(module){
	document.getElementById('create-invitee-edit').style.display = '';
	document.getElementById('create-invitees-buttons').style.display = 'none';
	document.getElementById('list_div_win').style.display = 'none';
	document.forms['createInviteeForm'].elements['inviteeModule'].value = module;

	document.getElementById('empty-search-message').style.display = 'none';

	if (typeof document.createInviteeForm.first_name != 'undefined' && typeof document.schedulerwidget.search_first_name != 'undefined')
		document.createInviteeForm.first_name.value = document.schedulerwidget.search_first_name.value;
	if (typeof document.createInviteeForm.last_name != 'undefined' && typeof document.schedulerwidget.search_last_name != 'undefined')
		document.createInviteeForm.last_name.value = document.schedulerwidget.search_last_name.value;
	if (typeof document.createInviteeForm.email1 != 'undefined' && typeof document.schedulerwidget.search_email != 'undefined')
		document.createInviteeForm.email1.value = document.schedulerwidget.search_email.value;

}

DotbWidgetSchedulerSearch.hideCreateForm = function(module){
	document.getElementById('create-invitee-edit').style.display = 'none';
	document.getElementById('create-invitees-buttons').style.display = '';

	document.forms['createInviteeForm'].reset();
}

DotbWidgetSchedulerSearch.resetSearchForm = function() {
    if(GLOBAL_REGISTRY.scheduler_search_obj && document.forms[GLOBAL_REGISTRY.scheduler_search_obj.form_id]) {
        //if search form is initiated, it clears the input fields.
        document.forms[GLOBAL_REGISTRY.scheduler_search_obj.form_id].reset();
    }
}

DotbWidgetSchedulerSearch.createInvitee = function(form){
	if(!(check_form('createInviteeForm'))){
		return false;
	}

	document.getElementById('create-invitee-btn').setAttribute('disabled', 'disabled');
	document.getElementById('cancel-create-invitee-btn').setAttribute('disabled', 'disabled');

	ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_SAVING'));

	var callback = {
		success: function (response) {

            var rObj = JSON.parse(response.responseText);

			ajaxStatus.hideStatus();

			if (typeof rObj.noAccess != 'undefined') {
				var alertMsg = GLOBAL_REGISTRY['meeting_strings']['LBL_NO_ACCESS'];
				alertMsg = alertMsg.replace("\$module", rObj.module);
				DotbWidgetSchedulerSearch.hideCreateForm();
				alert(alertMsg);
				return false;
			}

			GLOBAL_REGISTRY.focus.users_arr[GLOBAL_REGISTRY.focus.users_arr.length] = rObj;
			GLOBAL_REGISTRY.scheduler_attendees_obj.display();

			DotbWidgetSchedulerSearch.hideCreateForm();
            //Bug#51357: Reset the search input fields after invitee is added.
            DotbWidgetSchedulerSearch.resetSearchForm();

			document.getElementById('create-invitee-btn').removeAttribute('disabled');
			document.getElementById('cancel-create-invitee-btn').removeAttribute('disabled');
		}
	};

	var fieldList = ['id', 'full_name', 'email1', 'phone_work'];

	var t = [];
	for (i in fieldList) {
		t.push("fieldList[]=" + encodeURIComponent(fieldList[i]));
	}
	var postData = t.join("&");

	var url = "index.php?module=Calendar&action=CreateInvitee&dotb_body_only=true";
	YAHOO.util.Connect.setForm(document.forms['createInviteeForm']);
	YAHOO.util.Connect.asyncRequest('POST', url, callback, postData);

}

//////////////////////////////////////////////////
// class: DotbWidgetScheduler
// widget to display the meeting scheduler
//
//////////////////////////////////////////////////

DotbClass.inherit("DotbWidgetScheduler","DotbClass");

function DotbWidgetScheduler() {
	this.init();
}

DotbWidgetScheduler.prototype.init = function() {
}

DotbWidgetScheduler.prototype.load = function(parentNode) {
	this.parentNode = parentNode;
	this.display();
}

DotbWidgetScheduler.fill_invitees = function(form) {
	for(var i=0;i<GLOBAL_REGISTRY.focus.users_arr.length;i++) {
		if(GLOBAL_REGISTRY.focus.users_arr[i].module == 'User') {
			form.user_invitees.value += GLOBAL_REGISTRY.focus.users_arr[i].fields.id + ",";
		} else if(GLOBAL_REGISTRY.focus.users_arr[i].module == 'Contact') {
			form.contact_invitees.value += GLOBAL_REGISTRY.focus.users_arr[i].fields.id + ",";
		} else if(GLOBAL_REGISTRY.focus.users_arr[i].module == 'Lead') {
			form.lead_invitees.value += GLOBAL_REGISTRY.focus.users_arr[i].fields.id + ",";
		}
	}
}

DotbWidgetScheduler.update_time = function() {

	var form_name;
	if(typeof document.EditView != 'undefined')
		form_name = "EditView";
	else if(typeof document.CalendarEditView != 'undefined')
		form_name = "CalendarEditView";
	else
		return;

   //check for field value, we can't do anything if it doesnt exist.
    if(typeof document.forms[form_name].date_start == 'undefined')
		return;

	var date_start = document.forms[form_name].date_start.value;
	if(date_start.length < 16) {
		return;
	}
	var hour_start = parseInt(date_start.substring(11,13), 10);
	var minute_start = parseInt(date_start.substring(14,16), 10);
	var has_meridiem = /am|pm/i.test(date_start);
	if(has_meridiem) {
	var meridiem = trim(date_start.substring(16));
	}

	GLOBAL_REGISTRY.focus.fields.date_start = date_start;

	if(has_meridiem) {
		GLOBAL_REGISTRY.focus.fields.time_start = hour_start + time_separator + minute_start + meridiem;
	} else {
		GLOBAL_REGISTRY.focus.fields.time_start = hour_start + time_separator + minute_start;
	}

	GLOBAL_REGISTRY.focus.fields.duration_hours = document.forms[form_name].duration_hours.value;
	GLOBAL_REGISTRY.focus.fields.duration_minutes = document.forms[form_name].duration_minutes.value;
	GLOBAL_REGISTRY.focus.fields.datetime_start = DotbDateTime.mysql2jsDateTime(GLOBAL_REGISTRY.focus.fields.date_start,GLOBAL_REGISTRY.focus.fields.time_start);

	GLOBAL_REGISTRY.scheduler_attendees_obj.init();
	GLOBAL_REGISTRY.scheduler_attendees_obj.display();
}

DotbWidgetScheduler.prototype.display = function() {
    this.parentNode.innerHTML = '';

	var attendees = new DotbWidgetSchedulerAttendees();
	attendees.load(this.parentNode);

	var search = new DotbWidgetSchedulerSearch();
	search.load(this.parentNode);
}


//////////////////////////////////////////////////
// class: DotbWidgetSchedulerAttendees
// widget to display the meeting attendees and availability
//
//////////////////////////////////////////////////

DotbClass.inherit("DotbWidgetSchedulerAttendees","DotbClass");

function DotbWidgetSchedulerAttendees() {
	this.init();
}

DotbWidgetSchedulerAttendees.prototype.init = function() {

	var form_name;
	if(typeof document.EditView != 'undefined')
		form_name = "EditView";
	else if(typeof document.CalendarEditView != 'undefined')
		form_name = "CalendarEditView";
	else
		return;

	GLOBAL_REGISTRY.scheduler_attendees_obj = this;
	var date_start = document.forms[form_name].date_start.value;
	var hour_start = parseInt(date_start.substring(11,13), 10);
	var minute_start = parseInt(date_start.substring(14,16), 10);
	var has_meridiem = /am|pm/i.test(date_start);
	if(has_meridiem) {
	var meridiem = trim(date_start.substring(16));
	}

	if(has_meridiem) {
		GLOBAL_REGISTRY.focus.fields.time_start = hour_start + time_separator + minute_start + meridiem;
	} else {
		GLOBAL_REGISTRY.focus.fields.time_start = hour_start+time_separator+minute_start;
	}

	GLOBAL_REGISTRY.focus.fields.date_start = document.forms[form_name].date_start.value;
	GLOBAL_REGISTRY.focus.fields.duration_hours = document.forms[form_name].duration_hours.value;
	GLOBAL_REGISTRY.focus.fields.duration_minutes = document.forms[form_name].duration_minutes.value;
	GLOBAL_REGISTRY.focus.fields.datetime_start = DotbDateTime.mysql2jsDateTime(GLOBAL_REGISTRY.focus.fields.date_start,GLOBAL_REGISTRY.focus.fields.time_start);

	this.timeslots = new Array();
	this.hours = 9;
	this.segments = 4;
	this.start_hours_before = 4;

	var minute_interval = 15;
	var dtstart = GLOBAL_REGISTRY.focus.fields.datetime_start;

	// initialize first date in timeslots
	var curdate = new Date(dtstart.getFullYear(),dtstart.getMonth(),dtstart.getDate(),dtstart.getHours()-this.start_hours_before,0);

	if(typeof(GLOBAL_REGISTRY.focus.fields.duration_minutes) == 'undefined') {
		GLOBAL_REGISTRY.focus.fields.duration_minutes = 0;
	}
	GLOBAL_REGISTRY.focus.fields.datetime_end = new Date(dtstart.getFullYear(),dtstart.getMonth(),dtstart.getDate(),dtstart.getHours()+parseInt(GLOBAL_REGISTRY.focus.fields.duration_hours),dtstart.getMinutes()+parseInt(GLOBAL_REGISTRY.focus.fields.duration_minutes),0);

	var has_start = false;
	var has_end = false;

	for(i=0;i < this.hours*this.segments; i++) {
		var hash = DotbDateTime.getUTCHash(curdate);
		var obj = {"hash":hash,"date_obj":curdate};
		if(has_start == false && GLOBAL_REGISTRY.focus.fields.datetime_start.getTime() <= curdate.getTime()) {
			obj.is_start = true;
			has_start = true;
		}
		if(has_end == false && GLOBAL_REGISTRY.focus.fields.datetime_end.getTime() <= curdate.getTime()) {
			obj.is_end = true;
			has_end = true;
		}
		this.timeslots.push(obj);

		curdate = new Date(curdate.getFullYear(),curdate.getMonth(),curdate.getDate(),curdate.getHours(),curdate.getMinutes()+minute_interval);
	}
    //Bug#51357: Reset the search input fields after attandee popup is initiated.
    DotbWidgetSchedulerSearch.resetSearchForm();
}

DotbWidgetSchedulerAttendees.prototype.load = function (parentNode) {
	this.parentNode = parentNode;
	this.display();
}

DotbWidgetSchedulerAttendees.prototype.display = function() {

	var form_name;
	if(typeof document.EditView != 'undefined')
		form_name = "EditView";
	else if(typeof document.CalendarEditView != 'undefined')
		form_name = "CalendarEditView";
	else
		return;

	var dtstart = GLOBAL_REGISTRY.focus.fields.datetime_start;
	var top_date = DotbDateTime.getFormattedDate(dtstart);
	var html = '<h3>'+GLOBAL_REGISTRY['meeting_strings']['LBL_SCHEDULING_FORM_TITLE']+'</h3><table id ="schedulerTable">';
	html += '<tr class="schedulerTopRow">';
	html += '<th colspan="'+((this.hours*this.segments)+2)+'"><h4>'+ top_date +'</h4></th>';
	html += '</tr>';
	html += '<tr class="schedulerTimeRow">';
	html += '<td>&nbsp;</td>';

	for(var i=0;i < (this.timeslots.length/this.segments); i++) {
		var hours = this.timeslots[i*this.segments].date_obj.getHours();
		var am_pm = '';

		if(time_reg_format.indexOf('A') >= 0 || time_reg_format.indexOf('a') >= 0) {
			am_pm = "AM";

			if(hours > 12) {
				am_pm = "PM";
				hours -= 12;
			}
			if(hours == 12) {
				am_pm = "PM";
			}
			if(hours == 0) {
				hours = 12;
				am_pm = "AM";
			}
			if(time_reg_format.indexOf('a') >= 0) {
				am_pm = am_pm.toLowerCase();
			}
			if(hours != 0 && hours != 12 && i != 0) {
				am_pm = "";
			}

		}

		var form_hours = hours+time_separator+"00";
		html += '<th scope="col" colspan="'+this.segments+'">'+form_hours+am_pm+'</th>';
	}

	html += '<td>&nbsp;</td>';
	html += '</tr>';
	html += '</table>';
    if ( this.parentNode.childNodes.length < 1 )
        this.parentNode.innerHTML += '<div class="schedulerDiv">' + html + '</div>';
    else
        this.parentNode.childNodes[0].innerHTML = html;

	var thetable = "schedulerTable";

	if(typeof (GLOBAL_REGISTRY) == 'undefined') {
		return;
	}

	//set the current user (as event-coordinator) so that they can be added to invitee list
	//only IF the first removed flag has not been set AND this is a new record
	if((typeof (GLOBAL_REGISTRY.focus.users_arr) == 'undefined' || GLOBAL_REGISTRY.focus.users_arr.length == 0)
      && document.forms[form_name].record.value =='' && typeof(GLOBAL_REGISTRY.FIRST_REMOVE)=='undefined') {
		GLOBAL_REGISTRY.focus.users_arr = [ GLOBAL_REGISTRY.current_user ];
	}

	if(typeof GLOBAL_REGISTRY.focus.users_arr_hash == 'undefined') {
		GLOBAL_REGISTRY.focus.users_arr_hash = new Object();
	}

	// append attendee rows
	for(var i=0;i < GLOBAL_REGISTRY.focus.users_arr.length;i++) {
		var row = new DotbWidgetScheduleRow(this.timeslots);
		row.focus_bean = GLOBAL_REGISTRY.focus.users_arr[i];
		GLOBAL_REGISTRY.focus.users_arr_hash[ GLOBAL_REGISTRY.focus.users_arr[i]['fields']['id']] =	GLOBAL_REGISTRY.focus.users_arr[i];
		row.load(thetable);
	}
}

DotbWidgetSchedulerAttendees.form_add_attendee = function (list_row) {
	if(typeof (GLOBAL_REGISTRY.result_list[list_row]) != 'undefined' && typeof(GLOBAL_REGISTRY.focus.users_arr_hash[ GLOBAL_REGISTRY.result_list[list_row].fields.id]) == 'undefined') {
		GLOBAL_REGISTRY.focus.users_arr[ GLOBAL_REGISTRY.focus.users_arr.length ] = GLOBAL_REGISTRY.result_list[list_row];
	}
	GLOBAL_REGISTRY.scheduler_attendees_obj.display();
}


//////////////////////////////////////////////////
// class: DotbWidgetScheduleRow
// widget to display each row in the scheduler
//
//////////////////////////////////////////////////
DotbClass.inherit("DotbWidgetScheduleRow","DotbClass");

function DotbWidgetScheduleRow(timeslots) {
	this.init(timeslots);
}

DotbWidgetScheduleRow.prototype.init = function(timeslots) {
	this.timeslots = timeslots;
}

DotbWidgetScheduleRow.prototype.load = function (thetableid) {
	this.thetableid = thetableid;
	var self = this;

	vcalClient = new DotbVCalClient();
	if (this.focus_bean.module === 'User' && (typeof (GLOBAL_REGISTRY['freebusy_adjusted']) == 'undefined' || typeof (GLOBAL_REGISTRY['freebusy_adjusted'][this.focus_bean.fields.id]) == 'undefined')) {
		global_request_registry[req_count] = [this,'display'];
		vcalClient.load(this.focus_bean.fields.id,req_count);
		req_count++;
	} else {
		this.display();
	}
}

DotbWidgetScheduleRow.prototype.display = function() {
	DOTB.util.doWhen("document.getElementById('" + this.thetableid + "') != null", function(){
        var tr;
        this.thetable = document.getElementById(this.thetableid);

        if(typeof (this.element) != 'undefined') {
            if (this.element.parentNode != null)
                this.thetable.deleteRow(this.element.rowIndex);

            tr = document.createElement('tr');
            this.thetable.appendChild(tr);
        } else {
            tr = this.thetable.insertRow(this.thetable.rows.length);
        }
        tr.className = "schedulerAttendeeRow";

        td = document.createElement('td');
        tr.appendChild(td);

        // icon + full name
        td.scope = 'row';
        var img = '<img align="absmiddle" src="index.php?entryPoint=getImage&themeName='
                + DOTB.themes.theme_name+'&imageName='+this.focus_bean.module+'s.gif"/>&nbsp;';
        td.innerHTML = img;

        td.innerHTML = td.innerHTML;

        if (this.focus_bean.fields.full_name)
            td.innerHTML += ' ' + this.focus_bean.fields.full_name;
        else
            td.innerHTML += ' ' + this.focus_bean.fields.name;

        // add freebusy tds here:
        this.add_freebusy_nodes(tr);

        // delete button
        var td = document.createElement('td');
        tr.appendChild(td);
        //var td = tr.insertCell(tr.cells.length);
        td.className = 'schedulerAttendeeDeleteCell';
        td.noWrap = true;
        //CCL - Remove check to disallow removal of assigned user or current user
       td.innerHTML = '<a title="'+ GLOBAL_REGISTRY['meeting_strings']['LBL_REMOVE']
                    + '" class="listViewTdToolsS1" style="text-decoration:none;" '
                    + 'href="javascript:DotbWidgetScheduleRow.deleteRow(\''+this.focus_bean.fields.id+'\');">&nbsp;'
                    + '<img src="index.php?entryPoint=getImage&themeName='+DOTB.themes.theme_name+'&imageName=delete_inline.gif" '
                    + 'align="absmiddle" alt="'+ GLOBAL_REGISTRY['meeting_strings']['LBL_REMOVE'] +'" border="0"> '
                    + GLOBAL_REGISTRY['meeting_strings']['LBL_REMOVE'] +'</a>';
        //}
        this.element = tr;
        this.element_index = this.thetable.rows.length - 1;
    }, null, this);
}

DotbWidgetScheduleRow.deleteRow = function(bean_id) {
	for(var i=0;i<GLOBAL_REGISTRY.focus.users_arr.length;i++) {
		if(GLOBAL_REGISTRY.focus.users_arr[i]['fields']['id']==bean_id) {
			delete GLOBAL_REGISTRY.focus.users_arr_hash[GLOBAL_REGISTRY.focus.users_arr[i]['fields']['id']];
			GLOBAL_REGISTRY.focus.users_arr.splice(i,1);
	     	//set first remove flag to true for processing in display() function
			GLOBAL_REGISTRY.FIRST_REMOVE = true;
			GLOBAL_REGISTRY.container.root_widget.display();
		}
	}
}


function DL_GetElementLeft(eElement) {
	/*
	 * ifargument is invalid
	 * (not specified, is null or is 0)
	 * and function is a method
	 * identify the element as the method owner
	 */
	if(!eElement && this) {
		eElement = this;
	}

	/*
	 * initialize var to store calculations
	 * identify first offset parent element
	 * move up through element hierarchy
	 * appending left offset of each parent
	 * until no more offset parents exist
	 */
	var nLeftPos = eElement.offsetLeft;
	var eParElement = eElement.offsetParent;
	while (eParElement != null) {
		nLeftPos += eParElement.offsetLeft;
		eParElement = eParElement.offsetParent;
	}
	return nLeftPos; // return the number calculated
}


function DL_GetElementTop(eElement) {
	if(!eElement && this) {
		eElement = this;
	}

	var nTopPos = eElement.offsetTop;
	var eParElement = eElement.offsetParent;
	while (eParElement != null) {
		nTopPos += eParElement.offsetTop;
		eParElement = eParElement.offsetParent;
	}
	return nTopPos;
}


//////////////////////////////////////////
// adds the <td>s for freebusy display within a row
DotbWidgetScheduleRow.prototype.add_freebusy_nodes = function(tr,attendee) {
	var hours = 9;
	var segments = 4;
	var html = '';
	var is_loaded = false;

	if(typeof GLOBAL_REGISTRY['freebusy_adjusted'] != 'undefined' && typeof GLOBAL_REGISTRY['freebusy_adjusted'][this.focus_bean.fields.id] != 'undefined') {
		is_loaded = true;
	}

	for(var i=0;i < this.timeslots.length; i++) {
		var td = document.createElement('td');
		tr.appendChild(td);
        td.innerHTML = '&nbsp;';
		if(typeof(this.timeslots[i]['is_start']) != 'undefined') {
			td.className = 'schedulerSlotCellStartTime';
		}
		if(typeof(this.timeslots[i]['is_end']) != 'undefined') {
			td.className = 'schedulerSlotCellEndTime';
		}

		if(is_loaded) {
			// iftheres a freebusy stack in this slice
			if(	typeof(GLOBAL_REGISTRY['freebusy_adjusted'][this.focus_bean.fields.id][this.timeslots[i].hash]) != 'undefined') {
				td.style.backgroundColor="#4D5EAA";

				if(	GLOBAL_REGISTRY['freebusy_adjusted'][this.focus_bean.fields.id][this.timeslots[i].hash] > 1) {
					td.style.backgroundColor="#AA4D4D";
				}
			}
		}
	}
}
