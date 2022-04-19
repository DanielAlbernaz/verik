    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar descrição do produto';
$acaodoformulario = 'index.php?acao=alterar&ctrl=descricao';
$avisodoformulario = 'Esta página você altera a descrição do produto';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);


$objForm->sk_formTextPequeno('Cód. Produto','codigo_produto" onchange="pesquisaProduto(this.value); ','',true,'Aqui você informa o código do produto.',$destaqueForm->codigo_produto);

echo"<div class='formRow' id='produto' style='display:none;'>";
echo"</div>";

$objForm->sk_formTextHTML('Especificações do produto','descricao',true,'Aqui você escreve as especificações do produto.',$destaqueForm->descricao);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($destaqueForm->dhcadastro));
        

//Cria um input hidden
$objForm->sk_formHidden('id',$destaqueForm->id);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>

<script>
    var codigo = $('#codigo_produto').val();

    $( document ).ready(function() {
        $.ajax({
                url: '../sistema/index.php?acao=pesquisaProduto&ctrl=destaque',
                dataType: 'json',
                type: 'POST',
                data: {codigo:codigo},
                success: function(obj){
                    if(obj.situacao=="sucess"){
                        $('#produto').html('');
                        $('#produto').show();
                        var html = '';
				 
                        html +='<label>Descrição Produto</label>';                     
                        html +='<div class="formRight">';
                        html +='<label>'+ obj.codigo +'</label>';
                        html +='</div>';   
                        html +='<div class="clear"></div>'; 

                        $('#produto').append(html);


                    } else if(obj.situacao=="error"){

                        $('#produto').hide();
                    }
                },
                error : function (XMLHttpRequest, textStatus, errorThrown) {

                },

                beforeSend : function(requisicao){
                }
            });
    });

    function pesquisaProduto(codigo){
        // console.log(codigo);
        
        $.ajax({
                url: '../sistema/index.php?acao=pesquisaProduto&ctrl=destaque',
                dataType: 'json',
                type: 'POST',
                data: {codigo:codigo},
                success: function(obj){
                    if(obj.situacao=="sucess"){
                        $('#produto').html('');
                        $('#produto').show();
                        var html = '';
				 
                        html +='<label>Descrição Produto</label>';                     
                        html +='<div class="formRight">';
                        html +='<label>'+ obj.codigo +'</label>';
                        html +='</div>';   
                        html +='<div class="clear"></div>'; 

                        $('#produto').append(html);


                    } else if(obj.situacao=="error"){

                        $('#produto').css('display', 'none');
                    }
                },
                error : function (XMLHttpRequest, textStatus, errorThrown) {

                },

                beforeSend : function(requisicao){
                }
            });

    }
</script>