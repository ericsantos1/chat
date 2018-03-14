<?php
// put your code here

session_start();

require_once '../config.php';
require_once '../classes/BD.class.php';
BD::conn();

    
$acao = $_POST['acao'];

switch($acao){
    case inserir:
        $para = $_POST['para'];
        $mensagem = strip_tags($_POST['mensagem']);
        
        $pegar_nome = BD::conn()->prepare("SELECT nome FROM `usuarios` WHERE id = ?");
        $pegar_nome->execute(array($_SESSION['id_user']));
        $ft = $pegar_nome->fetchObject();
        
        $inserir = BD::conn()->prepare("INSERT INTO `mensagens` (id_de, id_para, mensagem, data) VALEUS(?,?,?,NOW())");
        if($inserir->execute(array($_SESSION['id_user'], $para, $mensagem))){
            echo '<li><span>'.$ft->nome.'</span><p>'.$mensagem.'</p></li>';
        }
    break;

    case 'atualizar':
        
}


?>
