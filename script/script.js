function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(regex.test(email)) {
       return true;
    }else{
       return false;
    }
  }

  function IsPhone(phone) {
    var regex = /([0-9]{11})/;
    if(regex.test(phone)) {
       return true;
    }else{
       return false;
    }
  }
$(document).ready(function () {
    $('button').click(function (e) { 
    
    if($('input[name="type"]').is(':checked')==false) {
        e.preventDefault();
        alert("Please select phone or email"); 
    }
    else{
        var type = $("input[name='type']:checked").val();
        var value = $('input[name="info"]').val();
        if(type=='email' && !IsEmail(value)){
            e.preventDefault();
            alert('Plese enter correct email address')
        }
        else if(type=='phone' && !IsPhone(value)){
            e.preventDefault();
            alert('Phone number must be like 01*********');
        }
        
        console.log(type,value);
    }
});
});