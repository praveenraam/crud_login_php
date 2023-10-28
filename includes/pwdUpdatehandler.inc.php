<?php
require "../db/conn.db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    $query = 'UPDATE user_det SET pwd=? WHERE user_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $data['pwd'], $_SESSION['user_id']);
    $stmt->execute();


    if ($stmt->error) {
        $res['success'] = false;
        $res['message'] = "Error: " . $stmt->error;
    } else {
        $res['success'] = true;
        $res['message'] = "Updated Successfully";
    }
} else {
    $res['success'] = false;
    $res['message'] = "Not a POST request";
}

echo json_encode($res);
