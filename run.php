<?php

require_once 'vendor/autoload.php';

use Task\Task4\EvenCounter;
use Task\Task5\QueryExtId;
use Task\Task6\CSVReader;
use Task\Task6\DataRepository;
use Task\Task7\CurlRequest;

(new EvenCounter())->run();

// config shouldnt be defined here, somewhere on app config level in a config file or in an .env
$config = [
    'dsn' => 'mysql:host=127.0.0.1;dbname=app;charset=utf8',
    'username' => 'root',
    'password' => 'secret',
];

(new QueryExtId($config))->run();

(new CSVReader(new DataRepository()))
    ->run();

try {
    $request = new CurlRequest("127.0.0.1:3000/test", "testuser", "SecPw_1234!", ['tool' => 'Hello World Back!']);
    $response = $request->run();

    echo "Response:\n" . $response;
    print(PHP_EOL);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}