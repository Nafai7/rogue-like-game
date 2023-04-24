<main>
    <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
    <form action="/API/Logging/login.php" target="dummyframe">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username..">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password..">

        <div id="remember-container">
            <input type="checkbox" id="rememberMe" name="rememberMe">
            <label for="rememberMe">Remember me</label>
        </div>

        <input type="submit" value="Login">
    </form>
</main>