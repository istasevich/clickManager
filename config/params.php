<?php
use yii\di\Container;

$container = new Container;
$container->set('yii\db\Connection', [
	'dsn' => 'mysql:host=localhost;dbname=clickManager',
]);
$container->set('app\repositories\interfaces\iClickRepository', [
	'class' => 'app\repositories\ClickRepository'
]);
$container->set('clickRepository', 'app\repositories\ClickRepository');

return [
    'adminEmail' => 'admin@example.com',
];
