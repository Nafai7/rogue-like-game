<?php

namespace Nafai\Utilis;

class Loader {

    public function loadView($view) {
        require_once("Views/header.php");
        include($view);
        require_once("Views/footer.html");
    }
}

?>