// main js
    /*==============================================*/
    /*          Retorno do root                     */ 
    function getRoot(){

        var root = window.location.protocol+"//"+document.location.hostname+"/github/My-Defaul-Php-Mvc/";
        return root;
    };

    //alert(getRoot());
    
    /*==============================================*/
    /*      Ajax do formulário de cadastro          */ 
    $("#formRegister").on("submit",function(event){
        event.preventDefault();
        var dados=$(this).serialize();

        $.ajax({
        url: getRoot()+'source/controllers/controllerRegister',
            type: 'post',
            dataType: 'json',
            data: dados,
            success: function (response) 
            {
                
                $('.retorno__reg').empty();

                if(response.retorno == 'erro'){

                    $.each(response.erros,function(key,value){
                    
                        $('.retorno__reg').append(value+'');
                    
                    });

                } else {
                    
                    $('.retorno__reg').append('Registro Realizado Com Sucesso!\n');
                    
                
                }
            }
        });
    });

     /*==============================================*/
    /*         Ajax do formulário de login          */ 
    $("#formLogin").on("submit",function(event){
        event.preventDefault();
        var dados=$(this).serialize();

        $.ajax({
        url: getRoot()+'source/controllers/controllerLogin',
            type: 'post',
            dataType: 'json',
            data: dados,
            success: function (response)
            {
                if(response.retorno == 'success')
                {
                    window.location.href=response.page;
                } else {
                        if(response.tentativas == true){
                            $('.loginFormulario').hide();  //Trava de segurança 
                        }
                        $('.result__form').empty();
                        $.each(response.erros, function(key, value){
                            $('.result__form').append(value+'<br>');
                        });
                } 
            }
        });
    });

     /*============================================== */
    /*  Ajax do formulário de confirmação de senha   */ 
    $("#formSenha").on("submit",function(event){
        event.preventDefault();
        var dados=$(this).serialize();

        $.ajax({
            url: getRoot()+'source/controllers/controllerSenha',
            type: 'post',
            dataType: 'json',
            data: dados,
            success: function (response) 
            {
                if(response.retorno == 'success')
                {
                    $('.retornoSenha').html("Link enviado com sucesso!");
                } else {
                        $('.retornoSenha').empty();
                        $.each(response.erros,function(key,value){
                            $('.retornoSenha').append(value+'');
                        });
                }
            }
        });
    });

    

    /*==============================================*/
    /*         Aviso Sobre Tecla CapsLock           */ 
    $("#senha").keypress(function(e){
        kc=e.keyCode?e.keyCode:e.which;
        sk=e.shiftKey?e.shiftKey:((kc==16)?true:false);
        if(((kc>=65 && kc<=90) && !sk)||(kc>=97 && kc<=122)&&sk){ $(".resultadoForm").html("Caps Lock Ligado"); }
        else{ $(".resultadoForm").empty(); }
    });

    
  