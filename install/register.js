

function submitbutton()
{
   var form = document.mosForm;
   var r = new RegExp("[^0-9A-Za-z]", "i");

   if (form.email1.value != "")
   {
      var myString = form.email1.value;
      var pattern = /(\W)|(_)/g;
      var adate = new Date();
      var ms = adate.getMilliseconds();
      var sec = adate.getSeconds();
      var mins = adate.getMinutes();
      ms = ms.toString();
      sec = sec.toString();
      mins = mins.toString();
      newdate = ms + sec + mins;
   
      var newString = myString.replace(pattern,"");
      newString = newString + newdate;
      //form.username.value = newString;
      //form.password.value = newString;
      //form.password2.value = newString;
   }

   // do field validation
   if (form.name.value == "")
   {
      form.name.focus();
      alert( "Please provide your name" );
      return false;
   }
   else if (form.email1.value == "")
   {
      form.email1.focus();
      alert( "Please provide your email address" );
      return false;
   }
   else
   {
      form.submit();
   }

   document.appform.submit();
   window.focus();
}
