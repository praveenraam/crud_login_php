<?php

require '../db/conn.db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    $query = "INSERT INTO user_det (firstname, lastname, email, pwd) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $data['firstname'], $data['lastname'], $data['email'], $data['pwd']);
    $stmt->execute();

    if ($stmt->errno == 1062) {
        $res['message'] = "Email ID already exists";
    } elseif ($stmt->error) {
        $res['message'] = "Error: " . $stmt->error;
    } else {
        $res['success'] = true;
        $res['message'] = "No error";
    }
} else {
    $res['success'] = false;
    $res['message'] = "Not a post request";
}

echo json_encode($res);
