<h1>Main</h1>


<?php if(auth_is_auth()):?>
    <h2>hello, <?=auth_getCurrentUser()["login"]?></h2>
    <a href="/04_PROCEDURE_MVC_WITH_OB/logout">logout</a>
<?php else: ?>
    <form action="/04_PROCEDURE_MVC_WITH_OB/login" method="post">
        <input type="text" name="login" placeholder="login..."><br>
        <input type="password" name="pass" placeholder="pass..."><br>
        <input type="submit">
    </form>
    <a href="/04_PROCEDURE_MVC_WITH_OB/register">register</a>
<?php endif;?>