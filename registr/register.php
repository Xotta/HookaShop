<?php
session_start();
require_once("db.php");
$_SESSION["error_messages"] = '';
$_SESSION["success_messages"] = '';

if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){

    $captcha = trim($_POST["captcha"]);

    if(isset($_POST["captcha"]) && !empty($captcha)){
        if(($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")){
            $error_message = "<p class='mesage_error'><strong>Ошибка!</strong> Вы ввели неправильную капчу </p>";
            $_SESSION["error_messages"] = $error_message;
            header("Location: ".$address_site."form_reg.php");
            exit();
        }

        if(isset($_POST["first_name"])){
            $first_name = trim($_POST["first_name"]);
            if(!empty($first_name)){
                $first_name = htmlspecialchars($first_name, ENT_QUOTES);
            }else{
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваше имя</p>";
                header("Location: ".$address_site."/form_reg.php");
                exit();
            }
        }else{
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с именем</p>";
            header("Location: ".$address_site."/form_reg.php");
            exit();
        }

        if(isset($_POST["email"])){
            $email = trim($_POST["email"]);
            if(!empty($email)){

                $email = htmlspecialchars($email, ENT_QUOTES);

                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
                if( !preg_match($reg_email, $email)){
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправельный email</p>";
                    header("Location: ".$address_site."/form_reg.php");
                    exit();
                }

                $result_query = mysqli_query($db,"SELECT * FROM `users` WHERE `email` = '$email'");
                if($result_query->num_rows == 1){
                    if(($row = $result_query->fetch_assoc()) != false){
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Пользователь с таким почтовым адресом уже зарегистрирован</p>";
                        header("Location: ".$address_site."/form_reg.php");

                    }else{
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка в запросе к БД</p>";
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/form_reg.php");
                    }
                    $result_query->close();
                    exit();
                }
                $result_query->close();
            }else{
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш email</p>";
                header("Location: ".$address_site."/form_reg.php");
                exit();
            }

        }else{
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода Email</p>";
            header("Location: ".$address_site."/form_reg.php");
            exit();
        }


        if(isset($_POST["password"])){
            $password = trim($_POST["password"]);
            if(!empty($password)){
                $password = htmlspecialchars($password, ENT_QUOTES);
                $password = md5($password."kirkkirk1");
            }else{
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш пароль</p>";
                header("Location: ".$address_site."/form_reg.php");
                exit();
            }

        }else{
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода пароля</p>";
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_reg.php");
            exit();
        }

        //Запрос на добавления пользователя в БД
        $sql = "INSERT INTO users (login, email, password) VALUES ('".$first_name."', '".$email."', '".$password."')";
        if (mysqli_query($db, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }




    }

}
?>