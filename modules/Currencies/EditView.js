
function isoUpdate( formElem ) {
    if ( typeof(js_iso4217[formElem.value]) == 'undefined' ) {
        return false;
    }

    var thisForm = formElem.form;
    var thisCurr = js_iso4217[formElem.value];
    
    if ( thisForm.name.value == '' ) {
        thisForm.name.value = thisCurr.name;
    }
    if ( thisForm.symbol.value == '' ) {
        thisForm.symbol.value = '';
        for ( var i = 0 ; i < thisCurr.unicode.length ; i++ ) {
            thisForm.symbol.value = thisForm.symbol.value + String.fromCharCode(thisCurr.unicode[i]);
        }
    }
    
    return true;
}
