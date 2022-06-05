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
            success: function (response) {
                
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
    /*         Aviso Sobre Tecla CapsLock           */ 
    $("#senha").keypress(function(e){
        kc=e.keyCode?e.keyCode:e.which;
        sk=e.shiftKey?e.shiftKey:((kc==16)?true:false);
        if(((kc>=65 && kc<=90) && !sk)||(kc>=97 && kc<=122)&&sk){ $(".resultadoForm").html("Caps Lock Ligado"); }
        else{ $(".resultadoForm").empty(); }
    });

    
  