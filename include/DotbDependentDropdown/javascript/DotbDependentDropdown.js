
DOTB.dependentDropdown = {
	/*
	 * Container for "action" metadata - allows DD to parse saved choices and apply them at display time
	 */
	currentAction : null,
	/*
	 * Flag to turn on debug mode.
	 * Current debug output:
	 * DOTB.dependentDropdown._stack - simple list of this class' called methods
	 */
	debugMode : false
}

/**
 * Handle drop-down dependencies
 * @param object HTML form element object
 */
DOTB.dependentDropdown.handleDependentDropdown = function(el) {
    /**
     * Prototype this method to customize responses for your dependent dropdowns
     */
}

DOTB.dependentDropdown.generateElement = function(focusElement, elementRow, index, elementIndex) {
	if(DOTB.dependentDropdown.debugMode) DOTB.dependentDropdown.utils.debugStack('generateElement');
	
	var tmp = null;
	
	if(focusElement) {
		/* get sandbox to play in */
		var sandbox = DOTB.dependentDropdown.utils.generateElementContainer(focusElement, elementRow, index, elementIndex);
		
		/* handle labels that appear 'left' or 'top' */
		if(focusElement.label) {
			focusLabel = {
				tag : 'span',
				cls : 'routingLabel',
				html : "&nbsp;" + focusElement.label + "&nbsp;"
			}
			
			switch(focusElement.label_pos) {
				case "top":
					focusLabel.html = focusElement.label + "<br />";
				break;
				
				case "bottom": 
					focusLabel.html = "<br />" + focusElement.label;
				break;
			}
			
			if(focusElement.label_pos == 'left' || focusElement.label_pos == 'top') {
				YAHOO.ext.DomHelper.append(sandbox, focusLabel);
			}
		}

		/**********************************************************************
		 * FUN PART BELOW
		 */
		switch(focusElement.type) {
			case 'input':
				/*
				 * focusElement.values can be lazy-loaded via JS call
				 */
				if(typeof(focusElement.values) == 'string') {
					focusElement.values = JSON.parse(focusElement.values);
				}
				
				/* Define the key-value that is to be used to pre-select a value in the dropdown */	
				var preselect = DOTB.dependentDropdown.utils.getPreselectKey(focusElement.name);

				if(preselect.match(/::/))
					preselect = '';

				tmp = YAHOO.ext.DomHelper.append(sandbox, {
					tag			: 'input',
					id			: focusElement.grouping + "::" + index + ":::" + elementIndex + ":-:" + focusElement.id,
					name		: focusElement.grouping + "::" + index + "::" + focusElement.name,
					cls			: 'input',
					onchange	: focusElement.onchange,
					value		: preselect
				}, true);
				var newElement = tmp.dom;
			break;


			case 'select':
				tmp = YAHOO.ext.DomHelper.append(sandbox, {
					tag			: 'select',
					id			: focusElement.grouping + "::" + index + ":::" + elementIndex + ":-:" + focusElement.id,
					name		: focusElement.grouping + "::" + index + "::" + focusElement.name,
					cls			: 'input',
					onchange	: focusElement.onchange
				}, true);
				var newElement = tmp.dom;
				
				/*
				 * focusElement.values can be lazy-loaded via JS call
				 */
				if(typeof(focusElement.values) == 'string') {
					focusElement.values = eval(focusElement.values);
				}
				
				/* Define the key-value that is to be used to pre-select a value in the dropdown */
				var preselect = DOTB.dependentDropdown.utils.getPreselectKey(focusElement.name);
				
				// Loop through the values (passed or generated) and preselect as needed
				var i = 0;
				for(var key in focusElement.values) {
					var selected = (preselect == key) ? true : false;
					newElement.options[i] = new Option(focusElement.values[key], key, selected);

					// ie6/7 workaround
					if(selected) {
						newElement.options[i].selected = true;
					}
					i++;
				}
			break;
			
			case 'none':
			break;
			
			case 'checkbox':
				alert('implement checkbox pls');
			break;
			case 'multiple':
				alert('implement multiple pls');
			break;
			
			default:
				if(DOTB.dependentDropdown.dropdowns.debugMode) {
					alert("Improper type defined: [ " + focusElement.type + "]");
				}
				return;
			break;
		}

		/* handle label placement *after* or *below* the drop-down */
		if(focusElement.label) {
			if(focusElement.label_pos == 'right' || focusElement.label_pos == 'bottom') {
				YAHOO.ext.DomHelper.append(sandbox, focusLabel);
			}
		}

		/* trigger dependent dropdown action to cascade dependencies */
		try {
			newElement.onchange();
		} catch(e) {
			if(DOTB.dependentDropdown.dropdowns.debugMode) {
				debugger;
			}
		}

	} else {
	}
}



///////////////////////////////////////////////////////////////////////////////
////	UTILS
DOTB.dependentDropdown.utils = {
	/**
	 * creates a DIV container for a given element
	 * @param object focusElement Element in focus' metadata
	 * @param object elementRow Parent DIV container's DOM object
	 * @param int index Index of current elementRow
	 * @param int elementIndex Index of the element in focus relative to others in the definition
	 * @return obj Reference DOM object generated
	 */
	generateElementContainer : function(focusElement, elementRow, index, elementIndex) {
		/* clear out existing element if exists */
		var oldElement = document.getElementById('elementContainer' + focusElement.grouping + "::" + index + ":::" + elementIndex);
	
		if(oldElement) {
			DOTB.dependentDropdown.utils.removeChildren(oldElement);
		}
		
		/* create sandbox to ease removal */
		var tmp = YAHOO.ext.DomHelper.append(elementRow, {
			tag : 'span',
			id	: 'elementContainer' + focusElement.grouping + "::" + index + ":::" + elementIndex
		}, true);
		
		return tmp.dom;
	},
	/**
	 * Finds the preselect key from the User's saved (loaded into memory) metadata
	 * @param string elementName Name of form element - functions as key to user's saved value
	 */
	getPreselectKey : function(elementName) {
		try {
			if(DOTB.dependentDropdown.currentAction.action[elementName]) {
				return DOTB.dependentDropdown.currentAction.action[elementName];
			} else {
				return '';
			}
		} catch(e) {
			if(DOTB.dependentDropdown.dropdowns.debugMode) {
				//debugger;
			}
			return '';
		}
	},
	
	/**
	 * provides a list of methods called in order when debugging
	 * @param object
	 */
	debugStack : function(func) {
		if(!DOTB.dependentDropdown._stack) {
			DOTB.dependentDropdown._stack = new Array();
		}
		
		DOTB.dependentDropdown._stack.push(func);
	},
	
	/**
	 * Removes all child nodes from the passed DOM element
	 */
	removeChildren : function(el) {
		for(i=el.childNodes.length - 1; i >= 0; i--) {
			if(el.childNodes[i]) {
				el.removeChild(el.childNodes[i]);
			}
		}
	}
}
