{*

*}
<script type="text/javascript" src="{dotb_getjspath file='cache/javascript/dotbcrm12.min.js'}"></script>
<script>

    //set the variables
    var modalBod = "{$MESSAGE}";
    var cnfgtitle = '{$MOD.LBL_ERROR}';
    var startOverLBL = '{$MOD.LBL_TRY_AGAIN}';
    var cancelLBL = '{$MOD.LBL_CANCEL}';
    var actionVAR = '{$ACTION}';
    var importModuleVAR = '{$IMPORT_MODULE}';
    var sourceVAR = '{$SOURCE|escape:'javascript':'UTF-8'}';
    var showCancelVAR = '{$SHOWCANCEL}';
    {if !empty($CANCELLABEL)}
        cancelLBL = '{$CANCELLABEL}';
    {/if}

{literal}
    //function called when 'start over' button is pressed
    var chooseToStartOver = function() {
        //hide the modal and redirect window to previous step
        this.hide();
        document.location.href='index.php?module=Import&action='+actionVAR+'&import_module='+importModuleVAR+'&source='+sourceVAR;
        //DOTB.importWizard.renderDialog(importModuleVAR,actionVAR,sourceVAR);
    };
    var chooseToCancel = function() {
        //do nothing, just hide the modal
        this.hide();
    };

    //define the buttons to be used in modal popup
    var importButtons = '';
    if(showCancelVAR){
        importButtons = [{ text: startOverLBL, handler: chooseToStartOver, isDefault:true },{ text:cancelLBL, handler: chooseToCancel}];
    }else{
        importButtons = [{ text: startOverLBL, handler: chooseToStartOver, isDefault:true }];
    }

    //define import error modal window
    ImportErrorBox = new YAHOO.widget.SimpleDialog('importMsgWindow', {
        type : 'alert',
        modal: true,
        width: '350px',
        id: 'importMsgWindow',
        close: true,
        visible: true,
        fixedcenter: true,
        constraintoviewport: true,
        draggable: true,
        buttons: importButtons
    });
{/literal}
    //display the window
    ImportErrorBox.setHeader(cnfgtitle);
    ImportErrorBox.setBody(modalBod);
    ImportErrorBox.render(document.body);
    ImportErrorBox.show();

</script>
