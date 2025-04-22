<?php
declare(strict_types=1);

function signup_inputs(): void {
    echo '<input type="email" class="form-control" name="email" placeholder="Email">';
    echo '<input type="text" class="form-control" name="phone" placeholder="Phone number">';
    echo '<input type="password" class="form-control" name="password" placeholder="Password">';
    echo '<input type="text" class="form-control" name="name" placeholder="Full name">';
    echo '<input type="text" class="form-control" name="address" placeholder="Address">';
}

function check_signup_errors(): void {
    if (isset($_SESSION["errors_signup"])) {
        foreach ($_SESSION["errors_signup"] as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }
        unset($_SESSION["errors_signup"]);
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<p class="form-success">Signup success!</p>';
    }
}
?>
