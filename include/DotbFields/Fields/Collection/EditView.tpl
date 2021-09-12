{*

*}
<link rel="stylesheet" type="text/css" href="{dotb_getjspath file='include/javascript/yui-old/assets/container.css'}" />
<script type="text/javascript" src='{dotb_getjspath file="include/DotbFields/Fields/Collection/DotbFieldCollection.js"}'></script>
<div id='{{dotbvar key='name'}}_div' name='{{dotbvar key='name'}}_div'><img src="{dotb_getimagepath file='sqsWait.gif'}" alt="loading..." id="{{dotbvar key="name"}}_loading_img" style="display:none"></div>
<script type="text/javascript">
//{literal}
    var callback = {
        success:function(o){
            //{/literal}
            //collection['{{dotbvar key="name"}}'] = new DOTB.collection('{{dotbvar key="name"}}', "{{dotbvar key='module'}}", '{{$displayParams.popupData}}');
            document.getElementById('{{dotbvar key="name"}}_loading_img').style.display="none";
            document.getElementById('{{dotbvar key="name"}}_div').innerHTML = o.responseText;
            DOTB.util.evalScript(o.responseText);
            {* //TODO: Expression Engine removed from Tokyo so DOTB.forms no longer exists.
			{{if !empty($required)}}
            DOTB.forms.FormValidator.add('EditView', '{{dotbvar key="name"}}_field', 'isRequiredCollection(\${{dotbvar key="name"}}_field)', DOTB.language.get('app_strings', 'ERROR_MISSING_COLLECTION_SELECTION'));
            {{/if}} *}
            //{literal}
        },
        failure:function(o){
            alert(DOTB.language.get('app_strings','LBL_AJAX_FAILURE'));
        }
    }
    //{/literal}
    document.getElementById('{{dotbvar key="name"}}_loading_img').style.display="inline";
    postData = '&displayParams=' + '{{$displayParamsJSON}}' + '&vardef=' + '{{$vardefJSON}}' + '&module_dir=' + document.forms.EditView.module.value + '&bean_id=' + document.forms.EditView.record.value + '&action_type=editview';
    //{literal}
    YAHOO.util.Connect.asyncRequest('POST', 'index.php?action=viewdotbfieldcollection', callback, postData);
//{/literal}
</script>