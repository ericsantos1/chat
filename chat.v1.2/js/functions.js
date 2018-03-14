/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
/*FUNÇÃO: CONSTRUIR JANELA DA CONVERSA*/

    /*funcao para criar as janelas dinamicas*/
    /*recebe os dados do contato como parametro, a qual desejo enviar uma mensagem*/
    function add_janelas(id, nome){
        
        /*cria uma variavel string com o HTML da jenela*/
        var html_add = "<div class='janela' id='jan_"+id+"'>"+
                "<div class='topo' id="+id+">"+
                    "<span>"+nome+"</span>"+
                    "<a href='javascript:void(0);' id='fechar'>x</a>"+
                "</div>"+                
                "<div id='corpo'>"+
                    "<div class='mensagens'>"+
                        "<ul class='listar'>"+
                            //mensagem                            
                        "</ul>"+
                    "</div>"+
                    "<input type='text' class='mensagem' id="+id+" maxlength='255' />"+
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
    
});

