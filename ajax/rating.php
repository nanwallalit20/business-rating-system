<?php
require_once __DIR__ . '/../config/Database.php';

header('Content-Type: application/json');

$db = Database::connect();

try {
    $businessId = (int)$_POST['business_id'];
    $name       = trim($_POST['name']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);
    $rating     = (float)$_POST['rating'];

    if ($rating < 0 || $rating > 5) {
        throw new Exception('Invalid rating value');
    }

    /* ======================
       Check Existing Rating
    ====================== */
    $check = $db->prepare("
        SELECT id FROM ratings
        WHERE business_id = :business_id
          AND (email = :email OR phone = :phone)
        LIMIT 1
    ");

    $check->execute([
        ':business_id' => $businessId,
        ':email' => $email,
        ':phone' => $phone
    ]);

    if ($existing = $check->fetch()) {

        /* Update Rating */
        $stmt = $db->prepare("
            UPDATE ratings
            SET rating = :rating, name = :name
            WHERE id = :id
        ");

        $stmt->execute([
            ':rating' => $rating,
            ':name' => $name,
            ':id' => $existing['id']
        ]);

    } else {

        /* Insert Rating */
        $stmt = $db->prepare("
            INSERT INTO ratings (business_id, name, email, phone, rating)
            VALUES (:business_id, :name, :email, :phone, :rating)
        ");

        $stmt->execute([
            ':business_id' => $businessId,
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':rating' => $rating
        ]);
    }

    /* ======================
       Recalculate Average
    ====================== */
    $avgStmt = $db->prepare("
        SELECT ROUND(AVG(rating), 1) AS avg_rating
        FROM ratings
        WHERE business_id = :business_id
    ");

    $avgStmt->execute([
        ':business_id' => $businessId
    ]);

    $avg = $avgStmt->fetchColumn();

    echo json_encode([
        'status' => true,
        'message' => 'Rating submitted successfully',
        'avg_rating' => $avg
    ]);

} catch (Throwable $e) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => $e->getMessage()
    ]);
}
