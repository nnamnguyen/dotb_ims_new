{*

*}
{literal}
<script language='javascript'>
iframe = parent.document.getElementById('style_preview');
if(iframe) {
    tail='&r='+Math.round(Math.random*10000);
	iframe.src = 'index.php?module=ModuleBuilder&action=portalpreview&to_pdf=1' + tail;
}
{/literal}
parent.document.getElementById('uploadLabel').innerHTML = '{$mod.LBL_SP_UPLOADED}';
</script>
