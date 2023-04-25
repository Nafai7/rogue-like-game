function login() {
    let form = new FormData(document.getElementsByTagName("form")[0]);
    fetch("API/Logging/login.php", {
        method: "POST",
        body: form
    })
    // .then(res => console.log(res))
    .then(res => res.json())
    .then((data) => {
        console.log(data);
    })
}