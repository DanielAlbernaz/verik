<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar descrição do produto';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=descricao';
$avisodoformulario = 'Esta página você cadastra a descrição do produto.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formTextPequeno('Cód. Produto','codigo_produto" onchange="pesquisaProduto(this.value); ','',true,'Aqui você informa o código do produto.');

echo"<div class='formRow' id='produto' style='display:none;'>";
echo"</div>";

$objForm->sk_formTextHTML('Especificações do produto','descricao',true,'Aqui você escreve as especificações do produto.');


//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>

<script>

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