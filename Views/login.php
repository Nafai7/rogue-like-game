<?php
if (isset($_SESSION['isLogged'])) {
    header("Location: /");
    die();
}
?>

<main>
    <form>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username..">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password..">

        <div id="remember-container">
            <input type="checkbox" id="rememberMe" name="rememberMe" value="true">
            <label for="rememberMe">Remember me</label>
        </div>

        <input type="button" value="Login" onclick="login()">
    </form>
</main>