<?php
    $sesssion=new Classes\ClassSessions();
    $sesssion->destructSessions();

    echo"<script>
            alert('Deslogado com sucesso!'); 
            window.location.href='".DIRPAGE."';
        </script>
    ";