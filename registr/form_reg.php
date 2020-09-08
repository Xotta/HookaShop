<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>reg</title>
</head>

<script type="text/javascript">
    $(document).ready(function(){
        "use strict";
        var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
        var mail = $('input[name=email]');

        mail.blur(function(){
            if(mail.val() != ''){
                if(mail.val().search(pattern) == 0){
                    $('#valid_email_message').text('');
                    $('input[type=submit]').attr('disabled', false);
                }else{
                    $('#valid_email_message').text('Не правильный Email');
                    $('input[type=submit]').attr('disabled', true);
                }
            }else{
                $('#valid_email_message').text('Введите Ваш email');
            }
        });



        var password = $('input[name=password]');
        password.blur(function(){
            if(password.val() != ''){
                if(password.val().length < 6){
                    $('#valid_password_message').text('Минимальная длина пароля 6 символов');
                    $('input[type=submit]').attr('disabled', true);
                }else{
                    $('#valid_password_message').text('');
                    $('input[type=submit]').attr('disabled', false);
                }
            }else{
                $('#valid_password_message').text('Введите пароль');
            }
        });
    });
</script>


<body>

<div class="block_for_messages">
        <?php
        session_start();
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];
            unset($_SESSION["error_messages"]);
        }
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
            unset($_SESSION["success_messages"]);
        }
        ?>
    </div>

<?php
if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
    ?>
    <div id="form_register">
        <h2>Форма регистрации</h2>

        <form action="register.php" method="post" name="form_register">
            <table>
                <tr>
                    <td> Имя: </td>
                    <td>
                        <input type="text" name="first_name" required="required">
                    </td>
                </tr>
                <tr>
                    <td> Email: </td>
                    <td>
                        <input type="email" name="email" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>

                <tr>
                    <td> Пароль: </td>
                    <td>
                        <input type="password" name="password" placeholder="минимум 6 символов" required="required"><br>
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                </tr>
                <tr>
                    <td> Введите капчу: </td>
                    <td>
                        <p>
                            <img src="captcha.php" alt="Капча" /> <br><br>
                            <input type="text" name="captcha" placeholder="Проверочный код" required="required">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit_register" value="Зарегистрироватся!">
                    </td>
                </tr>
                </table>
        </form>
    </div>
    <?php
}else{
    ?>
    <div id="authorized">
        <h2>Вы уже зарегистрированы</h2>
    </div>
    <?php
}


?>

</body>
<footer>

</footer>
