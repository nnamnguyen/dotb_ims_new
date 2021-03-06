
/**
 * This JavaScript file provides all the necessary methods
 * for the new DOTB Form Validation Engine. This is integrated
 * heavily with the DOTB Expressions engine which does the
 * actual input validation behind the scenes.
 *
 * @import dotb_expressions.php
 * @import calculatedfields.js  (FlashField function)
 * @import yui-dom-event.js	    (although, we could do without this in the future)
 */


// namespace
if ( typeof(DOTB.forms) == 'undefined' )	DOTB.forms = {};

/**
 * A central validator which manages which fields are required
 * and how to validate those fields.
 */
DOTB.forms.FormValidator = function() {
	// pass ...
}

/**
 * The list of all associated forms.
 */
DOTB.forms.FormValidator.FORMS = {};

/**
 * The last submitted time for the forms.
 */
DOTB.forms.FormValidator.LAST_SUBMIT_TIME = {};

/**
 * Adds a field to the list and makes it required.
 */
DOTB.forms.FormValidator.add = function(formname, name, condition, msg)
{
	var myself = DOTB.forms.FormValidator;

	// check if the form is already associated, if not make it
	if ( typeof(myself.FORMS[formname]) == 'undefined' )
		myself._addForm(formname);

	// check if it exists, if not create it
	if ( typeof(myself.FORMS[formname][name]) == 'undefined' )
		myself._addField(formname, name);

	// if it still doesn't exist, then just ignore
	if ( typeof(myself.FORMS[formname][name].element) == 'undefined' )	return;

	// register the element
	myself._registerElement(formname, name);

	// add to the assignment handler (if available)
	if ( typeof(DOTB.forms.AssignmentHandler) != 'undefined' )
		DOTB.forms.AssignmentHandler.registerField(formname, name);

	// the default condition, true
	if ( typeof(condition) == 'undefined' )	condition = 'true';

	// now add the data to it
	var list = myself.FORMS[formname][name].conditions;
	list[list.length] = { condition: condition, message: msg };
}

/**
 * Validates the form specified.
 */
DOTB.forms.FormValidator.validateForm = function(formname) {
	// check for presence
	if ( typeof( this ) == 'undefined' )	return false;
	if (typeof formname != 'string') {
		formname = this.getAttribute('name');
	}

	// define myself
	var myself = DOTB.forms.FormValidator;

	// if not defined let be
	if ( typeof( myself.FORMS[formname] ) == 'undefined' )	return true;
	
	// update the submit time
	var _date = new Date();
	if ( typeof(myself.LAST_SUBMIT_TIME[formname]) == 'undefined' )				// define its last submit time, if needed
		myself.LAST_SUBMIT_TIME[formname] = _date.getTime();
	else if ( _date.getTime() < ( myself.LAST_SUBMIT_TIME[formname] + 2000 ) )	// ignore submits for two seconds
		return false;
	else
		myself.LAST_SUBMIT_TIME[formname] = _date.getTime();

	// get the form
	var form = myself.FORMS[formname];

	// clear all the errors
	DOTB.forms.FormValidator.clearErrors(formname);

	// the list of invalid fields
	var errors = {};
	var count  = 0;

	// go through each field
	for ( var name in form )
	{
		// ignore the required property
		if ( name == 'required' ) continue;

		// get the field
		var field = form[name];

		// if the field doesn't exist
		if ( typeof(field) == 'undefined' ) continue;
		if ( typeof(field.element) == 'undefined' ) continue;
		if ( typeof(field.element.value) == 'undefined' ) continue;

		// get the value (trim left/right spaces)
		var value = field.element.value.replace(/^\s+|\s+$/g,"");;

		// now set the value without spaces
		field.element.value = value;

		// if empty but required, add an error
		if ( value == '' && ( field.required == true || myself.FORMS[formname].required[name] == true ) ) {

			// define errors[name] if not already
			if ( typeof(errors[name]) == 'undefined' ) {
				errors[name] = { element: field.element, messages: [] };
			}

			// messages
			errors[name].messages[errors[name].messages.length] = 'Empty required field';

			// increment the error count
			count++;

			// ignore the conditions
			continue;
		}

		// if empty but not required, skip it
		else if ( value == '' ) {
			continue;
		}
		// go through each of the conditions and eval them
		for ( var i = 0; i < field.conditions.length; i++ )
		{
			// get the condition
			var condition = field.conditions[i].condition;

			// eval the condition
			if ( ! myself._test(condition, formname) ) {

				// define errors[name] if not already
				if ( typeof(errors[name]) == 'undefined' ) {
					errors[name] = { element: field.element, messages: [] };
				}
				// add a new error message
				errors[name].messages[errors[name].messages.length] = field.conditions[i].message;

				// increment error count
				count++;
			}
		}
	}

	// if no errors, return true
	if ( count <= 0 )  {
		return true;
	}

	// render all the errors
	for ( var name in errors )
	{
		var el 	 = errors[name].element;
		var msgs = errors[name].messages;

		// render the errors
		for ( var i = 0; i < msgs.length; i++ ) {
			DOTB.forms.FormValidator.renderError(el, msgs[i]);
		}
	}

	return false;
}

/**
 * Checks if a certain form and name is contained within validation.
 */
DOTB.forms.FormValidator.contains = function(formname, name) {
	var myself = DOTB.forms.FormValidator;
	return ( typeof(myself.FORMS[formname]) != 'undefined' && typeof(myself.FORMS[formname][name]) != 'undefined');
}

/**
 * Remove the name within the form from the validation.
 */
DOTB.forms.FormValidator.remove = function(formname, name) {
	var myself = DOTB.forms.FormValidator;
	if ( myself.contains(formname, name ) ) {
		myself.FORMS[formname][name] 		  = null;
		myself.FORMS[formname].required[name] = null;
	}
}

/**
 * Updates whether a field or fields is/are required or not. (by default makes them required)
 */
DOTB.forms.FormValidator.setRequired = function(formname, name, required)
{
	var myself = DOTB.forms.FormValidator;
	if ( typeof(myself.FORMS[formname]) == 'undefined' ) {
		myself._addForm(formname);
	}

	var r = ( typeof(required) != 'undefined' && required != true ? false : true );

	if ( name instanceof Array ) {
		for ( var i = 0; i < name.length; i++ ) {
			if ( typeof(myself.FORMS[formname][name[i]]) == 'undefined' )	myself._addField(formname, name[i]);
			myself.FORMS[formname][name[i]].required = r;
			myself.FORMS[formname].required[name[i]] = ( r == true ? r : null );
		}
	} else {
		if ( typeof(myself.FORMS[formname][name[i]]) == 'undefined' )	myself._addField(formname, name);
		myself.FORMS[formname][name].required = r;
		myself.FORMS[formname].required[name] = ( r == true ? r : null );
	}
}

/**
 * Checks if a certain form is contained within validation.
 */
DOTB.forms.FormValidator.containsForm = function(formname) {
	return ( typeof(DOTB.forms.FormValidator.FORMS[formname]) != 'undefined' );
}

/**
 * Remove the form from validation.
 */
DOTB.forms.FormValidator.removeForm = function(formname) {
	DOTB.forms.FormValidator.FORMS[formname] = null;
	DOTB.forms.FormValidator._removeListener(formname);
}

/**
 * Clears all previously displayed error messages.
 */
DOTB.forms.FormValidator.clearErrors = function(formname) {
	if (typeof formname != 'undefined' ) formname = document.forms[formname];

	// get the elements by class/tag name
	var elements = YAHOO.util.Dom.getElementsByClassName('error', 'div', formname);

	// remove all of them
	for ( var i = 0 ; i < elements.length ; i ++ ) {
		elements[i].parentNode.removeChild(elements[i]);
	}
}

/**
 * Displays an error message next to the field.
 */
DOTB.forms.FormValidator.renderError = function(element, msg) {
	// check if element exists
	if ( typeof(element) == 'undefined' || typeof(msg) == 'undefined' ) return;

	// animate the field
	if ( typeof(DOTB.forms.FlashField) != 'undefined' )
		DOTB.forms.FlashField(element);

	// add the error message only if it already isn't there
	if( element.parentNode.innerHTML.indexOf(msg) < 0 )
	{
        var err_node = document.createElement('div');
        err_node.className = 'error';
		err_node.style.cssFloat = "left";
		err_node.style.styleFloat = "left";
        err_node.innerHTML = msg;
        element.parentNode.appendChild(err_node);
	}
}

/**
 * FUNCTION ALIASES
 */
DOTB.forms.FormValidator.alpha = function(formname, name, options) {
	var m = 'Can only contain alphabets';
	if ( typeof(options) == 'object' ) {
		m = ( typeof(options.message)  == 'string'  ? options.message : m );
	}
	DOTB.forms.FormValidator.add(formname, name, "isAlpha($" + name + ")" , m);
}

DOTB.forms.FormValidator.numeric = function(formname, name, options) {
	var m = 'Can only contain numbers';
	if ( typeof(options) == 'object' ) {
		m = ( typeof(options.message)  == 'string'  ? options.message  : m );
	}
	DOTB.forms.FormValidator.add(formname, name, "isNumeric($" + name + ")" , m);
}

DOTB.forms.FormValidator.alphanumeric = function(formname, name, options) {
	var m = 'Can only contain alphabets and numbers';
	if ( typeof(options) == 'object' ) {
		m = ( typeof(options.message)  == 'string'  ? options.message  : m );
	}
	DOTB.forms.FormValidator.add(formname, name, "isAlphaNumeric($" + name + ")" , m);
}

DOTB.forms.FormValidator.email = function(formname, name, options) {
	var m = 'Invalid E-Mail format';
	if ( typeof(options) == 'object' ) {
		m = ( typeof(options.message)  == 'string'  ? options.message  : m );
	}
	DOTB.forms.FormValidator.add(formname, name, "isValidEmail($" + name + ")" , m);
}

DOTB.forms.FormValidator.phone = function(formname, name, options) {
	var m = 'Invalid Phone format';
	if ( typeof(options) == 'object' ) {
		m = ( typeof(options.message)  == 'string'  ? options.message  : m );
	}
	DOTB.forms.FormValidator.add(formname, name, "isValidPhone($" + name + ")" , m);
}

DOTB.forms.FormValidator.date = function(formname, name, options) {
	var m = 'Invalid Date format';
	if ( typeof(options) == 'object' ) {
		m = ( typeof(options.message)  == 'string'  ? options.message  : m );
	}
	DOTB.forms.FormValidator.add(formname, name, "isValidDate($" + name + ")" , m);
}

DOTB.forms.FormValidator.time = function(formname, name, options) {
	var m = 'Invalid Time format';
	if ( typeof(options) == 'object' ) {
		m = ( typeof(options.message)  == 'string'  ? options.message  : m );
	}
	DOTB.forms.FormValidator.add(formname, name, "isValidTime($" + name + ")" , m);
}

DOTB.forms.FormValidator.range = function(formname, name, options) {
	var m = 'Out of range [' + options.min + ',' + options.max + ']';
	if ( typeof(options) == 'object' && typeof(options.min) == 'number' && typeof(options.max) == 'number' ) {
		m = ( typeof(options.message)  == 'string' ? options.message  : m );
		DOTB.forms.FormValidator.add(formname, name, "isWithinRange($" + name + "," + options.min + "," + options.max + ")" , m);
	}
}

DOTB.forms.FormValidator.binary = function(formname, name, options) {
	var m = 'Both ' + name + ' and ' + options.sibling + ' are required';
	var s = '';
	if ( typeof(options) == 'object' && typeof(options.sibling) == 'string' ) {
		m = ( typeof(options.message)  == 'string'  ? options.message  : '' );
		DOTB.forms.FormValidator.add(formname, name, "doBothExist($" + name + ", $" + options.sibling + ")" , m);
	}
}

// TODO: implement this function
DOTB.forms.FormValidator.isbefore = function(formname, name, options) {
	// implement
}

/**
 * @PRIVATE
 * Creates the entry for a form in the main map.
 */
DOTB.forms.FormValidator._addForm = function(formname)
{
	var myself = DOTB.forms.FormValidator;
	myself.FORMS[formname] 		  	= {};
	myself.FORMS[formname].required = {};
	myself._attachListener(formname);
}

/**
 * @PRIVATE
 * Create the entry for a field in a form in the main map.
 */
DOTB.forms.FormValidator._addField = function(formname, name) {
	var myself = DOTB.forms.FormValidator;
	var el = myself._retrieveElement(formname, name);
	myself.FORMS[formname][name] = {	conditions	: [],			// an array of validators
										required	: false,		// required or not
										element		: el
							 		};
}

/**
 * @PRIVATE
 * Test a condition.
 */
DOTB.forms.FormValidator._test = function(condition, formname) {
	// get the default expression parser
	var parser = DOTB.forms.DefaultExpressionParser;

	// if parser cannot be loaded, return false
	if ( typeof(parser) == 'undefined' ) 	return false;

	// load myself in
	var myself = DOTB.forms.FormValidator;

	// get the form list
	var form = myself.FORMS[formname];

	// now eval the condition
	try {
        var ev = DOTB.forms.evalVariableExpression(condition);
		return (ev.evaluate() == 'true');
	} catch ( error )  {
		if (console && console.log){ console.log('ERROR: ' + e );}
		return false;
	}

	return false;
}

/**
 * @PRIVATE
 * Attaches a listener to the form specified.
 * TODO: (NOTE) Temporarily disabled so that Cancel can work.
 */
DOTB.forms.FormValidator._attachListener = function(formname) {
}

/**
 * @PRIVATE
 * Removes a listener to from the form specified.
 */
DOTB.forms.FormValidator._removeListener = function(formname) {
	document.forms[formname].onsubmit = "";
}

/**
 * @PRIVATE
 * Retrieves the element pointed to by the formname and element name.
 */
DOTB.forms.FormValidator._retrieveElement = function( form, name ) {
	return ( typeof(document.forms[form]) != 'undefined' ? document.forms[form][name] : null );
}

/**
 * This method takes care of the abstraction layer
 * between form,name referencing and id referencing.
 */
DOTB.forms.FormValidator._registerElement = function(formname, name)
{
	var element = DOTB.forms.FormValidator._retrieveElement(formname, name);

 	if ( element == null ) 	return;

 	if ( element.id == '' ) {
 		element.id = formname + "_" + name;
 	}

 	return element.id;
}

/**
 * TODO: DOTB INTEGRATION (HUGE)
 * Takes a value and removes the formatting from it.
 */
DOTB.forms.UnformatValue = function(value, type)
{
    // if no type defined, try a number, if not just a string
    if (typeof(type) == 'undefined') {
        return (value === '') ? value : '"' + value + '"';
    }
}

/**
 * @STATIC
 * Animates a field when by changing it's background color to
 * a shade of light red and back.
 */
DOTB.forms.FlashField = function(field, to_color) {
    if (typeof(field) == 'undefined') {
        return;
    }

	// store the original background color
	var original = field.style.backgroundColor;

	// default bg-color to white
	if ( typeof(original) == 'undefined' || original == '' ) {
		original = '#FFFFFF';
	}

	// default to_color
	if ( typeof(to_color) == 'undefined' )
		var to_color = '#FF8F8F';

	// Create a new ColorAnim instance
    var oButtonAnim = new YAHOO.util.ColorAnim(field, { backgroundColor: { to: to_color } }, 0.2);

    oButtonAnim.onComplete.subscribe(function () {
    	if ( this.attributes.backgroundColor.to == to_color ) {
    		this.attributes.backgroundColor.to = original;
    		this.animate();
    		return;
    	}
        field.style.backgroundColor = original;
    });

    oButtonAnim.animate();
}
