

function toggleLicenseAccept(){
    var theForm     = document.forms[0];

    if( theForm.setup_license_accept.checked ){
        theForm.setup_license_accept.checked = "";
    }
    else {
        theForm.setup_license_accept.checked = "yes";
    }

    toggleNextButton();
}

function toggleNextButton(){
    var theForm     = document.forms[0];
    var nextButton  = document.getElementById( "button_next" );

    if( theForm.setup_license_accept.checked ){
        nextButton.disabled = '';
        nextButton.focus();
    }
    else {
        nextButton.disabled = "disabled";
    }
}
