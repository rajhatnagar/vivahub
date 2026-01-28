<?php
session_start();
require_once 'db.php';

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /vivahub/login.php');
        exit;
    }
}

function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        header('Location: /vivahub/dashboard.php'); // Redirect non-admins to user dashboard
        exit;
    }
}

function registerUser($name, $email, $password) {
    global $pdo;
    
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return ['success' => false, 'message' => 'Email already registered.'];
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
    
    if ($stmt->execute([$name, $email, $hashedPassword])) {
        return ['success' => true];
    }
    
    return ['success' => false, 'message' => 'Registration failed. Please try again.'];
}

function loginUser($email, $password) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        return ['success' => true, 'role' => $user['role']];
    }

    return ['success' => false, 'message' => 'Invalid credentials.'];
}

function logoutUser() {
    session_destroy();
    header('Location: /vivahub/login.php');
    exit;
}
?>
