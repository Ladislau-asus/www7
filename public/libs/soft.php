<?php

require_once('./inc/EasyPDO.php');
require_once('./inc/config.php');
require_once('./inc/functions.php');
require_once('./inc/request.php');

$table = $_GET['table'];
// ------------------------------------------------------------------------
$soft = $_GET['type'];
// ------------------------------------------------------------------------
$id = $_GET['id'];
$id = aes_decrypt($id);
// ------------------------------------------------------------------------
if (!isset($_GET['id']) || empty($_GET['type'])) {
    if ($_GET['table'] == "consignado") {
        header("Location: ./consignado.php");
        exit;
    } else if ($_GET['table'] == "consorcios") {
        header("Location: ./consorcios.php");
        exit;
    } else if ($_GET['table'] == "credito_pessoal") {
        header("Location: ./credito_pessoal.php");
        exit;
    }
}

$db = new database();

$results = get_search_table($db, $table, 'id', $id);

$results = $results[0];

// -----------------------------------------------
if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {

    get_soft_table($db, $table, $soft, 'id', $id);

    if ($_GET['table'] == "consignado") {
        header("Location: ./consignado.php");
        exit;
    } else if ($_GET['table'] == "consorcios") {
        header("Location: ./consorcios.php");
        exit;
    } else if ($_GET['table'] == "credito_pessoal") {
        header("Location: ./credito_pessoal.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $soft ?></title>
    <?php include('./php/assets.php') ?>
</head>

<body>
    <?php include('./php/header.php') ?>
    <div class="container">
        <div class="row">
            <?php if ($_GET['type'] == "view") { ?>
                <div style="width: 100%;" class="text-start my-3">
                    <a style="font-weight: bold;" class="btn btn-md text-light bg-success" href="./<?= $table ?>.php">Voltar</a>
                </div>
            <?php } ?>
            <?php if ($_GET['type'] == "delete" || $_GET['type'] == "restore") { ?>
                <section class="container">
                    <div class="row">
                        <div class="col p-5">
                            <h5 class="text-center">
                                Deseja
                                <?php
                                if ($soft == 'delete') {
                                    echo 'deletar';
                                } else if ($soft == 'restore') {
                                    echo 'restaurar';
                                }
                                ?>
                                o <?= $table ?> de
                                <strong>
                                    <?php

                                    if (isset($results['nome_completo'])) {
                                        echo $results['nome_completo'];
                                    } else if (isset($results['automovel'])) {
                                        echo $results['automovel'];
                                    } else if (isset($results['salario'])) {
                                        echo $results['salario'];
                                    }

                                    ?>
                                </strong>
                            </h5>
                            <div class="text-center mt-3">
                                <a href="consignado.php" class="btn btn-secondary">Não</a>
                                <a href="soft.php?table=<?= $table ?>&type=<?= $soft ?>&id=<?= aes_encrypt($results['id']) ?>&confirm=true" class="btn btn-primary">
                                    Sim
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <?php if ($_GET['table'] == "consignado" && $_GET['type'] == "view") { ?>
                <table class="table" style="margin-bottom: 0;">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>| Telefone</th>
                            <th>| Nascimento</th>
                        </tr>
                    </thead>
                    <tbody style="background: gray;">
                        <th><?= $results['nome_completo'] ?></th>
                        <th>| <?= $results['telefone'] ?></th>
                        <th>| 
                            <?php
                            if ($results['email'] == null) {
                                echo 'Sem Data nascimento';
                            } else {
                                echo str_replace('-', '/', $results['data_nascimento']);
                            }
                            ?>
                        </th>
                    </tbody>
                    <thead class="table-dark">
                        <tr>
                            <th>Nacionalidade</th>
                            <th>| Naturalidade</th>
                            <th>| CPF</th>
                        </tr>
                    </thead>
                    <tbody style="background: gray;">
                        <th><?= $results['nacionalidade'] ?></th>
                        <th>| <?= $results['naturalidade'] ?></th>
                        <th>| <?php
                                $cpf_array = explode('-', $results['cpf']);
                                if ($cpf_array[0] == 1) {
                                    $response = 'Valido';
                                } else {
                                    $response = 'Invalido';
                                }
                                echo '' . $response . ' - ' . $cpf_array[1] . '';
                                ?></th>
                    </tbody>
                    <thead class="table-dark">
                        <tr>
                            <th>Agencia</th>
                            <th>| Conta</th>
                            <th>| Valor</th>
                        </tr>
                    </thead>
                    <tbody style="background: gray;">
                        <th><?= substr_replace($results['agencia'], '-', -1, 0) ?></th>
                        <th>| <?= substr_replace($results['conta'], '-', -1, 0) ?></th>
                        <th>| R$ <?= number_format($results['valor'], 2, ',', '.') ?></th>
                    </tbody>
                </table>
                <table class="table" style="margin-bottom: 0;">
                    <thead class="table-dark">
                        <tr>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody style="background: gray;">
                        <th>
                            <?php
                            if ($results['email'] == null) {
                                echo 'Sem E-mail';
                            } else {
                                echo $results['email'];
                            }
                            ?>
                        </th>
                    </tbody>
                    <thead class="table-dark">
                        <tr>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody style="background: gray;">
                        <th>
                            <?= $results['descricao']; ?>
                            <?php if ($results['descricao'] != null) {
                                echo $results['descricao'];
                            } else {
                                echo 'Sem descrição';
                            } ?>
                        </th>
                    </tbody>
                </table>
                <table class="table mb-5">
                    <thead class="table-dark">
                        <tr>
                            <th>Data de solicitação</th>
                        </tr>
                    </thead>
                    <tbody style="background: gray;">
                        <th><?= str_replace('-', '/', $results['created_at']) ?></th>
                    </tbody>
                </table>
            <?php } ?>
            <?php if ($_GET['table'] == "consorcios" && $_GET['type'] == "view") { ?>
                <table class="table" style="margin-bottom: 0;">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>| CPF</th>
                            <th>| Telefone</th>
                            <th>| Tipo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="background: gray;">
                        <th><?= $results['nome_completo'] ?></th>
                        <th>| <?php
                                $cpf_array = explode('-', $results['cpf']);
                                if ($cpf_array[0] == 1) {
                                    $response = 'Valido';
                                } else {
                                    $response = 'Invalido';
                                }
                                echo '' . $response . ' - ' . $cpf_array[1] . '';
                                ?></th>
                        <th>| <?= $results['telefone'] ?></th>
                        <th>| <?= $results['tipo'] ?></th>
                        <th>| <?= $results['valor'] ?></th>
                    </tbody>
                </table>
                <table class="table mb-5">
                    <thead class="table-dark">
                        <tr>
                            <th>Data de solicitação</th>
                        </tr>
                    </thead>
                    <tbody style="background: gray;">
                        <th><?= str_replace('-', '/', $results['created_at']) ?></th>
                    </tbody>
                </table>
            <?php } ?>
            <?php if ($_GET['table'] == "credito_pessoal" && $_GET['type'] == "view") { ?>
                <table class="table" style="margin-bottom: 0;">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>| CPF</th>
                            <th>| Telefone</th>
                            <th>| credito</th>
                        </tr>
                    </thead>
                    <tbody style="background: gray;">
                        <th><?= $results['nome_completo'] ?></th>
                        <th>| <?php
                                $cpf_array = explode('-', $results['cpf']);
                                if ($cpf_array[0] == 1) {
                                    $response = 'Valido';
                                } else {
                                    $response = 'Invalido';
                                }
                                echo '' . $response . ' - ' . $cpf_array[1] . '';
                                ?></th>
                        <th>| <?= $results['telefone'] ?></th>
                        <th>| <?= $results['credito'] ?></th>
                    </tbody>
                </table>
                <table class="table mb-5">
                    <thead class="table-dark">
                        <tr>
                            <th>Data de solicitação</th>
                        </tr>
                    </thead>
                    <tbody style="background: gray;">
                        <th><?= str_replace('-', '/', $results['created_at']) ?></th>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
    <?php include('./php/footer.php') ?>

</html>