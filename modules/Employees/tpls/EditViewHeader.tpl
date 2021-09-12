{*

*}
<script type="text/javascript">
    {if $SHOW_NON_EDITABLE_FIELDS_ALERT}
    {literal}
    app.alert.show('non_editable_employee_fields', {
        level: 'info',
        messages: '{/literal}{$NON_EDITABLE_FIELDS_MSG}{literal}',
        autoClose: false
    });
    {/literal}
    {/if}
</script>
{{include file='include/EditView/header.tpl'}}
