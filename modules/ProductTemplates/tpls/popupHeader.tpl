{*

*}
{{include file='include/Popups/tpls/header.tpl'}}
{{dotb_getscript file='include/javascript/popup_helper.js'}}
{{dotb_getscript file='include/javascript/yui/build/connection/connection.js'}}
{{dotb_getscript file='modules/ProductTemplates/Popup_picker.js'}}
{{$treeheader}}
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="edit view">
    <tr><td>
        <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr><td>
                <div id="productcatalog">{{$treeinstance}}</div>
            </td></tr>
        </table>
    </td></tr>
</table>