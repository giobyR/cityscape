
<?php
    //session_start();
    require_once __DIR__."/configurazione.php";
    /*
    require_once DIR_SESSION."sessionManager.php";
    if(!isLogged()){
        header("Location: /index.html");
        exit;
    }
    */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/layout_evento.css">

    <script type="text/javascript" src="/js/effects.js"></script>
    <title>Eventi del momento</title>
</head>
<body>
    <?php
        include DIR_LAYOUT."navbar.php";
        include DIR_LAYOUT."sidebar.php";  
        include DIR_LAYOUT."layout_evento.php";
    ?>
    
</body>
</html>