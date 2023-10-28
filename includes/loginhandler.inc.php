<?php
require_once '../db/conn.db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    $query = 'SELECT email,pwd from user_det where email=\'' . $data["email"] . "'";
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            if ($data['pwd'] == $row['pwd']) {
                $res['success'] = true;
                $res['message'] = 'Authorised User';
                $_SESSION['email'] = $data['email'];
            } else {
                $res['success'] = false;
                $res['message'] = 'Login failed password doesn\'t match';
            }
        }
    } else {
        $res['success'] = false;
        $res['message'] = 'User not found';
    }
} else {
    $res['success'] = false;
    $res['message'] = 'Not a POST request';
}

echo json_encode($res);
