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
                <li><a href="javascript:void(0);" nome="" id="" class="comecar">Enyo Cavalcante</li>
                <li><a href="javascript:void(0);" nome="" id="" class="comecar">Jamile Solsa</li>
                <li><a href="javascript:void(0);" nome="" id="" class="comecar">Elana Moura</li>
                <li><a href="javascript:void(0);" nome="" id="" class="comecar">Natasha Lima</li>
            </ul>
        </div>        
                
        <div id="janelas">
        <?php for($i=0; $i<=3; $i++){?>    
            <div class="janela" id="jan_">
                <div class="topo" id="">
                    <span>Enyo Cavalcante</span>
                    <a href="javascript:void(0);" id="fechar">X</a>
                </div>
                
                <div id="corpo">
                    <div class="mensagens">
                        <ul class="listar"> 
                            <li><span>Enyo Cavalcante:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Jamile Solsa:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Enyo Cavalcante:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Jamile Solsa:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Enyo Cavalcante:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Jamile Solsa:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Enyo Cavalcante:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Jamile Solsa:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Enyo Cavalcante:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Jamile Solsa:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Enyo Cavalcante:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Jamile Solsa:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Enyo Cavalcante:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Jamile Solsa:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Enyo Cavalcante:</span><p>Olá, tudo bem?</p></li>
                            <li><span>Jamile Solsa:</span><p>Olá, tudo bem?</p></li>
                        </ul>
                    </div>
                    <input type="text" class="mensagem" id="" maxlength="255" />
                </div>
            </div>
        <?php } ?>
        </div>
        
       
    </body>
</html>
