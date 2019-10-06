<?php

require_once __DIR__.'/bootstrap.php';

// Primera carga de datos
$clubes = datos();

// Render our view
echo $twig->render('/index/index.html', ['clubes' => $clubes] );

function datos()
{
    $curl = curl_init();

    $url = URL_API . 'clubes';

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return json_decode($result);
}