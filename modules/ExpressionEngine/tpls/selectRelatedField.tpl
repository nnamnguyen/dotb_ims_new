{*

*}
<script type="text/javascript">

</script>
<table id="selrf_table">
    <tr>
        <td class="label">Module:</td>
        <td>{html_options name="rmodule" id="selrf_rmodule" selected=$selLink  values=$rmodules options=$rmodules onChange="DOTB.expressions.updateSelRFLink(this.value)" }</td>
    </tr><tr>
        <td scope="label">Field:</td>
        <td>{html_options name="rfield" id="selrf_rfield" values=$rfields options=$rfields onChange="console.log(this)"}</td>
    </tr>
</table>
<div style="width:100%;text-align:right">
    <button class='button' name='selrf_cancelbtn' onclick="DOTB.formulaRelFieldWin.hide()" >
        {dotb_translate module="ModuleBuilder" label="LBL_BTN_CANCEL"}
    </button>
    <button class='button' name='selrf_insertbtn' onclick='DOTB.expressions.insertRelated()' >
        {dotb_translate module="ModuleBuilder" label="LBL_BTN_INSERT"}
    </button>
</div>