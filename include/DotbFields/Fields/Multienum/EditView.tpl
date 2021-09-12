{*

*}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}

	<input type="hidden" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}_multiselect"
	name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}_multiselect" value="true">
	{multienum_to_array string={{dotbvar key='value' string=true}} default={{dotbvar key='default' string=true}} assign="values"}
	<select id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}"
	name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}[]"
	multiple="true" size='{{$displayParams.size|default:6}}' style="width:150" title='{{$vardef.help}}' tabindex="{{$tabindex}}" {{$displayParams.field}} 
    {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}}
 	{{if isset($displayParams.javascript)}}{{$displayParams.javascript}}{{/if}}>
	{html_options options={{dotbvar key='options' string=true}} selected=$values}
	</select>

{else}

	{assign var="field_options" value={{dotbvar key='options' string="true"}} }
	{capture name="field_val"}{{dotbvar key='value'}}{/capture}
	{assign var="field_val" value=$smarty.capture.field_val}
	{capture name="ac_key"}{{dotbvar key='name'}}{/capture}
	{assign var="ac_key" value=$smarty.capture.ac_key}

	{{if empty($vardef.autocomplete_ajax)}}
		<input type="hidden" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}_multiselect"
		name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}_multiselect" value="true">
		{multienum_to_array string={{dotbvar key='value' string=true}} default={{dotbvar key='default' string=true}} assign="values"}
		<select style='display:none' id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}"
		name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}[]"
		multiple="true" size='{{$displayParams.size|default:6}}' style="width:150" title='{{$vardef.help}}' tabindex="{{$tabindex}}" {{$displayParams.field}} 
		{{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}}
        {{if isset($displayParams.javascript)}}{{$displayParams.javascript}}{{/if}}>
		{html_options options={{dotbvar key='options' string=true}} selected=$values}
		</select>

		<input
	    id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input"
	    name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input"
	    size="60"
	    type="text" style="vertical-align: top;">
	{{else}}
		<input type="hidden"
		    id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}"
		    name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}"
		    value="{{dotbvar key='value'}}">

		<input
		    id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input"
		    name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input"
		    size="60"
		    type="text" style="vertical-align: top;">
	{{/if}}

	<span class="id-ff multiple">
	    <button type="button">
	    	<img src="{dotb_getimagepath file="id-ff-down.png"}" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-image">
	    	</button>
	    	<button type="button"
	        id="btn-clear-{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input"
	        title="Clear"
	        onclick="DOTB.clearRelateField(this.form, '{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input', '{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}};');DOTB.AutoComplete.{$ac_key}.inputNode.updateHidden()"><img src="{dotb_getimagepath file="id-ff-clear.png"}"></button>
	</span>

	{literal}
	<script>
	DOTB.AutoComplete.{/literal}{$ac_key}{literal} = [];
	{/literal}

	{{if empty($vardef.autocomplete_ajax)}}
		{literal}
		YUI().use('datasource', 'datasource-jsonschema', function (Y) {
					DOTB.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
					    source: function (request) {
					    	var selectElem = document.getElementById("{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}{literal}");
					    	var ret = [];
					    	for (i=0;i<selectElem.options.length;i++)
					    		if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
					    			ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
					    	return ret;
					    }
					});
				});
		{/literal}
	{{else}}
		{literal}
		// Create a new YUI instance and populate it with the required modules.
		YUI().use('datasource', 'datasource-jsonschema', function (Y) {
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
	YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters","node-event-simulate", function (Y) {
		{/literal}
		
	    DOTB.AutoComplete.{$ac_key}.inputNode = Y.one('#{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input');
	    DOTB.AutoComplete.{$ac_key}.inputImage = Y.one('#{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-image');
	    DOTB.AutoComplete.{$ac_key}.inputHidden = Y.one('#{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}');

		{{if empty($vardef.autocomplete_ajax)}}
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
			DOTB.AutoComplete.{$ac_key}.minQLen = 1;
			DOTB.AutoComplete.{$ac_key}.queryDelay = 500;
		{{/if}}
		
		{{if empty($vardef.autocomplete_ajax)}}
		{literal}
	    DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
	        activateFirstItem: true,
	        allowTrailingDelimiter: true,
			{/literal}
	        minQueryLength: DOTB.AutoComplete.{$ac_key}.minQLen,
	        queryDelay: DOTB.AutoComplete.{$ac_key}.queryDelay,
	        queryDelimiter: ',',
	        zIndex: 99999,

			{{if !empty($vardef.autocomplete_ajax)}}
				requestTemplate: '&options={{$vardef.autocomplete_options}}&q={literal}{query}{/literal}',
			{{/if}}
			{literal}
			source: DOTB.AutoComplete.{/literal}{$ac_key}{literal}.ds,
			
	        resultTextLocator: 'text',
	        resultHighlighter: 'phraseMatch',
	        resultFilters: 'phraseMatch',
	        // Chain together a startsWith filter followed by a custom result filter
	        // that only displays tags that haven't already been selected.
	        resultFilters: ['phraseMatch', function (query, results) {
		        // Split the current input value into an array based on comma delimiters.
	        	var selected = DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value').split(/\s*,\s*/);
	        
	            // Convert the array into a hash for faster lookups.
	            selected = Y.Array.hash(selected);

	            // Filter out any results that are already selected, then return the
	            // array of filtered results.
	            return Y.Array.filter(results, function (result) {
	               return !selected.hasOwnProperty(result.text);
	            });
	        }]
	    });
		{/literal}{{else}}{literal}
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
	        activateFirstItem: true,
	        allowTrailingDelimiter: true,
			{/literal}
	        minQueryLength: DOTB.AutoComplete.{$ac_key}.minQLen,
	        queryDelay: DOTB.AutoComplete.{$ac_key}.queryDelay,
	        queryDelimiter: ',',
	        zIndex: 99999,
				requestTemplate: '&options={{$vardef.autocomplete_options}}&q={literal}{query}{/literal}',
			{literal}
			source: DOTB.AutoComplete.{/literal}{$ac_key}{literal}.ds,
			
	        resultTextLocator: 'text',
	        resultHighlighter: 'phraseMatch',
	        resultFilters: 'phraseMatch',
	        // Chain together a startsWith filter followed by a custom result filter
	        // that only displays tags that haven't already been selected.
	        resultFilters: ['phraseMatch', function (query, results) {
	            // Split the current input value into an array based on comma delimiters.
	            var selected = DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.get('value').split(/\s*,\s*/);

	            // Pop the last item off the array, since it represents the current query
	            // and we don't want to filter it out.
	            //selected.pop();

	            // Convert the array into a hash for faster lookups.
	            selected = Y.Array.hash(selected);

	            // Filter out any results that are already selected, then return the
	            // array of filtered results.
	            return Y.Array.filter(results, function (result) {
	               return !selected.hasOwnProperty(result.text);
	            });
	        }]
	    });
		{/literal}{{/if}}{literal}
		if({/literal}DOTB.AutoComplete.{$ac_key}.minQLen{literal} == 0){
		    // expand the dropdown options upon focus
		    DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
		        DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
		    });
		}

		{{if empty($vardef.autocomplete_ajax)}}
		    DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateHidden = function() {
				var index_array = DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value').split(/\s*,\s*/);

				var selectElem = document.getElementById("{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}{literal}");

				var oTable = {};
		    	for (i=0;i<selectElem.options.length;i++){
		    		if (selectElem.options[i].selected)
		    			oTable[selectElem.options[i].value] = true;
		    	}

				for (i=0;i<selectElem.options.length;i++){
					selectElem.options[i].selected=false;
				}

				var nTable = {};

				for (i=0;i<index_array.length;i++){
					var key = index_array[i];
					for (c=0;c<selectElem.options.length;c++)
						if (selectElem.options[c].innerHTML == key){
							selectElem.options[c].selected=true;
							nTable[selectElem.options[c].value]=1;
						}
				}

				//the following two loops check to see if the selected options are different from before.
				//oTable holds the original select. nTable holds the new one
				var fireEvent=false;
				for (n in nTable){
					if (n=='')
						continue;
		    		if (!oTable.hasOwnProperty(n))
		    			fireEvent = true; //the options are different, fire the event
		    	}
		    	
		    	for (o in oTable){
		    		if (o=='')
		    			continue;
		    		if (!nTable.hasOwnProperty(o))
		    			fireEvent=true; //the options are different, fire the event
		    	}

		    	//if the selected options are different from before, fire the 'change' event
		    	if (fireEvent){
		    		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
		    	}
		    };

		    DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText = function() {
		    	//get last option typed into the input widget
		    	DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.set(DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'));
				var index_array = DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value').split(/\s*,\s*/);
				//create a string ret_string as a comma-delimited list of text from selectElem options.
				var selectElem = document.getElementById("{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}{literal}");
				var ret_array = [];

                if (selectElem==null || selectElem.options == null)
					return;

				for (i=0;i<selectElem.options.length;i++){
					if (selectElem.options[i].selected && selectElem.options[i].innerHTML!=''){
						ret_array.push(selectElem.options[i].innerHTML);
					}
				}

				//index array - array from input
				//ret array - array from select

				var sorted_array = [];
				var notsorted_array = [];
				for (i=0;i<index_array.length;i++){
					for (c=0;c<ret_array.length;c++){
						if (ret_array[c]==index_array[i]){
							sorted_array.push(ret_array[c]);
							ret_array.splice(c,1);
						}
					}
				}
				ret_string = ret_array.concat(sorted_array).join(', ');
				if (ret_string.match(/^\s*$/))
					ret_string='';
				else
					ret_string+=', ';
				
				//update the input widget
				DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.set('value', ret_string);
		    };

		    function updateTextOnInterval(){
		    	if (document.activeElement != document.getElementById("{/literal}{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}-input{literal}"))
		    		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText();
		    	setTimeout(updateTextOnInterval,100);
		    }

		    updateTextOnInterval();
		{{else}}
		    DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateHidden = function() {
				var index_array = DOTB.MultiEnumAutoComplete.getMultiSelectKeysFromValues("{/literal}{{$vardef.autocomplete_options}}{literal}", DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'));
				DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', index_array.join("^,^"));
		    };

		    DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText = function() {
				var index_array = DOTB.MultiEnumAutoComplete.getMultiSelectValuesFromKeys("{/literal}{{$vardef.autocomplete_options}}{literal}", DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.get('value'));
				if(index_array.length < 1){
					DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', '');
				}
				else{
					DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', index_array.join(", ") + ", ");
				}
		    };	
		    DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText();
		{{/if}}

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
			});
		{{/if}}

		DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function () {
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateHidden();
			DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText();
		});
	
	    // when they click on the arrow image, toggle the visibility of the options
	    DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.on('click', function () {
			if({/literal}DOTB.AutoComplete.{$ac_key}.minQLen{literal} == 0){
				DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
				DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.show();
			}
			else{
				DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
			}
	    });
	
		if({/literal}DOTB.AutoComplete.{$ac_key}.minQLen{literal} == 0){
		    // After a tag is selected, send an empty query to update the list of tags.
		    DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.after('select', function () {
		      DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
		      DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.show();
			  DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateHidden();
			  DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText();
		    });
		} else {
		    // After a tag is selected, send an empty query to update the list of tags.
		    DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.after('select', function () {
			  DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateHidden();
			  DOTB.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.updateText();
		    });
		}
	});
	</script>
	{/literal}
{/if}