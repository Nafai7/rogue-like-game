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

        <input type="button" value="Register" onclick="register()">
    </form>
</main>