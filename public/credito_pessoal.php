<?php

$results = '';
$info = '';

$placeholder = 'placeholder="* Campo Obrigatorio"';

require_once('../libs/inc/functions.php');


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
    $credito = $_POST['text_credito'];
    if ($credito == null) {
        die(send_response(1, 'Valor invalido'));
    }
    // -----------------------------------------------
    // PENDENCIAS
    // -----------------------------------------------
    require_once('../libs/inc/EasyPDO.php');
    require_once('../libs/inc/config.php');

    $bd = new database();

    $params = [
        ':nome' => $nome,
        ':cpf' => $cpf,
        ':telefone' => $telefone,
        ':credito' => $credito,
    ];

    $bd->EXE_NON_QUERY(
        "INSERT INTO credito_pessoal VALUES(
                0,
                :nome,
                :cpf,
                :telefone,
                :credito,
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
    $info = 'Crédito Pessoal Enviado Com Sucesso!';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAUDECI | CRED CRÉDITO PESSOAL</title>
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
                <form action="./credito_pessoal.php" method="POST">
                    <div class="alert alert-warning p-2 text-center">
                        <span style="font-weight: bold; font-size: larger;">Não use caracteres especiais em campos obrigatórios</span>
                    </div>
                    <div class="mb-3">
                        <label for="">Nome Completo</label>
                        <input maxlength="30" type="text" <?= $placeholder ?> class="form-control" name="text_nome_completo">
                        <label for="">CPF</label>
                        <input maxlength="11" type="text" <?= $placeholder ?> class="form-control" name="text_cpf">
                        <label for="">Telefone para contato com (DDD) </label>
                        <input maxlength="11" type="text" <?= $placeholder ?> class="form-control" name="text_telefone">
                        <div class="input-group my-3">
                            <label class="input-group-text" for="inputGroupSelect01">Tipo de Crédito</label>
                            <select name="text_credito" class="form-select" id="inputGroupSelect01">
                                <option selected value="Crédito Salário">Crédito Salário</option>
                                <option selected value="Crédito benefício">Crédito benefício</option>
                                <option selected value="Crédito Automático">Crédito Automático</option>
                                <option selected value="Antecipação 13º salário">Antecipação 13º salário</option>
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
</body>

</html>