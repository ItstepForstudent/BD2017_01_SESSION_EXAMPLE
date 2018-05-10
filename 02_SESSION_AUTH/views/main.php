<h1>Main</h1>


<?php if(auth_is_auth()):?>
    <h2>hello, <?=auth_getCurrentUser()["login"]?></h2>
    <a href="/02_SESSION_AUTH/logout">logout</a>
<?php else: ?>
    <form action="/02_SESSION_AUTH/login" method="post">
        <input type="text" name="login" placeholder="login..."><br>
        <input type="password" name="pass" placeholder="pass..."><br>
        <input type="submit">
    </form>
    <a href="/02_SESSION_AUTH/register">register</a>
<?php endif;?>