

var submitForm = function (e) {
    e.preventDefault();
    document.getElementById('submit_section').submit();
};

var closeAlert = function(e) {
    var alertWindow = document.getElementsByClassName('alert closeable');
    if (alertWindow[0]) {
        alertWindow[0].style.display = 'none';
    }
};

//need to separate functions because touchpad fires key down events
var onInputKeyDown = function (e) {
    if (e && ((e.keyCode && e.keyCode != 13) || !e.keyCode)) {
        return;
    }
    submitForm(e);
};

var onDOMContentLoaded = function (e) {
    var loginButton = document.getElementById('submit_btn'),
        closeAlertBtn = document.getElementById('close_alert_btn');


    if (closeAlertBtn) {
        closeAlertBtn.onclick = closeAlert;
    }

    if (loginButton) {
        loginButton.onclick = submitForm;
    }
};

document.addEventListener("DOMContentLoaded", onDOMContentLoaded);
