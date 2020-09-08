
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
    <div id="form_auth">
        <h2>Форма авторизации</h2>
        <form action="auth.php" method="post" name="form_auth">
            <table>
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
                            <img src="captcha.php" alt="Изображение капчи" /> <br>
                            <input type="text" name="captcha" placeholder="Проверочный код">
                        </p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="btn_submit_auth" value="Войти">
                    </td>
                </tr>
                </table>
        </form>
    </div>

    <?php
}else{
    ?>
    <div >
        <h2>Вы уже авторизованы</h2>
    </div>

    <?php
}
?>
