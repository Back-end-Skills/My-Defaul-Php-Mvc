
<h1 style="margin: 3rem auto 4rem auto; text-align:center">Entrar</h1>

<div style="margin-top:3rem; display: flex; align-items: center; justify-content:center;">  

    <form  action="" name="formLogin" id="formLogin" method="post">

        <div class="result__form"></div>
        <input name="email" type="email" id="email" placeholder="Seu Email" required><br><br>
        <input name="senha" type="password" id="senha" placeholder="Sua Senha" required><br><br>

        <button type="submit" >Entrar</button><br><br>
        
        <a href="<?php echo DIRPAGE.'recover-password'; ?>">Esqueci minha senha</a>

    </form>

</div>

<script src="<?= DIRJS.'zepto.min.js'; ?>"></script>
<script src="<?= DIRJS.'main.js'; ?>"></script>
