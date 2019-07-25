<?php
/**
 * Date: 03/01/2019
 * Time: 10:52
 */

use Illuminate\Database\Capsule\Manager as Database;
try {
    new pdo('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $capsule = new Database;
    $conn = $capsule->addConnection([
        "driver" => 'mysql',
        "host" => DB_HOST,
        "database" => DB_NAME,
        "username" => DB_USER,
        "password" => DB_PASS
    ]);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    class DB extends Database{}
} catch (PDOException $ex) {
    echo  $ex->getCode();
    if ($ex->getCode() == 2002) {
        $error = array(
            'Type' => 'Database problem',
            'Message' => "Database host socket is invalid, try to correct it in constant file",
            'Dir' => 'app/config',
            'Code' => $ex->getCode()
        );
       SYSTEM_ERROR::render_error($error);
    }elseif ($ex->getCode() == 1049) {
        $error = array(
            'Type' => 'Database problem',
            'Message' => "Database <b>".DB_NAME." </b> not found, try to correct it in constant file",
            'Dir' => 'app/config',
            'Code' => $ex->getCode()
        );
        SYSTEM_ERROR::render_error($error);
    }elseif ($ex->getCode() == 1044) {
        $error = array(
            'Type' => 'Database problem',
            'Message' => "Database user called <b>".DB_USER." </b> not found, try to correct it in constant file",
            'Dir' => 'app/config',
            'Code' => $ex->getCode()
        );
        SYSTEM_ERROR::render_error($error);
    }elseif ($ex->getCode() == 1045) {
        $error = array(
            'Type' => 'Database problem',
            'Message' => "Database password is not correct, try to correct it in constant file",
            'Dir' => 'app/config',
            'Code' => $ex->getCode()
        );
        SYSTEM_ERROR::render_error($error);
    }
}

