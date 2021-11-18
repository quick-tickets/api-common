<?php

$apiUrl = 'https://api.quicktickets.ru/v1/';
$apiId = 'YOUR_ID';
$apiKey = 'YOUR_KEY';
$params = [];

// Список областей
$action = 'area/list';
$params['organisation_service_type'] = 'all';

// Список городов
//$action = 'city/list';
//$params['area_id'] = '1';
//$params['organisation_service_type'] = 'all';

// Список мероприятий
//$action = 'event/list';
//$params['organisation_alias'] = 'demo';

// Список организаций
//$action = 'organisation/list';
//$params['city_id'] = '1253';
//$params['organisation_name'] = 'Демонстрационная';
//$params['organisation_buy'] = '1';
//$params['organisation_book'] = '1';
//$params['offset'] = '1';
//$params['limit'] = '100';

$stringParamsValues = $get = [];
foreach($params as $key => $value) { $stringParamsValues[] = $value; $get[] = $key . '=' . $value; }
sort($stringParamsValues);

$url = $apiUrl . $action . (($get) ? '?' . implode('&', $get) : '');

$headers = [
    'http' => [
        'method' => 'GET',
        'header' =>
            'Accept: "application/json"' . "\r\n"
            . 'api-id: ' . $apiId . "\r\n"
            . 'Authorization: Basic ' . base64_encode(hash('sha256', implode(',', $stringParamsValues) . ',' . hash('sha256', $apiKey))) . "\r\n",
    ],
];
$context = stream_context_create($headers);
$result = file_get_contents($url, false, $context);
?>

<h1>v1</h1>

<h2>Адрес</h2>
<?= $url ?>

<h2>Заголовки</h2>
<pre><? print_r($headers); ?></pre>

<h2>Параметры</h2>
<pre><? print_r($params); ?></pre>

<h2>Результат</h2>
<pre><? print_r($result); ?></pre>
<br><pre><? print_r(json_decode($result)); ?></pre>
