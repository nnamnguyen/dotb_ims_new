

function toggleSiteDefaults(){
   var theForm = document.forms[0];
   var elem = document.getElementById('setup_site_session');

   if( theForm.setup_site_defaults.checked ){
      document.getElementById('setup_site_session_section_pre').style.display = 'none';
      document.getElementById('setup_site_session_section').style.display = 'none';
      document.getElementById('setup_site_log_dir_pre').style.display = 'none';
      document.getElementById('setup_site_log_dir').style.display = 'none';
      document.getElementById('setup_site_guid_section_pre').style.display = 'none';
      document.getElementById('setup_site_guid_section').style.display = 'none';
   }
   else {
      document.getElementById('setup_site_session_section_pre').style.display = '';
      document.getElementById('setup_site_log_dir_pre').style.display = '';
      document.getElementById('setup_site_guid_section_pre').style.display = '';
      toggleSession();
      toggleGUID();
   }
}

function toggleSession(){
   var theForm = document.forms[0];
   var elem = document.getElementById('setup_site_session_section');

   if( theForm.setup_site_custom_session_path.checked ){
      elem.style.display = '';
   }
   else {
      elem.style.display = 'none';
   }
}

function toggleLogDir(){
   var theForm = document.forms[0];
   var elem = document.getElementById('setup_site_log_dir');

   if( theForm.setup_site_custom_log_dir.checked ){
      elem.style.display = '';
   }
   else {
      elem.style.display = 'none';
   }
}

function toggleGUID(){
   var theForm = document.forms[0];
   var elem = document.getElementById('setup_site_guid_section');

   if( theForm.setup_site_specify_guid.checked ){
      elem.style.display = '';
   }
   else {
      elem.style.display = 'none';
   }
}
