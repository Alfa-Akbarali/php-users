<?php 

spl_autoload_register(function ($className){
    $baseDir = __DIR__ . '/';
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    $filePath = $baseDir . $className . '.php';

    if(file_exists($filePath)){
        require_once $filePath;
    }
});

// if(session_status() == PHP_SESSION_NONE)
// {
//     session_start();
// }

// if(!isset($_SESSION['username']))
// {
//     header("Location: /router");
//     exit();
// }

?>