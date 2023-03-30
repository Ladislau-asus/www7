<?php

// -----------------------------------------------
// IMPLEMENTO PRINT // REQUER 1 VALOR (VARIAVEL)
// -----------------------------------------------
function p_data($data, $die = true)
{
    echo '<style>overflow: auto;</style>';
    echo '<pre>';
    if (is_object($data) || is_array($data)) {
        print_r($data);
    } else {
        echo $data;
    }

    if ($die) {
        die(PHP_EOL . 'TERMINDADO' . PHP_EOL);
    }
}
// -----------------------------------------------
// IMPLEMENTO HASH // REQUER 1 VALOR (TAMANHO)
// -----------------------------------------------
function function_hash_random($size)
{
    $hash_code = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $hash_html = '';
    for ($i = 0; $i < $size; $i++) {
        $hash_html .= $hash_code[rand(0, strlen($hash_code) - 1)];
    }
    return $hash_html;
}
// -----------------------------------------------
// KEYS AES
// -----------------------------------------------
define('AES_KEY', 'rgkC5MS2zE7aM2z1BFn6URVhcSLv3z4P');
define('AES_IV', 'Ti2nmtV1qsNLqpdK');
// -----------------------------------------------
// AES ENCRYPT // ENCRIPT UM VALOR 'AES' // REQUER 1 VALOR (VARIAVEL)
// -----------------------------------------------
function aes_encrypt($value)
{
    return bin2hex(openssl_encrypt($value, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
}
// -----------------------------------------------
// AES DECRYPT // DESENCRYPTA UM VALOR 'AES' // REQUER 1 VALOR (VARIAVEL)
// -----------------------------------------------
function aes_decrypt($value)
{

    if (strlen($value) % 2 != 0) {
        return -1;
    }

    return openssl_decrypt(hex2bin($value), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
}
// -----------------------------------------------
// CASO UMA VARIAVEL NÃO TENHA APENAS NUMEROS RETORNA FALSO
// -----------------------------------------------
function verify_number($var)
{
    if (is_numeric($var)) {
        return true;
    } else {
        return false;
    }
}
// -----------------------------------------------
// FORMATA UM NUMERO DE TELEFONE
// -----------------------------------------------
function format_tel($phone_number) {
    $phone_number = preg_replace('/[^0-9]/', '', $phone_number); // Remove caracteres não-numéricos
    $length = strlen($phone_number);

    if ($length === 10) { // Formatação para números de telefone com 10 dígitos
        $formatted_number = sprintf("(%s) %s-%s", substr($phone_number, 0, 2), substr($phone_number, 2, 4), substr($phone_number, 6, 4));
    } elseif ($length === 11) { // Formatação para números de telefone com 11 dígitos
        $formatted_number = sprintf("(%s) %s%s-%s", substr($phone_number, 0, 2), substr($phone_number, 2, 5), substr($phone_number, 7, 1), substr($phone_number, 8, 4));
    } else { // Número de telefone inválido
        return false;
    }

    return $formatted_number;
}
// -----------------------------------------------
// FORMATA UM CPF
// -----------------------------------------------
function format_cpf($cpf, $base)
{
    $cpf = "$cpf";
    if (strpos($cpf, "-") !== false) {
        $cpf = str_replace("-", "", $cpf);
    }
    if (strpos($cpf, ".") !== false) {
        $cpf = str_replace(".", "", $cpf);
    }
    $sum = 0;
    $cpf = str_split($cpf);
    $cpftrueverifier = array();
    $cpfnumbers = array_splice($cpf, 0, 9);
    $cpfdefault = array(10, 9, 8, 7, 6, 5, 4, 3, 2);
    for ($i = 0; $i <= 8; $i++) {
        $sum += $cpfnumbers[$i] * $cpfdefault[$i];
    }
    $sumresult = $sum % 11;
    if ($sumresult < 2) {
        $cpftrueverifier[0] = 0;
    } else {
        $cpftrueverifier[0] = 11 - $sumresult;
    }
    $sum = 0;
    $cpfdefault = array(11, 10, 9, 8, 7, 6, 5, 4, 3, 2);
    $cpfnumbers[9] = $cpftrueverifier[0];
    for ($i = 0; $i <= 9; $i++) {
        $sum += $cpfnumbers[$i] * $cpfdefault[$i];
    }
    $sumresult = $sum % 11;
    if ($sumresult < 2) {
        $cpftrueverifier[1] = 0;
    } else {
        $cpftrueverifier[1] = 11 - $sumresult;
    }
    $returner = false;
    if ($cpf == $cpftrueverifier) {
        $returner = true;
    }


    $cpfver = array_merge($cpfnumbers, $cpf);

    if (count(array_unique($cpfver)) == 1 || $cpfver == array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0)) {

        $returner = false;
    }
    return "$returner - $base";
}

// -----------------------------------------------
// PRIMEIRA LETRA DE CADA PALAVRA MAIUSCULA (Sem Preposições) // REQUER 1 VALOR (VARIAVEL)
// -----------------------------------------------
function word_case_pre($string)
{
    $prepositions = array('a', 'ao', 'aos', 'à', 'às', 'ante', 'após', 'com', 'contra', 'de', 'do', 'dos', 'da', 'das', 'desde', 'durante', 'em', 'entre', 'para', 'perante', 'por', 'sem', 'sob', 'sobre', 'trás');
    $words = explode(' ', strtolower($string));
    foreach ($words as &$word) {
        if (!in_array($word, $prepositions)) {
            $word = ucfirst($word);
        }
    }
    return implode(' ', $words);
}

function estado($sigla)
{
    $estados = array(
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins'
    );

    $sigla = strtoupper($sigla);

    if (array_key_exists($sigla, $estados)) {
        return $estados[$sigla];
    } else {
        return 'Estado não encontrado';
    }
}
function send_response($color, $response)
{
    if ($color == 1) {
        $color = 'danger';
    }
    if ($color == 2) {
        $color = 'success';
    }
    echo '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAUDECI | CONSIGNADO</title>
    <link rel="stylesheet" href="../assets/reset.min.css">
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    </head>
        <body>
        <div class="alert alert-' . $color . ' p-2 text-center">
        ' . $response . '
        </div>
    </body>
    </html>';
}
