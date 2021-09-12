<?php

/**
 * Class isNotLayoutRecordExpression
 * @author TKT
 * @since 2019-12-20
 * return true if current layout is not record layout, include checking drawing is open
 * use in fomula of vardef to define a field is visible or hidden
 * @example: 'dependency' => 'isNotLayoutRecord()'
 */
class isNotLayoutRecordExpression extends BooleanExpression
{
    public function evaluate()
    {
        return AbstractExpression::$FALSE;
    }

    public static function getJSEvaluate()
    {
        return <<<JS
var rs = DOTB.expressions.Expression.TRUE;
if (App === undefined) {
    rs = DOTB.expressions.Expression.TRUE;
}

var layout = App.controller.context.attributes.layout;

if(App.drawer._components.length>0){
    layout=App.drawer._components[App.drawer._components.length-1].options.def.layout;
}

if (layout == 'record' || layout=='create') {
    rs= DOTB.expressions.Expression.FALSE;
}else{
    rs= DOTB.expressions.Expression.TRUE;
}
return rs;
JS;
    }

    public static function getParameterTypes()
    {
        return array();
    }

    public static function getParamCount()
    {
        return 0;
    }

    public static function getOperationName()
    {
        return 'isNotLayoutRecord';
    }

    public function toString()
    {
    }
}
