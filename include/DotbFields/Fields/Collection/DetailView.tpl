{*

*}
<script type="text/javascript" src='{dotb_getjspath file="include/DotbFields/Fields/Collection/DotbFieldCollection.js"}'></script>
<script type="text/javascript" src='{dotb_getjspath file="include/JSON.js"}'></script>
<div id='{{dotbvar key='name'}}_div' name='{{dotbvar key='name'}}_div'><img src="{dotb_getimagepath file='sqsWait.gif'}" alt="Loading..." id="{{dotbvar key="name"}}_loading_img" style="display:none"></div>
<script type="text/javascript">
//{literal}
    var callback = {
        success:function(o){
            //{/literal}
            document.getElementById('{{dotbvar key="name"}}_loading_img').style.display="none";
            document.getElementById('{{dotbvar key="name"}}_div').innerHTML = o.responseText;
            DOTB.util.evalScript(o.responseText);
            //{literal}
        },
        failure:function(o){
            alert(DOTB.language.get('app_strings','LBL_AJAX_FAILURE'));
        }
    }
    //{/literal}
    document.getElementById('{{dotbvar key="name"}}_loading_img').style.display="inline";
    postData = '&displayParams=' + '{{$displayParamsJSON}}' + '&vardef=' + '{{$vardefJSON}}' + '&module_dir=' + document.forms.DetailView.module.value + '&bean_id=' + document.forms.DetailView.record.value + '&action_type=detailview';
    //{literal}
    YAHOO.util.Connect.asyncRequest('POST', 'index.php?action=viewdotbfieldcollection', callback, postData);
//{/literal}
</script>