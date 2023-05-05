function register() {
    let form = new FormData(document.getElementsByTagName("form")[0]);
    fetch("API/Logging/register.php", {
        method: "POST",
        body: form
    })
    .then(res => res.json())
    .then((data) => {
        if (data["success"]) {
            window.location.pathname = "/login";
        }
    })
}