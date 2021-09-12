{*

*}
{if strlen({{dotbvar key='value' string=true}}) <= 0}
{assign var="value" value={{dotbvar key='default_value' string=true}} }
{else}
{assign var="value" value={{dotbvar key='value' string=true}} }
{/if}
<span id='{{dotbvar key='name'}}'>{{dotbvar key='value'}}</span>
&nbsp;&nbsp;
<span class="id-ff">
    <a id="btn_vCardButton" title="{$APP.LBL_VCARD}" href="#">{dotb_getimage alt=$app_strings.LBL_ID_FF_VCARD name="id-ff-vcard" ext=".png"}</a>
</span>
{{if !empty($displayParams.enableConnectors)}}
{if !empty($value)}
{{dotbvar_connector view='DetailView'}}
{/if}
{{/if}}

{literal}
<script type="text/javascript">
    $("#btn_vCardButton").click(function(e){
        {/literal}
        window.location.assign('index.php?module={$module}&action=vCard&record={$fields.id.value}&to_pdf=true');
        {literal}

        if (e.preventDefault) {
            e.preventDefault();
        }
    });
</script>
{/literal}
