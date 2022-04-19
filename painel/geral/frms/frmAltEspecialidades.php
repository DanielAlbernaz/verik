    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar o especialidade';
$acaodoformulario = 'index.php?acao=alterar&ctrl=especialidades';
$avisodoformulario = 'Esta página você altera o especialidade';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);
//Cria um input text
$objForm->sk_formText('Título','titulo','',true,'Aqui você um titulo para o banco.',$especialidadeForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você alterar o texto.',$especialidadeForm->texto);

$objForm->sk_formFileCrop("Imagem",'imagem',false, 'Resolução sugerida - 452px X 230px',$especialidadeForm->imagem);

for($i=0; $i < $categoriaEspecialidades['num']; $i++){    
    if($categoriaEspecialidades[$i]->id == $especialidadeForm->categoria_especialidades){             
        $nome = $categoriaEspecialidades[$i]->nome_categoria;
    }   
}   
$optionsPagina[] = '<option value="" ></option>';
$optionsPagina[] = '<option value='.$especialidadeForm->categoria_especialidades.' selected="selected" >'.$nome.'</option>';
foreach($categoriaEspecialidades as $key => $val){
    if($val->id <> NULL){
        if($val->id <> $especialidadeForm->categoria_especialidades){
            $optionsPagina[] = '<option value='.$val->id.'>'.$val->nome_categoria.'</option>';
        }       
    }   
}
$objForm->sk_formSelect('Categoria Especialidade', 'categoria_especialidades', $optionsPagina, true, 'Selecione uma categoria.');

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.',$especialidadeForm->ordem);
//Status
$optionsStatus[] = '<option value="1"'. ($especialidadeForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($especialidadeForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.' ,$objUteis->converteDataHora($especialidadeForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($especialidadeForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($especialidadeForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($especialidadeForm->data_expiracao != 0 ? $objUteis->converteDataHora($especialidadeForm->data_expiracao) : ''));



//Cria um input hidden
$objForm->sk_formHidden('id',$especialidadeForm->id);

$objForm->sk_formHidden('imgAntiga',$especialidadeForm->imagem);

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
                        $('#jcrop').attr('src', e.target.result).width(1000),
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
                    maxSize         : [ 1000, 667 ],
                    setSelect       : [ 0, 0, 1000, 667 ],                   
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1000/667
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