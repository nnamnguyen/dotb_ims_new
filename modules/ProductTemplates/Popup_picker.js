

function set_return(treeid) {
    var node = YAHOO.namespace(treeid).selectednode;
    var nm = jQuery('#popup_query_form #name_advanced');
    if(nm.length == 0)
    {
        nm = jQuery('<input />', {name : 'name_advanced', id : 'name_advanced', type : 'hidden'}).appendTo(jQuery("#popup_query_form"));
    }
    var cat = jQuery('#popup_query_form #category_name_advanced');
    if(cat.length == 0)
    {
        cat = jQuery('<input />', {name : 'category_name_advanced', id : 'category_name_advanced', type : 'hidden'}).appendTo(jQuery("#popup_query_form"));
    }
    if(node.data.type == 'product'){
        nm.val(node.label);
        cat.val('');
    }else{
        nm.val('');
        cat.val(node.label);
    }
    document.popup_query_form.submit();
}

function set_return_category(name)
{
	clear_search();
	document.popup_query_form.category_name.value = name;
	document.popup_query_form.submit();
}

function set_return_product(name)
{
	clear_search();
	document.popup_query_form.name.value = name;
	document.popup_query_form.submit();
}

function clear_search() 
{
	document.popup_query_form.category_name.value = '';
	document.popup_query_form.name.value = '';
	document.popup_query_form.type_name.value = '';
	document.popup_query_form.manufacturer_name.value = '';
	
}