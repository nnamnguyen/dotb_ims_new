{*

*}
<!DOCTYPE html>
<head>
<script language="javascript">
    {literal}
    function loadApp(auth, siteUrl) {
        localStorage.setItem('_AuthAccessToken', auth.access_token);
        localStorage.setItem('_AuthRefreshToken', auth.refresh_token);
        localStorage.setItem('_DownloadToken', auth.download_token);
        window.location.href = (siteUrl || '').replace(/\/*$/, '') + '/mobile';
    }
    {/literal}    
    loadApp({$authorization|@json}, '{$siteUrl|escape:javascript}')        
</script>
</head>
<body/>
</html>

