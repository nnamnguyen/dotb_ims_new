<?php include "../../config.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang='en'>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Dotb Rest Example</title>
<!-- Dependency -->

<!--CSS file (default YUI Sam Skin) -->
<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.6.0/build/datatable/assets/skins/sam/datatable.css">

<!-- Dependencies -->

<script src="http://yui.yahooapis.com/2.6.0/build/yahoo/yahoo-min.js"></script>

<!-- Used for Custom Events and event listener bindings -->
<script src="http://yui.yahooapis.com/2.6.0/build/event/event-min.js"></script>

<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/element/element-beta-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/datasource/datasource-min.js"></script>

<!-- OPTIONAL: JSON Utility (for DataSource) -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/json/json-min.js"></script>

<!-- OPTIONAL: Connection Manager (enables XHR for DataSource) -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/connection/connection-min.js"></script>

<!-- OPTIONAL: Get Utility (enables dynamic script nodes for DataSource) -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/get/get-min.js"></script>

<!-- OPTIONAL: Drag Drop (enables resizeable or reorderable columns) -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/dragdrop/dragdrop-min.js"></script>

<!-- OPTIONAL: Calendar (enables calendar editors) -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/calendar/calendar-min.js"></script>

<!-- Source files -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/datatable/datatable-min.js"></script>

<script>

var DotbRest = function(){}
DotbRest.proxy_url  = 'Rest_Proxy.php';
DotbRest.server_url = '<?php echo rtrim($dotb_config['site_url'], '/'); ?>';
DotbRest.leadFields = [ 'id','do_not_call', 'first_name', 'last_name', 'status', 'phone_work', 'lead_source', 'salutation', 'primary_address_country', 'primary_address_city','primary_address_state', 'primary_address_postalcode', 'department', 'title', 'account_name'];
DotbRest.moduleFields = {};
DotbRest.logResponse = function(o){
	data = YAHOO.lang.JSON.parse(o.responseText);
	//console.log(data);
	return data;
}


DotbRest.call = function(fun, args, callback, params){
	//console.log(args);
	query = DotbRest.getQuery(fun, args);
	YAHOO.util.Connect.asyncRequest('POST', DotbRest.proxy_url  , {success:callback, failure:callback, argument:params}, query);
}

DotbRest.getQuery = function(fun, args){
	query = 'method=' + fun + '&input_type=json&response_type=json';
	if(args != null){
		m = YAHOO.lang.JSON.stringify(args);
		query += '&rest_data=' + m;
	}
	return query;
}

DotbRest.getServerInfo =  function(){
	//console.log('Getting Server Info');
	DotbRest.call('get_server_info', '', DotbRest.test);
}

DotbRest.login =  function(name, password, application){
	//console.log(name);
    var loginData = {"user_auth":{"encryption":"PLAIN","user_name":name,"password":password}};
    DotbRest.call('login', loginData, DotbRest.getUserId);
}

DotbRest.performLogin = function(o){

	//console.log('Logging In');
	var loginData = [{
		user_name: o.argument.name,
		password:YAHOO.lang.JSON.parse(o.responseText)
	},o.argument.application];
	DotbRest.call('login', loginData, DotbRest.getUserId);
}

DotbRest.getUserId =  function(o){
	data  = YAHOO.lang.JSON.parse(o.responseText);
	DotbRest.session = data.id;
	DotbRest.call('get_user_id', DotbRest.session, DotbRest.setUserId);
}

DotbRest.setUserId = function(o){
	DotbRest.user_id =YAHOO.lang.JSON.parse(o.responseText);
	DotbRest.getModuleFields('Leads', DotbRest.leadFields);
}
DotbRest.getModuleFields = function(module, fields){
	DotbRest.call('get_module_fields', [DotbRest.session, module, fields], DotbRest.setModuleFields);
}

DotbRest.setModuleFields = function(o){
	data  = DotbRest.logResponse(o);
	console.log(data.module_fields);
	DotbRest.moduleFields[data.module_name] = data.module_fields;
	DotbRest.InlineCellEditing();
}
DotbRest.getLeadsQuery = function(){
	var data = [DotbRest.session, 'Leads', " leads.do_not_call = 0 AND leads.status != 'Converted' AND leads.status != 'Dead' AND leads.assigned_user_id = '" + DotbRest.user_id + "' ", '', 0, DotbRest.leadFields, [{
		'name': 'email_addresses',
		'value': ['id', 'email_address', 'opt_out', 'primary_address',]
	}], 500, 0];
	q =  DotbRest.getQuery('get_entry_list', data, DotbRest.test);
	console.log(q);
	return q;
}

DotbRest.getFeeds = function(){
	var data = [DotbRest.session, 'DotbFeed', "", '', 0, ['id', 'name', 'description', 'link_url', 'link_type', 'created_by', 'date_entered', 'related_id', 'related_module'], [], 500, 0];
	DotbRest.call('get_entry_list', data, DotbRest.test);

}


DotbRest.getLeads = function(){
	q = DotbRest.getLeadsQuery();
	 var myCallback = function() {
            this.set("sortedBy", null);
            this.onDataReturnAppendRows.apply(this,arguments);
        };
     DotbRest.myDataSource.sendRequest(q,
                {
            success : myCallback,
            failure : myCallback,
            scope : DotbRest.myDataTable
     });
}

DotbRest.saveChange = function(callback, newValue){
	var r = this.getRecord();
	var column = this.getColumn();
	var id = r._oData['name_value_list.id'];
	name = column.key.replace('name_value_list.', '');
    name = name.replace('.value','');
    
	if(name == 'do_not_call'){
		newValue = (newValue == 'Do Not Call')? 1: 0;
	}
	//console.log("New Value:" + newValue);
	if(name == 'status' && newValue == 'Converted'){
		DotbRest.window = window.open('');
		callback();
		DotbRest.seamless_login_url = 'module=Leads&action=ConvertLead&record=' + id;
		DotbRest.call('seamless_login', DotbRest.session, DotbRest.seamless, 'module=Leads&action=ConvertLead&record=' + id );
		return;
	}
	fields = {};
	fields['id'] = id;
	fields[name] = newValue;

	data = [DotbRest.session, 'Leads',fields ];
	DotbRest.call('set_entry', data, DotbRest.savedChanges, {
		callback: callback,
		newValue: newValue
	});

}

DotbRest.savedChanges = function(o){
	//console.log(o);
	callback = o.argument.callback;
	 var r = YAHOO.lang.JSON.parse(o.responseText);
     if (r.id) {
         callback(true, o.argument.newValue);
     } else {
        //console.log('save failed');
        callback();
     }

}

DotbRest.editRecord = function(module, id){
	query = 'module=' + module +'&record=' + id + '&action=EditView';
	DotbRest.seamless_login_url = query;
	DotbRest.call('seamless_login', DotbRest.session, DotbRest.seamless, query);
    DotbRest.window = window.open();
}

DotbRest.seamless = function(o){
	if (o.responseText == 1) {
		surl = DotbRest.server_url +'/index.php?' + DotbRest.seamless_login_url + '&MSID=' +DotbRest.session;
		//console.log('opening:' + surl);
		DotbRest.window.location.href = surl;
	}

}


DotbRest.buildColumnDefs = function(){


}



 DotbRest.InlineCellEditing = function(){
 	var statusOptions = [];
	for(i in DotbRest.moduleFields.Leads.status.options){
		statusOptions[statusOptions.length] = {'label': DotbRest.moduleFields.Leads.status.options[i].name, 'value':DotbRest.moduleFields.Leads.status.options[i].value};
	}
	var salutationOptions = [];
	for(i in DotbRest.moduleFields.Leads.salutation.options){
		salutationOptions[salutationOptions.length] = {'label': DotbRest.moduleFields.Leads.salutation.options[i].name, 'value':DotbRest.moduleFields.Leads.salutation.options[i].value};
	}
 	 DotbRest.myColumnDefs = [
			{key:"name_value_list.id",formatter:DotbRest.editLink, label:'Edit'},
           // {key:"name_value_list.salutation.value",sortable:true, label:DotbRest.moduleFields.Leads.salutation.label, editor: new YAHOO.widget.DropdownCellEditor({asyncSubmitter:DotbRest.saveChange, dropdownOptions:salutationOptions})},
			{key:"name_value_list.first_name.value",sortable:true, label:DotbRest.moduleFields.Leads.first_name.label, editor: new YAHOO.widget.TextboxCellEditor({asyncSubmitter:DotbRest.saveChange})},
			{key:"name_value_list.last_name.value",sortable:true, label:DotbRest.moduleFields.Leads.last_name.label ,editor: new YAHOO.widget.TextboxCellEditor({asyncSubmitter:DotbRest.saveChange})},
            {key:"name_value_list.phone_work.value", formatter:DotbRest.callLink, label:DotbRest.moduleFields.Leads.phone_work.label},
			{key:"name_value_list.status.value",sortable:true, label:DotbRest.moduleFields.Leads.status.label, editor: new YAHOO.widget.DropdownCellEditor({asyncSubmitter:DotbRest.saveChange, dropdownOptions:statusOptions})},
			{key:"name_value_list.account_name.value",sortable:true, label:DotbRest.moduleFields.Leads.account_name.label, editor: new YAHOO.widget.TextboxCellEditor({asyncSubmitter:DotbRest.saveChange})},
			//{key:"name_value_list.department.value",sortable:true, label:DotbRest.moduleFields.Leads.department.label, editor: new YAHOO.widget.TextboxCellEditor({asyncSubmitter:DotbRest.saveChange})},
			{key:"name_value_list.title.value",sortable:true, label:DotbRest.moduleFields.Leads.title.label, editor: new YAHOO.widget.TextboxCellEditor({asyncSubmitter:DotbRest.saveChange})},
			{key:"name_value_list.primary_address_city.value",sortable:true, label:'City', editor: new YAHOO.widget.TextboxCellEditor({asyncSubmitter:DotbRest.saveChange})},
			{key:"name_value_list.primary_address_state.value",sortable:true, label:'State', editor: new YAHOO.widget.TextboxCellEditor({asyncSubmitter:DotbRest.saveChange})},
			//{key:"name_value_list.primary_address_country.value",sortable:true, label:'Country', editor: new YAHOO.widget.TextboxCellEditor({asyncSubmitter:DotbRest.saveChange})},
			{key:"name_value_list.primary_address_postalcode.value",sortable:true, label:'Postal', editor: new YAHOO.widget.TextboxCellEditor({asyncSubmitter:DotbRest.saveChange})},
			//{key:"name_value_list.lead_source.value", label:DotbRest.moduleFields.Leads.lead_source.label},
			{key:"name_value_list.do_not_call.value",formatter:DotbRest.checkboxField, label:DotbRest.moduleFields.Leads.do_not_call.label, editor: new YAHOO.widget.DropdownCellEditor({asyncSubmitter:DotbRest.saveChange, dropdownOptions:['Call', 'Do Not Call']})},
        ];

  DotbRest.myDataSource = new YAHOO.util.DataSource(DotbRest.proxy_url );
  DotbRest.myDataSource.connMethodPost = true;
  DotbRest.myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
  DotbRest.myDataSource.connXhrMode = "queueRequests";

  DotbRest.myDataSource.responseSchema = {
    resultsList : "entry_list", // String pointer to result data
  };
 DotbRest.myDataSource.responseSchema['fields'] = DotbRest.myColumnDefs;



  DotbRest.myDataTable = new YAHOO.widget.DataTable("cellediting",   DotbRest.myColumnDefs,

          DotbRest.myDataSource, {initialRequest:DotbRest.getLeadsQuery()});
 // Set up editing flow
	        var highlightEditableCell = function(oArgs) {
	            var elCell = oArgs.target;
	            if(YAHOO.util.Dom.hasClass(elCell, "yui-dt-editable")) {
	                this.highlightCell(elCell);
	            }
	        };
	        DotbRest.myDataTable.subscribe("cellMouseoverEvent", highlightEditableCell);
	        DotbRest.myDataTable.subscribe("cellMouseoutEvent", DotbRest.myDataTable.onEventUnhighlightCell);
	        DotbRest.myDataTable.subscribe("cellClickEvent", DotbRest.myDataTable.onEventShowCellEditor);

 }
        // Custom formatter for "address" column to preserve line breaks
  DotbRest.formatAddress = function(elCell, oRecord, oColumn, oData) {
            elCell.innerHTML = "<pre class=\"address\">" + oData + "</pre>";
  };

   DotbRest.editLink = function(elCell, oRecord, oColumn, oData) {
            elCell.innerHTML = "<input type='button' onclick='DotbRest.editRecord(\"Leads\", \"" + oData.value + "\");' value='Edit'>";
  };

   DotbRest.callLink = function(elCell, oRecord, oColumn, oData) {
            elCell.innerHTML = "<a href='callto:" + oData+ "'>"+ oData+ "</a>";
  };

   DotbRest.checkboxField = function(elCell, oRecord, oColumn, oData) {
   			checked = (oData == '1')? ' CHECKED ': '';
   			elCell.innerHTML = "<input type='checkbox' " + checked + ">";
  };








</script>
	</head>
	<body class="yui-skin-sam">
		<div id="dialog1">
		<div class="hd">Please Login <span id="error"></span></div>
		<div class="bd">
				<label for="username">User Name:</label><input id='username' type="text" name="username" value="admin"/>
				<label for="password">Password:</label><input id='password' type="password" name="password" value="asdf"/>
				<input type="button" value="Login" onclick='DotbRest.login(document.getElementById("username").value,document.getElementById("password").value , "Dotb Rest Demo")'>
		</div></div>


		<div id="cellediting"></div>
	</body>
</html>
