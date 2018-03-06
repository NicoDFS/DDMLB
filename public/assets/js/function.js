$(document).ready(function(){
    
  $(document.body).on('change','.optionradio',function(){
      
      var result = $(this).val();
      
      if(result == 'login'){
          $(document.body).find('.signupgroup').hide();
          $(document.body).find('.logingroup').show();
     
      }else if(result == 'signup'){
          $(document.body).find('.signupgroup').show();
        
      }
      
      
  });
  
  

function getRole() {
    return $(".signupform").find("input[name=optionsRadios]:checked").val();
}  

$(".signupform").validate({
        rules: {
            username: {
                required: true,
                remote: l,
                regex: /^[a-zA-Z0-9_\.]+$/
                
            },
            email: {
                required: function(element) {
                    if(getRole() == 'signup'){
                        return true;
                    }
                },
                email: true  
            },
            password: {
                required: true,
                minlength: 5,
                maxlength:10
            },
            confirmPassword: {
                required: function(element) {
                    if(getRole() == 'signup'){
                        return true;
                    }
                },
                minlength: 5,
                maxlength:10,
                equalTo: "#passwordinp"
            },
            countryoption: {
                required: function(element) {
                    if(getRole() == 'signup'){
                        return true;
                    }
                }
            },
            cityoption: {
                required: function(element) {
                    if(getRole() == 'signup'){
                        return true;
                    }
                }
            },
            agreeterms: {
                required: function(element) {
                    if(getRole() == 'signup'){
                        return true;
                    }
                }
            },
            ageconfirm: {
                required: function(element) {
                    if(getRole() == 'signup'){
                        return true;
                    }
                }
            }            
            
        },
        messages: {
            username: {
                required: "Username is required Field",
                regex: "Invalid Format"
            },
            email: {
                required: "Email is required Field",
                email: "Invalid Email Format"
            },
            password: {
                required: "Password is required Field",
                minlength: "Minimum Length of password is 3",
                maxlength: "Maximum Length of Password is 10"
            },
            confirmPassword: {
                required: "This is required Field",
                minlength: "Minimum Length of password is 3",
                maxlength: "Maximum Length of Password is 10",
                equalTo: "Password Doesn't Match"
            },
            countryoption: {
                required: "Country is required Field"
            },
            cityoption: {
                required: "City is required Field"
            },
            agreeterms: {
                required: "You Must Agree to term and condition"
            },
            ageconfirm: {
                required: "Confirm Age Verification"
            }
            
        }

});

//$(".loginformpop").validate({
//        rules: {
//            username: {
//                required: true
//                
//            },
//            password: {
//                required: true
//            }            
//            
//        },
//        messages: {
//            username: {
//                required: "Username is required Field"
//               
//            },
//            password: {
//                required: "Password is required Field"
//            }
//            
//        }
//
//});

$(".signupform").validate({
        rules: {
            username: {
                required: true,
                remote: l,
                regex: /^[a-zA-Z0-9_\.]+$/
                
            },
            email: {
                required: true,
                email: true  
            },
            password: {
                required: true,
                minlength: 5,
                maxlength:10
            }, 
            confirmPassword: {
                required: true,
                minlength: 5,
                maxlength:10,
                equalTo: "#loginpopmatch"
            },
            countryoption: {
                required: true
            },    
            cityoption: {
                required: true
            },
            agreeterms: {
                 required: true
            },
            ageconfirm: {
                 required: true
            }            
            
        },
        messages: {
            username: {
                required: "Username is required Field",
                regex: "Invalid Format"
            },
            email: {
                required: "Email is required Field",
                email: "Invalid Email Format"
            },
            password: {
                required: "Password is required Field",
                minlength: "Minimum Length of password is 3",
                maxlength: "MaxLength of Password is 10"
            },
            confirmPassword: {
                required: "This is required Field",
                minlength: "Minimum Length of password is 3",
                maxlength: "MaxLength of Password is 10",
                equalTo: "Password Doesn't Match"
            },
            countryoption: {
                required: "Country is required Field"
            },
            cityoption: {
                required: "City is required Field"
            },
            agreeterms: {
                required: "You Must Agree to term and condition"
            },
            ageconfirm: {
                required: "Confirm Age Verification"
            }
            
        }

});


$(document.body).on('click','.togglemodalforms',function(e){
    
    e.preventDefault();
    if($(".loginformpop").hasClass('hidden')){
        $(".loginformpop").removeClass('hidden');
        $(".signupformpop").addClass('hidden');
    }else if($(".signupformpop").hasClass('hidden')){
        $(".signupformpop").removeClass('hidden');
        $(".loginformpop").addClass('hidden');     
    }
    
    
    
    if( ! $(".resetpasswordformpop").hasClass('hidden')){
        $(".resetpasswordformpop").addClass('hidden');
    }
    
    
    
});
$(document.body).on('click','.resetmodalforms',function(e){
    
    e.preventDefault();
    if($(".resetpasswordformpop").hasClass('hidden')){
        $(".resetpasswordformpop").removeClass('hidden');
        if( ! $(".signupformpop").hasClass('hidden')){
          $(".signupformpop").addClass('hidden');
        }
        if( ! $(".loginformpop").hasClass('hidden')){
          $(".loginformpop").addClass('hidden');
        }
        
       
    }else{
        $(".resetpasswordformpop").addClass('hidden');
        if( ! $(".signupformpop").hasClass('hidden')){
          $(".signupformpop").addClass('hidden');
        }
        $(".loginformpop").removeClass('hidden');
    }
    
    
    
});

   
    
});
