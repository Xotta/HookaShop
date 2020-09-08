<?php
session_start();
require_once("db.php");
$_SESSION["error_messages"] = '';
$_SESSION["success_messages"] = '';

if(isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])){
    if(isset($_POST["captcha"])){
        $captcha = trim($_POST["captcha"]);
        if(!empty($captcha)){
            if(($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")){
                $error_message = "<p class='mesage_error'><strong>Ошибка!</strong> Вы ввели неправильную капчу </p>";
                $_SESSION["error_messages"] = $error_message;
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/registr/form_auth.php");
                exit();
            }

        }else{

            $error_message = "<p class='mesage_error'><strong>Ошибка!</strong> Поле для ввода капчи не должна быть пустой. </p>";
            $_SESSION["error_messages"] = $error_message;
            header("Location: ".$address_site."/registr/form_auth.php");
            exit();
        }

        $email = trim($_POST["email"]);
        if(isset($_POST["email"])){
            if(!empty($email)){
                $email = htmlspecialchars($email, ENT_QUOTES);
                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
                if( !preg_match($reg_email, $email)){
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправильный email</p>";
                    header("Location: ".$address_site."/registr/form_auth.php");
                    exit();
                }
            }else{
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Поле для ввода почтового адреса(email) не должна быть пустой.</p>";
                header("Location: ".$address_site."/registr/form_auth.php");
                exit();
            }


        }else{
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода Email</p>";
            header("Location: ".$address_site."/registr/form_auth.php");
            exit();
        }

        if(isset($_POST["password"])){
            $password = trim($_POST["password"]);
            if(!empty($password)){
                $password = htmlspecialchars($password, ENT_QUOTES);
                $password = md5($password."Kirkkirk1");
            }else{
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Укажите Ваш пароль</p>";
                header("Location: ".$address_site."/registr/form_auth.php");
                exit();
            }

        }else{
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода пароля</p>";
            header("Location: ".$address_site."/registr/form_auth.php");
            exit();
        }

        $sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'";
        $result = mysqli_query($db, $sql);

        if(!$result){
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на выборке пользователя из БД</p>";
            header("Location: ".$address_site."/registr/form_auth.php");
            exit();
        }else{
            if(mysqli_num_rows($result) == 1){
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header("Location: ".$address_site."/index.html");
            }else{
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Неправильный логин и/или пароль</p>";
                header("Location: ".$address_site."/registr/form_auth.php");
                exit();
            }
        }
    }

}