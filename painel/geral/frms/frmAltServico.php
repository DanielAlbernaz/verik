    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Serviço';
$acaodoformulario = 'index.php?acao=alterar&ctrl=servico';
$avisodoformulario = 'Esta página você altera o serviço .';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formFileCrop("Banner",'imagem',false,'Tamanho da imagem do banner 679px x 131px',$servicoForm->imagem);

//Cria um input text
$objForm->sk_formText('Titulo','titulo','',true,'Aqui você altera o titulo do banner.',$servicoForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.', $servicoForm->texto);

$objForm->sk_formText('Texto botão','texto_botao','',false,'Aqui você coloca um titulo para o banner.', $servicoForm->texto_botao);

$objForm->sk_formText('Link botão','url','',false,'Link de redirecionamento para o botão.' ,$servicoForm->url);

$optionsAba[] = '<option value="1"'. ($servicoForm->abrir_mesma_aba == 1 ? 'selected="selected"' : '' ).'>Não</option>';
$optionsAba[] = '<option value="0"'. ($servicoForm->abrir_mesma_aba == 0 ? 'selected="selected"' : '' ).'>Sim</option>';

$objForm->sk_formSelect('Abrir link na mesma aba?', 'abrir_mesma_aba', $optionsAba, true, 'Selecione uma opção');

$optionsPosition[] = '<option value="1"'. ($servicoForm->exibir_conteudo == 1 ? 'selected="selected"' : '' ).'>Inferior</option>';
$optionsPosition[] = '<option value="0"'. ($servicoForm->exibir_conteudo == 0 ? 'selected="selected"' : '' ).'>Superior</option>';

$objForm->sk_formSelect('Exibir conteúdo', 'exibir_conteudo', $optionsPosition, true, 'Selecione uma opção');

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.',$servicoForm->ordem);

//Status
$optionsStatus[] = '<option value="1"'. ($servicoForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($servicoForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $servicoForm->dhcadastro);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($servicoForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($servicoForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($servicoForm->data_expiracao != 0 ? $objUteis->converteDataHora($servicoForm->data_expiracao) : ''));


//Cria um input hidden
$objForm->sk_formHidden('id',$servicoForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$servicoForm->imagem);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>


<!-- Script para recorte da imagem. É necessário colocar esse script em todos os formulários que forem utilizar recorte para que seja informado o tamanho da imagem -->
<script>

            $( "#img" ).click(function() {
                $("#jcrop").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview .formRight").append("<img id='jcrop'/>");
            });

            function preview(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        $('#jcrop').attr('src', e.target.result).width(679),
                        cropImg()
                    };
                    reader.readAsDataURL(input.files[0]);                    
                    $(".imgPreview").show();
                }
            }; 

            function cropImg(){        
                $('#jcrop').Jcrop({
                    onChange: exibePreview,
                    onSelect: exibePreview,
                    bgColor         : 'white',
                    minSize         : [ 100, 100 ],
                    maxSize         : [ 679, 131 ],
                    setSelect       : [ 0, 0, 679, 131 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 679/131
                });        
            };

            function exibePreview(c){            
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#x2').val(c.x2);
                $('#y2').val(c.y2);
                $('#w').val(c.w);
                $('#h').val(c.h);
            };    

</script>