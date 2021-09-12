
$(document).ready(function () {
    $('#tblquery').multifield({
        section :   '.row_tpl', // First element is template
        addTo   :   '#tbodyquery', // Append new section to position
        btnAdd  :   '#btnAddrow', // Button Add id
        btnRemove:  '.btnRemove', // Buton remove id
    });

    $('.queryval, .searchval, .replaceval').live('change', function () {
        var row = $(this).closest('.row_tpl');
        saveJson(row);
    });

});

function saveJson(row) {
    json = {};
    json.query = row.find('.queryval').val();
    json.search = row.find('.searchval').val();
    json.replace = row.find('.replaceval').val();
    var json_str = JSON.stringify(json);
    //Assign json
    row.find("input.json_query").val(json_str);
}