<!DOCTYPE html>
<html lang="pr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Criar um Nova Conta | MVC PHP</title>
</head>
<body>
    
    <header>
    
    <h1 style="margin: 3rem auto 4rem auto;text-align:center">Register</h1>
    </header>

    <div style="display:flex; justify-content:center; align-items:center">
    
      
        
            <!-- START form de Cadastro-->
            <form action="<?php echo DIRPAGE.'source/controllers/controllerRegister'; ?> " name="formRegister" id="formRegister" method="post" >				
                                        
                <div class="retorno__reg"></div>
                <input type="text" name="nome"  id="nome" placeholder="Nome"  required><br><br>
                <input type="email" name="email"  id="email" placeholder="meuemail@gmail.com"  required><br><br>			  
                                            
                <input type="password" name="senha"  id="senha" placeholder="Crie Uma Senha" required><br><br>
                <input type="password" name="senhaConfirmacao"  id="senhaConfirmacao" placeholder="Confirme Sua Senha"  required><br><br>
                                        
                <button type="submit" class="btn">Registrar</button><br>
                <a href="<?php echo DIRPAGE.'login'; ?>" >Entrar</a><br>
                                    
            </form>

    </div>

    <script src="<?php echo DIRJS.'zepto.min.js'; ?>"></script>
    <script src="<?php echo DIRJS.'main.js'; ?>"></script>

    </body>
</html>    