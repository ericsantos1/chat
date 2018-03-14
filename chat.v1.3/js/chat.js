/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    $('body').delegate('.mensagem', 'keydown', function(e){
        var campo = $(this);
        var mensagem = campo.val();
        var to = campo.attr('id');
        
        if(e.keyCode == 13){
            
            if(mensagem != ''){
                $.post('sys/chat.php',{
                    acao: 'inserir',
                    mensagem: mensagem,
                    para: to
                }, function(retorno){
                    $('#jan_'+to+' ul.listar').append(retorno);
                    campo.val('');
                });
            }
        
        }
        
    });
    
});


