/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    //array para armazenar o id das janelas abertas
    var janelas = new Array();
    //quando uma janela de conversa é fechada, é preciso tirar o id do array
    //mas, após o tal is da janela fechada for removido do array. o indice do mesmo 
    //vai ficar indeterminado(espaço em branco)
    //por isso é preciso apagar o indice e automaticamente ré-ordenar o array.. 
    Array.prototype.clean = function(deleteValue){
        for(var i=0;i<this.length;i++){
            if(this[i]==deleteValue){
                this.splice(i, 1);
                i--;
            }
        }
    }
            
/*FUNÇÃO: CONSTRUIR JANELA DA CONVERSA*/

    /*funcao para criar as janelas dinamicas*/
    /*recebe os dados do contato como parametro, a qual desejo enviar uma mensagem*/
    function add_janelas(id, nome){
        
        /*cria uma variavel string com o HTML da jenela*/
        var html_add = "<div class='janela' id='jan_"+id+"'>"+
                "<div class='topo' id='"+id+"'>"+
                    "<span>"+nome+"</span>"+
                    "<a href='javascript:void(0);' id='fechar'>x</a>"+
                "</div>"+                
                "<div id='corpo'>"+
                    "<div class='mensagens'>"+
                        "<ul class='listar'>"+
                            //mensagem                            
                        "</ul>"+
                    "</div>"+
                    "<input type='text' class='mensagem' id='"+id+"' maxlength='255' />"+
                "</div>"+
            "</div>";
        $('#janelas').append(html_add);
    }    

/*FUNÇÃO: ABRIR JANELA DA CONVERSA*/

    /*quando a class 'comecar' receber um click
     *pega-se o valor de um atributo dessa class, 
     *no caso, pega o valor do atributo 'id' e 'nome'*/
    $('.comecar').live('click', function(){
        
        var id = $(this).attr('id');
        var nome = $(this).attr('nome');
        //colocando id do usuario dentro do Array.
        janelas.push(id);
        
        janelas.clean(undefined);
        //exibindo os id do Array
        alert(janelas);
        
        /*chamando a função 'add_janelas' e remove a class 'comecar' para se 
         * um contato receber mais de 1 click não abrir outra jenela do mesmo*/
        add_janelas(id, nome);
        $(this).removeClass('comecar');
        return false;
    });
    
/*FUNÇÃO: FECHAR JANELA DA CONVERSA*/
    
    $('#fechar').live('click', function(){
        var id = $(this).parent().attr('id');
        var parent = $(this).parent().parent().hide()        
        $('#contatos a#'+id+'').addClass('comecar');
        
        //salvando a quantidade de itens do array em uma var
        var n = janelas.length;
        //percorrendo array
        for(i=0;i<n;i++){
            //verificando se existe o tal id no array
            if(janelas[i]!=undefined){
                //se ele existir, verifica se o mesmo é igual ao id da janela
                if(janelas[i]==id){
                    //deleta o id do array
                    delete(janelas[i]);
                    //alert(janelas);
                }
            }
        }
        
    });
 
/*FUNÇÃO: MINIMIZAR JANELA DA CONVERSA*/
    
    $('body').delegate('.topo', 'click', function(){
        var pai = $(this).parent();
        var isto = $(this);
        //verifica se a div do corpo da conversa esta oculta(hidden)
        if(pai.children('#corpo').is(':hidden')){
            isto.removeClass('fixar');
            pai.children('#corpo').toggle(100);           
        }else{
            isto.addClass('fixar');    
            pai.children('#corpo').toggle(100);
        }        
    })
    
/*FUNÇÃO: ATUALIZAR JANELA DA CONVERSA*/

    setInterval(function(){
        $.post("sys/chat.php",{
            
            acao: 'atualizar',
            array: janelas
           /* recebendo o retorno do arquivo PHP, um array conjvertido para JS
            * veja a linha 58 de sys/chat.php */ 
        },function(x){
            if(x != ''){
                //for(i=0;i<n;i++){
                    //percorrendo o array
                    for(i in x){
                        //acessando os valores(mensagens) porm meio da chave relacionada 'i'
                        //e imprimindo dentro da tag HTML
                        $('#jan_'+i+' ul').html(x[i]);
                    }
                //}
            }
            //definindo qual deve ser o tipo de retorno do arquivo PHP
         }, 'jSON');
    }, 2000);
    
});

