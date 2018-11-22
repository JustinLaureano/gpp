<section class="login__container">
    <section class="login__content" >
        <header class="login__header">
            <h2>Administrator Access</h2>
        </header>

        <form action="<?=base_url();?>admin/login" method="POST" class="login__form">
            <div class="login__formrow">
                <label for="user" class="login__label">Username </label><input type="text" name="user" class="login__forminput" />
            </div>
            <div class="login__formrow">
                <label for="pass" class="login__label">Password </label><input type="password" name="pass" class="login__forminput" />
            </div>
            <?php if ( isset($loginfail['loginfail']) ) echo "<section class=\"login__failmessage\">" . $loginfail['loginfail'] . "</section>"; ?>
            <input type="submit" value="Sign In" class="login__submit" />
        </form>
    </section>
    <?php if ( isset($message['message']) ) echo "<section class=\"login__message\">" . $message['message'] . "</section>"; ?>
</section>
