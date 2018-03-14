<?php
// put your code here

session_start();

require_once '../config.php';
require_once '../classes/BD.class.php';
BD::conn();

    
$acao = $_POST['acao'];

switch($acao){
      
    case 'inserir':
        //capiturando o destinatario
        $para = $_POST['para'];
        //capiturando a mensagem
        $mensagem = strip_tags($_POST['mensagem']);
        //capiturando o nome do remetente por meio do id
        $pegar_nome = BD::conn()->prepare("SELECT nome FROM `usuarios` WHERE id = ?");
        $pegar_nome->execute(array($_SESSION['id_user']));
        $ft = $pegar_nome->fetchObject();
        
        $inserir = BD::conn()->prepare("INSERT INTO `mensagens` (id_de, id_para, mensagem, data) VALUES(?,?,?,NOW())");
        if($inserir->execute(array($_SESSION['id_user'], $para, $mensagem))){
            echo '<li><span>'.$ft->nome.'</span><p>'.$mensagem.'</p></li>';
        }
    break;

    case 'atualizar':
        $array = $_POST['array'];
        if($array != ''){
            
            //percorrer array para pegar os IDS de cada janela
            foreach($array as $indice =>$id){
                //2 circunstancias, o usuario envia mensagem ou recebeu mensagem
                $selecionar = BD::conn()->prepare("SELECT * FROM `mensagens` WHERE id_de = ? AND id_para = ? OR id_de = ? AND id_para = ?");
                $selecionar->execute(array($_SESSION['id_user'], $id, $id, $_SESSION['id_user']));
                //variavel para concatenar os valores de cada mensagerm para jenela da conversa
                $mensagem = '';
                ////percorredo o objeto com os arrays e SALvando dentro da Var '$ft'
                while($ft=$selecionar->fecthObject()){
                    //recuperar o nome de quem está mandando as mensagens
                    $nome =  BD::conn()->prepare("SELECT nome FROM `usuarios` WHERE id = ?");
                    $nome->execute(array($ft->id_de));
                    $name = $nome->fetchObject();
                    // variavel vazia será concatenada com os valores                    
                    //$ft->mensagem --->TABELA MENSAGENS ---> veja a linha 36-41
                    //$name->nome ----->TABELA USUARIOS  ---> veja a linha 42-45                                 
                    $mensagem .= '<li><span>'.$name->nome.' disse:</span><p>'.$ft->mensagem.'</p></li>';
                }
                /*
                 * criando um array relacional. as chaves do array serão
                 * id e o valor do mesmo será a mensagem.
                 */
                $new[$id] = $mensagem;
                //Array em formato PHP. Precisa converter para o formato JS
            }
            //Convertendo o Array PHP para JS
            $new = json_encode($new);
            /*
             * retorna o array convertido para o arquivo JS quando este envia os dados para cá.
             * veja a linha 114 de js/functions
             */
            echo $new;
        }else{
            echo '';
        }
        break;
}


?>
