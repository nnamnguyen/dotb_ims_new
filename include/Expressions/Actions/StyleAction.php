<?php


class StyleAction extends AbstractAction{
	protected $expression =  "";
	
    public function __construct($params)
    {
		$this->targetField = $params['target'];
		$this->attributes = array();
        foreach($params['attrs'] as $prop => $val)
        {
            $this->attributes[$prop] = str_replace("\n", "", $val);
        }
	}
	
	/**
	 * Returns the javascript class equavalent to this php class
	 *
	 * @return string javascript.
	 */
	static function getJavascriptClass() {
		return  "
/**
 * A style dependency is an object representation of a style change.
 */
DOTB.forms.StyleAction = function(target, attrs)
{
    this.target = target;
    this.attrs  = attrs;
}

/**
 * Triggers this dependency to be re-evaluated again.
 */
DOTB.util.extend(DOTB.forms.StyleAction, DOTB.forms.AbstractAction, {

    /**
     * Triggers the style dependencies.
     */
    exec: function(context)
    {

        //If we are running in lumia, this action will not function
        if(DOTB.App) return;

        if (typeof(context) == 'undefined')
            context = this.context;
        try {
            // a temp attributes array containing the evaluated version
            // of the original attributes array
            var temp = {};

            // evaluate the attrs, if needed
            for (var i in this.attrs)
            {
                temp[i] = this.evalExpression(this.attrs[i], context);
            }
            context.setStyle(this.target, temp);
        } catch (e) {return;}
    }
});";
	}

	/**
	 * Returns the javascript code to generate this actions equivalent. 
	 *
	 * @return string javascript.
	 */
	function getJavascriptFire() {
		return  "new DOTB.forms.StyleAction('{$this->targetField}'," .json_encode($this->attributes) . ")";
	}
	
	
	
	/**
	 * Applies the Action to the target.
	 *
	 * @param DotbBean $target
	 */
	function fire(&$target) {

	}
	
	/**
	 * Returns the definition of this action in array format.
	 *
	 */
	function getDefinition() {
		return array(	
			"action" => $this->getActionName(), 
	        "target" => $this->targetField, 
	        "attrs" => $this->attributes,
	    );
	}
	
	static function getActionName() {
		return "Style";
	}
}

