$(document).ready(
    ()=>{
        //setting listener
        $("input").focusout((e)=>{
            switch (e.target.id){
                case ("fullName"): checkFullName(e.target.value);break;
                case ("userName"): checkUserName(e.target.value);break;
                case ("password"): checkPassword(e.target.value);break;
                case ("confirmPassword"): checkConfirmPassword(e.target.value);break;
                case ("email"): checkEmail(e.target.value);break;
                case ("socialSecurityNumber"): checkSSN(e.target.value);break;
                case ("phoneNumber"): checkPoneNumber(e.target.value);break;
            }
        });

        /*
        // without regex email validator
        if ($('my_email_input').is(':valid')) { 
            // do something if it is valid
          }
        */
    }
);


const checkUserName = (value)=>{
  const rgx = new RegExp('^[A-Za-z]*$');
  if(!rgx.test(value) && value != ""){
        $("#userName_error").html("Your username should not have a space.");
        $("#userName_error").css("display","block");
        return;
    }
    if(gx.test(value)){

    }

}


const checkPassword = (value)=>{
  if(value != $("#confirmPassword").val() && $("#confirmPassword").val() != ""){

    $("#confirmPassword").css("border","1px solid red");
    $("#password").css("border","1px solid red");
    $("#password_error").css("display","block");
    $("#password_error").html("Password and Confirm Password do not match");
    return;
  }
  
  if(value == $("#confirmPassword").val() && $("#confirmPassword").val() != ""){
    $("#confirmPassword").css("border","1px solid green");
    $("#password").css("border","1px solid green");
    $("#confirmPassword_error").css("display","none");
    $("#password_error").css("display","none");
  } 
}


const checkConfirmPassword = (value)=>{
    if(value != $("#password").val() ){
      $("#confirmPassword").css("border","1px solid red");
      $("#password").css("border","1px solid red");
      $("#confirmPassword_error").css("display","block");
      $("#confirmPassword_error").html("Password and Confirm Password do not match");
      return;
    }

    if(value == $("#password").val() && $("#password").val() != "")
    {
      $("#confirmPassword").css("border","1px solid green");
      $("#password").css("border","1px solid green");
      $("#confirmPassword_error").html("");
      $("#confirmPassword_error").css("display","none");
      $("#password_error").css("display","none");
    }
}