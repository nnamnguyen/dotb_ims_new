

DOTB.PdfManager = {};

DOTB.PdfManager.fieldInserted = false;

/**
 * Change the HelpTip for WYSIWYG
 */
DOTB.PdfManager.changeHelpTips = function() {
    if ($("#base_module").attr("value") == 'Quotes') {
        $("#body_html_label").find(".inlineHelpTip").click(function() {return DOTB.util.showHelpTips(this, DOTB.language.get('PdfManager', 'LBL_BODY_HTML_POPUP_QUOTES_HELP'),'','' )});
    } else {
        $("#body_html_label").find(".inlineHelpTip").click(function() {return DOTB.util.showHelpTips(this, DOTB.language.get('PdfManager', 'LBL_BODY_HTML_POPUP_HELP'),'','' )});
    }
}

/**
 * Returns a list of fields for a module
 */
DOTB.PdfManager.loadFields = function(moduleName, linkName) {

    if (!DOTB.PdfManager.fieldInserted && $("#field").closest("form").find("input[name=duplicateSave]").size()) {
        DOTB.PdfManager.fieldInserted = true;
    }
    
    if (DOTB.PdfManager.fieldInserted && linkName.length == 0) {
        if (!confirm(DOTB.language.get('PdfManager', 'LBL_ALERT_SWITCH_BASE_MODULE'))) {
            $('#base_module').val($('#base_module_history').val());
            return true;
        }
    }

    if (linkName.length == 0 ) {
        $('#base_module_history').val($('#base_module').val());
        DOTB.PdfManager.changeHelpTips();
    }

    if (linkName.length > 0 && linkName.indexOf('pdfManagerRelateLink_') == -1) {
        $('#subField').empty();
        $('#subField').hide();
        return true;
    }
    var url = "index.php?" + DOTB.util.paramsToUrl({
        module : "PdfManager",
        action : "getFields",
        to_pdf : "1",
        dotb_body_only : "true",
        baseModule : moduleName,
        baseLink : linkName
    });

    var resp = http_fetch_sync(url);

    var field = YAHOO.util.Dom.get('field');

    if (field != null) {
        var inputTD = YAHOO.util.Dom.getAncestorByTagName(field, 'TD');
        if (resp.responseText.length > 0 && inputTD != null) {
            inputTD.innerHTML = resp.responseText;
            DOTB.forms.AssignmentHandler.register('field', 'EditView');
        }
    }
}

/**
 * Push var to WYSIWYG
 */
DOTB.PdfManager.insertField = function(selField, selSubField) {

    DOTB.PdfManager.fieldInserted = true;

    var fieldName = "";

    if ( selField && selField.value != "") {
        fieldName += selField.value;

        if ( selSubField && selSubField.value != "") {
            fieldName += "."+selSubField.value;
        }
    }

    var cleanFieldName = fieldName.replace('pdfManagerRelateLink_', '');
	var inst = tinyMCE.getInstanceById("body_html");
	if (fieldName.length > 0 && inst) {
		inst.getWin().focus();
		inst.execCommand('mceInsertRawHTML', false, '{$fields.' + cleanFieldName + '}');
	}
}

YAHOO.util.Event.onContentReady('EditView', DOTB.PdfManager.changeHelpTips);
