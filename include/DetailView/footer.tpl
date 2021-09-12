{*

*}
{*Added by Lap Nguyen detailviewdef.php *}
{{if $externalJSFile}}
    {dotb_include include=$externalJSFile}
{{/if}}

{{if isset($scriptBlocks)}}
    {{$scriptBlocks}}
{{/if}}
{*End Lap Nguyen*}
</form>
<script>DOTB.util.doWhen("document.getElementById('form') != null",
        function(){ldelim}DOTB.util.buildAccessKeyLabels();{rdelim});
</script>