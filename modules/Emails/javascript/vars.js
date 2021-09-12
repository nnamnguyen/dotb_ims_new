
var req;
var target;
var flexContentOld = "";
var forcePreview = false;
var inCompose = false;

/* globals for Callback functions */
var email; // AjaxObject.showEmailPreview
var ieId;
var ieName;
var focusFolder;
var meta; // AjaxObject.showEmailPreview
var sendType;
var targetDiv;
var urlBase = 'index.php';
var urlStandard = 'dotb_body_only=true&to_pdf=true&module=Emails&action=EmailUIAjax';

var lazyLoadFolder = null;