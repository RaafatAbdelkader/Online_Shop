
$(document).ready(function() {
    
    $(function() {

        $("#submit").click(function(){
            var form_inputs= $(".f_input");
            var num=form_inputs.length;
            var inp_value=true;
            for(var i=0;i<num;i++){
                var input= form_inputs[i];
                if(input.value.length==0){
                    inp_value=false;
                }
            }
            if(inp_value){
                username= form_inputs[0].value;
                password= form_inputs[1].value;
                $.post("ajax_login.php",{"username":username,"password":password},function(output){
                    if (output=="success"){
                        $("#msg").attr('class','alert alert-success shadow text-center').html("welcome "+username);
                        setTimeout(function() {
                            window.location.href = "index.php"; 
                        }, 500);
                    }else{
                        $("#msg").parent().removeClass("register");
                        $("#msg").attr('class','alert alert-danger shadow text-center').html(output);
                        setTimeout(function() {
                            $("#msg").attr('class','alert alert-success shadow text-center')
                            .html("Please sign in!");
                        }, 1500);
                    }
                   
                })
            }else{
                
                $("#msg").attr('class','alert alert-danger shadow text-center')
                .html("Bitte geben Sie gültige Logindaten ein!");
                setTimeout(function() {
                    $("#msg").attr('class','alert alert-success shadow text-center')
                    .html("Please sign in!");
                }, 1500);
            }
        })
    })
});
