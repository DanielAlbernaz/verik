<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar produto destaque';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=destaque';
$avisodoformulario = 'Esta página você cadastra os produtos destaques.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formTextPequeno('Cód. Produto','codigo_produto" onchange="pesquisaProduto(this.value); ','',true,'Aqui você informa o código do produto.');

echo"<div class='formRow' id='produto' style='display:none;'>";
echo"</div>";

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.');

//Cria status
$optionsAba[] = '<option value=""></option>';
$optionsAba[] = '<option value="1" selected="selected">Ativo</option>';
$optionsAba[] = '<option value="0">Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsAba, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.');

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.');

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.');


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