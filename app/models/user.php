<?php 
class User {
  public static function hashPlainPassword($passwd = '') {
    return password_hash($passwd, PASSWORD_DEFAULT);
  }

  public static function verifyPassword($plain = '', $hashed = '') {
    return password_verify($plain, $hashed);
  }

  public static function createNewUser($data = []) {
    global $g;

    $stmt = $g->db->prepare("
      INSERT INTO `users` (username, password, email, telephone_number, address, name, status) 
      VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    @$stmt->bind_param(
      'ssssssi',
      $username,
      $password,
      $email,
      $telephone_number,
      $address,
      $name,
      $status
    );
    $username = @$data['username'];
    $password = self::hashPlainPassword(@$data['password']);
    $email = @$data['email'];
    $telephone_number = @$data['telephone_number'];
    $address = @$data['address'];
    $name = @$data['name'];
    $status = @$data['status'];

    return $stmt->execute();
  }

  public static function verifyUserByUsernameAndPassword($username = '', $password = '') {
    global $g;

    $stmt = $g->db->prepare("
      SELECT * FROM `users`
      WHERE 
        `email` = ?
        OR `username` = ?
      LIMIT 1
    ");
    $stmt->bind_param(
      "ss",
      $login_username1,
      $login_username2
    );
    $login_username1 = $username;
    $login_username2 = $username;
    
    if ($stmt->execute()) {
      while ($user = $stmt->get_result()->fetch_assoc()) {
        if ($user) {
          return self::verifyPassword($password, $user['password']) ? 
            $user['id'] 
            : false;
        }
      }
    }

    return false;
  }

  public static function getUserById($userId = 0) {
    global $g;

    $stmt = $g->db->prepare("
      SELECT * FROM `users`
      WHERE `id` = ? LIMIT 1
    ");
    $stmt->bind_param(
      "s",
      $id
    );
    $id = $userId;
    
    if ($stmt->execute()) {
      while ($user = $stmt->get_result()->fetch_assoc()) {
        if ($user) {
          return $user;
        }
      }
    }

    return false;
  }

  public static function getAllUsers() {
    global $g;

    $stmt = $g->db->prepare("
      SELECT * FROM `users`
    ");
    
    if ($stmt->execute()) {
      return $stmt->get_result();
    } else {
      return [];
    }
  }
}