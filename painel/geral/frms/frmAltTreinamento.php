    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Treinamento';
$acaodoformulario = 'index.php?acao=alterar&ctrl=treinamento';
$avisodoformulario = 'Esta página você altera o treinamento';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Titulo','titulo','',true,'Aqui você um titulo para o treinamento.', $treinamentoForm->titulo);

$objForm->sk_formTextHTML('Descrição Treinamento','texto',true,'Aqui você alterar o texto.', $treinamentoForm->texto);

$objForm->sk_formFileCrop("Imagem",'imagem',false, 'Resolução sugerida - 626px X 626px', $treinamentoForm->imagem);

$objForm->sk_formTextUrl('Link treinamento','url','',false,'Aqui você adiciona o link do treinamento.', $treinamentoForm->url);

$objForm->sk_formData('Data treinamento','data_treinamento" style="width:100px;"',true,'Informe a data em que ocorrerá a live.',$objUteis->converteData($treinamentoForm->data_treinamento));

$objForm->sk_formHoras('Horário treinamento','horario_treinamento" style="width:100px;"',true,'Informe o horário em que ocorrerá a live.', $treinamentoForm->horario_treinamento);

$objForm->sk_formText('Instrutor','instrutor','',false,'Aqui você um instrutor.', $treinamentoForm->instrutor);

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.', $treinamentoForm->ordem);

//Status
$optionsDestaque[] = '<option value="1"'. ($treinamentoForm->destaque == 1 ? 'selected="selected"' : '' ).'>Destaque</option>';
$optionsDestaque[] = '<option value="0"'. ($treinamentoForm->destaque == 0 ? 'selected="selected"' : '' ).'>Normal</option>';

$objForm->sk_formSelect('Destaque', 'destaque', $optionsDestaque, false, 'Selecione uma opção');

//Status
$optionsStatus[] = '<option value="1"'. ($treinamentoForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($treinamentoForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $objUteis->converteDataHora($treinamentoForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($treinamentoForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($treinamentoForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($treinamentoForm->data_expiracao != 0 ? $objUteis->converteDataHora($treinamentoForm->data_expiracao) : ''));



//Cria um input hidden
$objForm->sk_formHidden('id',$treinamentoForm->id);
$objForm->sk_formHidden('imgAntiga',$treinamentoForm->imagem);

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
                $('#jcrop').attr('src', e.target.result).width(626),
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
            maxSize         : [ 626, 626 ],
            setSelect       : [ 0, 0, 626, 626 ],                       
            bgOpacity       : .3,
            borderOpacity   : .9,
            allowResize	: true,
            aspectRatio: 626/626
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