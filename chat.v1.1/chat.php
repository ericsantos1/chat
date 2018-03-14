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
        <title>Bem vindo ao chat</title>
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="js/chat.js"></script>
        <script src="js/functions.js"></script>
    </head>
    <body>        
       
        <div id="contatos">
            <ul>
                <?php                
                    $selecionar_contatos = BD::conn()->prepare("SELECT * FROM `usuarios` WHERE id != ?");
                    $selecionar_contatos->execute(array($_SESSION['id_user']));
                    if($selecionar_contatos->rowCount()==0){
                        echo '<p>Ainda não ha contatos</p>';
                    }else{
                        while ($contato = $selecionar_contatos->fetchObject()){                   
                ?>
                <li><a class='comecar' href="javascript:void(0);" nome="<?php echo $contato->nome; ?>" id="<?php echo $contato->id; ?>"><?php echo $contato->nome; ?></a></li>                
                    <?php }}?>
            </ul>
        </div>        
                
        <div id="janelas">
        
            
       
        </div>
        
       
    </body>
</html>
