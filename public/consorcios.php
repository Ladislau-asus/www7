<?php

$results = '';
$info = '';

$placeholder = 'placeholder="* Campo Obrigatorio"';

require_once('./libs/inc/functions.php');

// -----------------------------------------------
// REQUEST DA FUNÇÃO
// -----------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['text_nome_completo'];
    if (($nome == null) || verify_number($nome)) {
        die(send_response(1, 'Campo nome vazio'));
    }
    $nome = word_case_pre($nome);
    // -----------------------------------------------
    $cpf = $_POST['text_cpf'];
    if (strlen($cpf) < 11) {
        die(send_response(1, 'CPF invalido'));
    }
    $cpf = format_cpf($cpf, $cpf);
    // -----------------------------------------------
    $telefone = $_POST['text_telefone'];
    $telefone = format_tel($telefone);
    if ($telefone == false) {
        die(send_response(1, 'Numero de Telefone invalido'));
    }
    // -----------------------------------------------
    $tipo = $_POST['text_tipo'];
    if (($tipo == null ) || verify_number($tipo)) {
        die(send_response(1, 'Tipo de solicitação vazio'));
    }
    // -----------------------------------------------
    $valor = $_POST['text_valor'];
    if (verify_number($valor)) {
        die(send_response(1, 'Produto vazio'));
    }
    // -----------------------------------------------
    // PENDENCIAS
    // -----------------------------------------------
    require_once('./libs/inc/EasyPDO.php');
    require_once('./libs/inc/config.php');

    $bd = new database();

    $params = [
        ':nome' => $nome,
        ':cpf' => $cpf,
        ':telefone' => $telefone,
        ':tipo' => $tipo,
        ':valor' => $valor,
    ];

    $bd->EXE_NON_QUERY(
        "INSERT INTO consorcios VALUES(
                0,
                :nome,
                :cpf,
                :telefone,
                :tipo,
                :valor,
                NOW(), 
                NOW(), 
                NULL
            )",
        $params
    );

    echo '<style>form {display: none!importante;}</style>';
    header("Refresh: 5; index.php");
    
    $results = true;
    $color = 'success';
    $info = 'Consórcio Enviado Com Sucesso!';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAUDECI | CRED CONSÓRCIOS</title>
    <link rel="stylesheet" href="../assets/reset.min.css">
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <style>
        .form-control::placeholder {
            color: red;
        }
    </style>
</head>

<body>
    <section class="container">
        <div class="row my-5">
            <div class="col-sm-6 offset-sm-3 card bg-light p-4">
                <form action="./consorcios.php" method="POST">
                    <div class="alert alert-warning p-2 text-center">
                        <span style="font-weight: bold; font-size: larger;">Não use caracteres especiais em campos obrigatórios</span>
                    </div>
                    <div class="mb-3">
                        <label for="">Nome Completo</label>
                        <input maxlength="30" type="text" <?= $placeholder ?> class="form-control" name="text_nome_completo">
                        <label for="">CPF</label>
                        <input maxlength="11" type="number" <?= $placeholder ?> class="form-control" name="text_cpf">
                        <label for="">Telefone para contato com (DDD)</label>
                        <input maxlength="11" type="text" <?= $placeholder ?> class="form-control" name="text_telefone">
                        <div class="input-group my-3">
                            <label class="input-group-text" for="inputGroupSelect01">Tipo de Consórcio</label>
                            <select id="tipo" name="text_tipo" class="form-select" id="inputGroupSelect01">
                                <option selected value="0">--------</option>
                                <option value="automovel">Automóvel</option>
                                <option value="imovel">Imóvel</option>
                                <option value="eletrodomesticos">Eletrodomésticos</option>
                            </select>
                        </div>
                        <div id="campos-adicionail-2" class="input-group my-3" style="display: none;">
                            <span class="input-group-text" id="basic-addon1">Imóvel</span>
                            <input maxlength="60" type="text" class="form-control" <?= $placeholder ?> name="text_valor" aria-describedby="basic-addon1">
                        </div>
                        <div id="campos-adicionail-3" class="input-group my-3" style="display: none;">
                            <span class="input-group-text" id="basic-addon1">Eletrodomésticos</span>
                            <input maxlength="60" type="text" class="form-control" <?= $placeholder ?> name="text_valor" aria-describedby="basic-addon1">
                        </div>
                        <div id="campos-adicionail-1" class="input-group my-3" style="display: none;">
                            <label class="input-group-text" for="inputGroupSelect01">Automóveis</label>
                            <select name="text_valor" class="form-select" id="inputGroupSelect01">
                                <option selected value="Motos">Motos</option>
                                <option value="Carros">Carros</option>
                                <option value="Caminhões">Caminhões</option>
                                <option value="Tratores">Tratores</option>
                            </select>
                        </div>
                    </div>
                    <?php if ($results == true) { ?>
                        <div class="alert alert-<?= $color ?> p-2 text-center">
                            <?= $info ?>
                        </div>
                    <?php } ?>
                    <div class="row mb-3">
                        <div class="col text-start">
                            <a class="btn btn-md btn-success" href="index.php">Voltar</a>
                        </div>
                        <div class="col text-end">
                            <input class="btn btn-md btn-success" type="submit" value="Enviar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="../assets/bootstrap.bundle.min.js"></script>
    <script>
        const tipoSelect = document.getElementById('tipo');
        const camposAdicionail1 = document.getElementById('campos-adicionail-1');
        const camposAdicionail2 = document.getElementById('campos-adicionail-2');
        const camposAdicionail3 = document.getElementById('campos-adicionail-3');

        tipoSelect.addEventListener('change', function() {
            if (tipoSelect.value === 'automovel') {
                camposAdicionail1.style.display = 'flex';
                camposAdicionail2.style.display = 'none';
                camposAdicionail3.style.display = 'none';
            }
            if (tipoSelect.value === 'imovel') {
                camposAdicionail1.style.display = 'none';
                camposAdicionail2.style.display = 'flex';
                camposAdicionail3.style.display = 'none';
            }
            if (tipoSelect.value === 'eletrodomesticos') {
                camposAdicionail1.style.display = 'none';
                camposAdicionail2.style.display = 'none';
                camposAdicionail3.style.display = 'flex';
            }
            if (tipoSelect.value === '0') {
                camposAdicionail1.style.display = 'none';
                camposAdicionail2.style.display = 'none';
                camposAdicionail2.style.display = 'none';
            } else {
            }
        });
    </script>
</body>

</html>