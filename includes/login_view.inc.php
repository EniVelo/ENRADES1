<?php
declare(strict_types=1);

function check_login_errors(): void {
    if (isset($_SESSION["errors_login"])) {
        foreach ($_SESSION["errors_login"] as $error) {
            echo '<p class="form-error" style="color: red; text-align:center;">' . $error . '</p>';
        }
        unset($_SESSION["errors_login"]);
    } else if (isset($_GET["login"]) && $_GET["login"] === "success") {
        echo '<p class="form-success" style="color: green; text-align:center;">Login successful!</p>';
    }
}
