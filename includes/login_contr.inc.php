<?php
declare(strict_types=1);

function is_input_empty(string $email, string $pwd): bool {
    if (empty($email)) {
        $_SESSION["errors_login"][] = "Email field cannot be empty!";
    }
    if (empty($pwd)) {
        $_SESSION["errors_login"][] = "Password field cannot be empty!";
    }
    return empty($email) || empty($pwd);
}
