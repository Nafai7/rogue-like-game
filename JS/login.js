function login() {
    let form = new FormData(document.getElementsByTagName("form")[0]);
    fetch("API/Logging/login.php", {
        method: "POST",
        body: form
    })
    .then(res => res.json())
    .then((data) => {
        if (data["success"]) {
            window.location.pathname = "/";
        }
    })
}