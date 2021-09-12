

function togglePasswordRetypeRequired() {
   var theForm = document.forms[0];
   var elem = document.getElementById('password_retype_required');

   if( theForm.setup_db_create_dotbsales_user.checked ){
      elem.style.display = '';
      // theForm.setup_db_dotbsales_user.focus();
      theForm.setup_db_username_is_privileged.checked = "";
      theForm.setup_db_username_is_privileged.disabled = "disabled";
      toggleUsernameIsPrivileged();
   }
   else {
      elem.style.display = 'none';
      theForm.setup_db_username_is_privileged.disabled = "";
   }
}

function toggleDropTables(){
   var theForm = document.forms[0];

   if( theForm.setup_db_create_database.checked ){
      theForm.setup_db_drop_tables.checked = '';
      theForm.setup_db_drop_tables.disabled = "disabled";
   }
   else {
      theForm.setup_db_drop_tables.disabled = '';
   }
}

function toggleUsernameIsPrivileged(){
   var theForm = document.forms[0];
   var elem = document.getElementById('privileged_user_info');

   if( theForm.setup_db_username_is_privileged.checked ){
      elem.style.display = 'none';
   }
   else {
      elem.style.display = '';
   }
}
