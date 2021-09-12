{*

*}

<script type="text/javascript">
{literal}
var ajxProgress;
var showMSG = 'true';
//when called, this function will make ajax call to rebuild/repair js files
function callRebuildSprites() {

    //begin main function that will be called
    ajaxCall = function() {
        //create success function for callback
        success = function(data)
        {
            //turn off loading message
            ajaxStatus.hideStatus();
            var targetdiv=document.getElementById('msgDiv');
            $msg = data.responseText;
            $msg += '</br>' + DOTB.language.get('Administration', 'LBL_REPAIR_JS_FILES_DONE_PROCESSING');
            targetdiv.innerHTML = $msg;
        }

        //set loading message and create url
        ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_PROCESSING_REQUEST'));
        postData = 'module=Administration&action=callRebuildSprites' + '&csrf_token=' + DOTB.csrf.form_token;

        //if this is a call already in progress, then just return
        if(typeof ajxProgress != 'undefined')
        {
           return;
        }

        //make asynchronous call to process js files
        var ajxProgress = YAHOO.util.Connect.asyncRequest('POST','index.php', {success: success, failure: success}, postData);
    };//end ajaxCall method

    window.setTimeout('ajaxCall()', 2000);
    return;

}
//call function, so it runs automatically
callRebuildSprites();
{/literal}
</script>