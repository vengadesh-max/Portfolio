<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Read the input
$input = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($input['action'])) {
    switch ($input['action']) {
        case 'sendMail':
            sendMail($input);
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

function sendMail($data) {
    $to = 'bvengadesh25504@gmail.com';
    $subject = $data['subject'];
    $message = $data['message'];
    $headers = 'From: ' . $data['from'] . "\r\n" .
               'Reply-To: ' . $data['from'] . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(['success' => 'Message has been sent']);
    } else {
        echo json_encode(['error' => 'Message could not be sent']);
    }
}
?>
