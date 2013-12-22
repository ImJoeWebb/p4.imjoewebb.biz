function validateForm() // based from http://www.w3schools.com/js/js_form_validation.asp
{   
    var x=document.forms["signup_form"]["email"].value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
      {
      alert("Not a valid e-mail address");
      return false;
    }
}