<?php
declare(strict_types=1);

function is_input_empty(string $email, int $phone_number, string $pwd, string $fullname, string $address): bool {
    return empty($email) || empty($phone_number) || empty($pwd) || empty($fullname) || empty($address);
}

function is_email_invalid(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) === false;
}

function is_email_registered(object $pdo, string $email): bool {
    $user = get_email($pdo, $email);
    return $user !== false;
}

function create_user(object $pdo, string $email, int $phone_number, string $pwd, string $fullname, string $address): void {
    set_user($pdo, $email, $phone_number, $pwd, $fullname, $address);
}
?>
