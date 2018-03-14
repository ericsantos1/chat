<?php
// put your code here

session_start();

require_once 'config.php';
require_once 'classes/BD.class.php';
BD::conn();

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>        
        
        <?php       
        
        //verificando se o formulario foi submetido
        if(isset($_POST['acao']) && $_POST['acao'] == 'logar'):
            //filtrando as strings do POST
            $email = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
            // ou simplesmente
            //$email = $_POST['email'];
            if ($email == ""){}else{
                //preparando uma query
                $pegar_user = BD::conn()->prepare("SELECT id FROM `usuarios` WHERE email = ?");
                //executando a query
                $pegar_user->execute(array($email));
                //verificando se existe registros
                if($pegar_user->rowCount()==0){
                    echo "<script>"
                            . ""
                            . "alert('usuario não encontrado');"
                            . ""
                            . "</script>";
                }else{
                    //se existir um registro correspondente
                    //pegando o objeto com o resultado da query
                    $fetch = $pegar_user->fetchObject();
                    //inserindo o resultado na sessão
                    $_SESSION['id_user'] = $fetch->id;
                    
                    echo "<script>"
                            . ""
                            . "alert('logado com sucesso!');location='chat.php';"
                            . ""
                            . "</script>";
                }                
            }
        
        endif;
        
        ?>
        
        <div id="formulario">
            <form action="" method="post" enctype="multipart/form-data">            
                <label>
                    <input type="text" name="email"/> 
                </label>                                            
                <input type="hidden" name="acao" value="logar">
                <input type="submit" name="logar" value="Entrar">                
            </form>
        </div>
        
    </body>
</html>
