<?php

    include('./security.php');

    $jsonDatas = $_POST['data'];

    $user = $conn->real_escape_string($jsonDatas['user']);
    $pass = $conn->real_escape_string($jsonDatas['pass']);

    $query = mysqli_query($conn, "SELECT * FROM  system_users WHERE username = '$user';");

    $qtdUsers = $query->num_rows;

    if ($qtdUsers >= 1) {
        $acessPass = $query->fetch_assoc();
        $hashUser =  $acessPass['password_hash'];

        if (password_verify($pass, $hashUser)) {

            if(!isset($_SESSION)) {
                session_start();
            };

            $_SESSION['username'] = $user;

            echo "sucess";
        } else {
            echo "errorPass";
        };

    } else {
        echo "errorUser";
    };

?>