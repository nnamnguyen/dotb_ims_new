{*

*}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
	<select name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}" 
	id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}" 
	title='{{$vardef.help}}' {{if !empty($tabindex)}} tabindex="{{$tabindex}}" {{/if}}
    {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}}  {{$displayParams.field}}
	{{if isset($displayParams.javascript)}}{{$displayParams.javascript}}{{/if}}>

	{html_options options={{dotbvar key='options' string=true}} selected={{dotbvar key='value' string=true}}}
	</select>
{else}
	{assign var="field_options" value={{dotbvar key='options' string="true"}} }
	{capture name="field_val"}{{dotbvar key='value'}}{/capture}
	{assign var="field_val" value=$smarty.capture.field_val}
	{capture name="ac_key"}{{dotbvar key='name'}}{/capture}
	{assign var="ac_key" value=$smarty.capture.ac_key}

	{{if empty($vardef.autocomplete_ajax)}}
		<select style='display:none' name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}" 
		id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}" 
		title='{{$vardef.help}}' {{if !empty($tabindex)}} tabindex="{{$tabindex}}" {{/if}}
        {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}} {{$displayParams.field}}
		{{if isset($displayParams.javascript)}}{{$displayParams.javascript}}{{/if}}>

		{html_options options={{dotbvar key='options' string=true}} selected={{dotbvar key='value' string=true}}}
		</select>
	{{else}}
		<input type="hidden"
		    id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}"
		    name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}"
		    value="{{dotbvar key='value'}}">
	{{/if}}

	<input
		id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input"
		name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input"
		size="30"
		value="{$field_val|lookup:$field_options}"
		type="text" style="vertical-align: top;">

		
	<span class="id-ff multiple">
	    <button type="button"><img src="{dotb_getimagepath file="id-ff-down.png"}" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-image"></button><button type="button"
	        id="btn-clear-{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input"
	        title="Clear"
	        onclick="DOTB.clearRelateField(this.form, '{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input', '{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}');sync_{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}()"><img src="{dotb_getimagepath file="id-ff-clear.png"}"></button>
	</span>

	{literal}
	<script>
	DOTB.AutoComplete.{/literal}{$ac_key}{literal} = [];
	{/literal}

	{{if empty($vardef.autocomplete_ajax)}}
		{literal}
		(function (){
			var selectElem = document.getElementById("{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}{literal}");
			
			if (typeof select_defaults =="undefined")
				select_defaults = [];
			
			select_defaults[selectElem.id] = {key:selectElem.value,text:''};

			//get default
			for (i=0;i<selectElem.options.length;i++){
				if (selectElem.options[i].value==selectElem.value)
					select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
			}

			//DOTB.AutoComplete.{$ac_key}.ds = 
			//get options array from vardefs
			var options = DOTB.AutoComplete.getOptionsArray("{{$vardef.autocomplete_options}}");

			YUI().use('datasource', 'datasource-jsonschema',function (Y) {
				DOTB.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
				    source: function (request) {
				    	var ret = [];
				    	for (i=0;i<selectElem.options.length;i++)
				    		if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
				    			ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
				    	return ret;
				    }
				});
			});
		})();
		{/literal}
	{{else}}
		{literal}
		// Create a new YUI instance and populate it with the required modules.
		YUI().use('datasource', 'datasource-jsonschema',function (Y) {
			// DataSource is available and ready for use.
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Get({
				source: 'index.php?module=Accounts&action=ajaxautocomplete&to_pdf=1'
			});
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.ds.plug(Y.Plugin.DataSourceJSONSchema, {
				schema: {
					resultListLocator: "option_items",
					resultFields: ["text", "key"],
					matchKey: "text",
				}
			});
		});
		{/literal}
	{{/if}}

	{literal}
		YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
	{/literal}
			
	DOTB.AutoComplete.{$ac_key}.inputNode = Y.one('#{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input');
	DOTB.AutoComplete.{$ac_key}.inputImage = Y.one('#{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-image');
	DOTB.AutoComplete.{$ac_key}.inputHidden = Y.one('#{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}');
	
	{{if empty($vardef.autocomplete_ajax)}}
		{literal}
			function SyncToHidden(selectme){
				var selectElem = document.getElementById("{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}{literal}");
				var doSimulateChange = false;
				
				if (selectElem.value!=selectme)
					doSimulateChange=true;
				
				selectElem.value=selectme;

				for (i=0;i<selectElem.options.length;i++){
					selectElem.options[i].selected=false;
					if (selectElem.options[i].value==selectme)
						selectElem.options[i].selected=true;
				}

				if (doSimulateChange)
					DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
			}

			//global variable 
			sync_{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}{literal} = function(){
				SyncToHidden();
			}
			function syncFromHiddenToWidget(){

				var selectElem = document.getElementById("{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}{literal}");

				//if select no longer on page, kill timer
				if (selectElem==null || selectElem.options == null)
					return;

				var currentvalue = DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');

				DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');

				for (i=0;i<selectElem.options.length;i++){

					if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input{literal}'))
						DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
				}
			}

            YAHOO.util.Event.onAvailable("{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}{literal}", syncFromHiddenToWidget);
		{/literal}

		DOTB.AutoComplete.{$ac_key}.minQLen = 0;
		DOTB.AutoComplete.{$ac_key}.queryDelay = 0;
		DOTB.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
		if(DOTB.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
			{/literal}
			DOTB.AutoComplete.{$ac_key}.minQLen = 1;
			DOTB.AutoComplete.{$ac_key}.queryDelay = 200;
			{literal}
		}
		{/literal}
		if(DOTB.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
			{/literal}
			DOTB.AutoComplete.{$ac_key}.minQLen = 1;
			DOTB.AutoComplete.{$ac_key}.queryDelay = 500;
			{literal}
		}
		{/literal}
	{{else}}
		{literal}
		function SyncToHidden(e){
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', e);
		}
		{/literal}
		
		DOTB.AutoComplete.{$ac_key}.minQLen = 1;
		DOTB.AutoComplete.{$ac_key}.queryDelay = 500;
	{{/if}}
	
	DOTB.AutoComplete.{$ac_key}.optionsVisible = false;
	
	{literal}
	DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
		activateFirstItem: true,
		{/literal}
		minQueryLength: DOTB.AutoComplete.{$ac_key}.minQLen,
		queryDelay: DOTB.AutoComplete.{$ac_key}.queryDelay,
		zIndex: 99999,

		{{if !empty($vardef.autocomplete_ajax)}}
				requestTemplate: '&options={{$vardef.autocomplete_options}}&q={literal}{query}{/literal}',
		{{/if}}
		
		{literal}
		source: DOTB.AutoComplete.{/literal}{$ac_key}{literal}.ds,
		
		resultTextLocator: 'text',
		resultHighlighter: 'phraseMatch',
		resultFilters: 'phraseMatch',
	});

	DOTB.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
		var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
		if(hover[0] != null){
			if (ex) {
				var h = '1000px';
				hover[0].style.height = h;
			}
			else{
				hover[0].style.height = '';
			}
		}
	}
		
	if({/literal}DOTB.AutoComplete.{$ac_key}.minQLen{literal} == 0){
		// expand the dropdown options upon focus
		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
		});
	}

	{{if empty($vardef.autocomplete_ajax)}}
		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
		});
		
		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
		});

		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
		});

		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
		});

		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
		});

		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
			var selectElem = document.getElementById("{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}{literal}");
			//if typed value is a valid option, do nothing
			for (i=0;i<selectElem.options.length;i++)
				if (selectElem.options[i].innerHTML==DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
					return;
			
			//typed value is invalid, so set the text and the hidden to blank
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
			SyncToHidden(select_defaults[selectElem.id].key);
		});
	{{else}}		
		// when they focus away from the field...
		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
			if (DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value') != '') { // value entered
				if (DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.get('value') == '') { // none selected, we clear their text and hide
					DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', '');
				}
				else{ // they have something selected, we accept their selection and contract
				}
			}
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
		});
	{{/if}}

	// when they click on the arrow image, toggle the visibility of the options
	DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
		if (DOTB.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
		} else {
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
		}
	});

	DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
	});

	DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
	});

	// when they select an option, set the hidden input with the KEY, to be saved
	DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
		SyncToHidden(e.result.raw.key);
	});
 
});
</script> 

{/literal}

{/if}