
/*global DOTB, canvas, Document*/

var translate = function (label, module, replace) {
    //var string = (DOTB.language.languages.ProcessMaker[label]) ? DOTB.language.languages.ProcessMaker[label] : label;
    var string, language, arr;
    if (!module){
        if (!window.CURRENT_MODULE) {
            module = 'pmse_Project';
        } else {
            module = window.CURRENT_MODULE;
        }
    }
    if (App) {
        string = App.lang.get(label, module);
    } else {
        language = DOTB.language.languages;
        arr = language[module];
        string = (arr && arr[label]) ? arr[label] : label;
    }
    if (!replace) {
        return string;
    } else {
        return string.toString().replace(/\%s/, replace);
    }
};
