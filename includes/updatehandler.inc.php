<?php
require '../db/conn.db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    $query = "UPDATE user_det SET firstname=?, lastname=?, email=? WHERE user_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $data['firstname'], $data['lastname'], $data['email'], $_SESSION['user_id']);
    $stmt->execute();

    $_SESSION['email'] = $data['email'];

    if ($stmt->errno == 1062) {
        $res['success'] = false;
        $res['message'] = "Email ID already exists";
    } elseif ($stmt->error) {
        $res['success'] = false;
        $res['message'] = "Error: " . $stmt->error;
    } else {
        $res['success'] = true;
        $res['message'] = "Updated Successfully";
    }
} else {
    $res['success'] = false;
    $res['message'] = `Not a POST Request`;
}

echo json_encode($res);
