<?php
require_once __DIR__ . '/../config/Database.php';

header('Content-Type: application/json');

$db = Database::connect();
$action = $_POST['action'] ?? '';

try {

    switch ($action) {

        /* ======================
           Add Business
        ====================== */
        case 'add':
            $stmt = $db->prepare("
                INSERT INTO businesses (name, address, phone, email)
                VALUES (:name, :address, :phone, :email)
            ");

            $stmt->execute([
                ':name'    => trim($_POST['name']),
                ':address' => trim($_POST['address']),
                ':phone'   => trim($_POST['phone']),
                ':email'   => trim($_POST['email']),
            ]);

            $id = $db->lastInsertId();

            echo json_encode([
                'status' => true,
                'message' => 'Business added successfully',
                'data' => [
                    'id' => $id,
                    'name' => $_POST['name'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone'],
                    'email' => $_POST['email'],
                    'avg_rating' => 0
                ]
            ]);
            break;

        /* ======================
           Update Business
        ====================== */
        case 'update':
            $stmt = $db->prepare("
                UPDATE businesses
                SET name = :name, address = :address, phone = :phone, email = :email
                WHERE id = :id
            ");

            $stmt->execute([
                ':id'      => (int)$_POST['id'],
                ':name'    => trim($_POST['name']),
                ':address' => trim($_POST['address']),
                ':phone'   => trim($_POST['phone']),
                ':email'   => trim($_POST['email']),
            ]);

            echo json_encode([
                'status' => true,
                'message' => 'Business updated successfully'
            ]);
            break;

        /* ======================
           Delete Business (Hard)
        ====================== */
        case 'delete':
            $stmt = $db->prepare("DELETE FROM businesses WHERE id = :id");
            $stmt->execute([
                ':id' => (int)$_POST['id']
            ]);

            echo json_encode([
                'status' => true,
                'message' => 'Business deleted successfully'
            ]);
            break;

        /* ======================
           Fetch Single Business
        ====================== */
        case 'get':
            $stmt = $db->prepare("SELECT * FROM businesses WHERE id = :id");
            $stmt->execute([
                ':id' => (int)$_POST['id']
            ]);

            echo json_encode([
                'status' => true,
                'data' => $stmt->fetch()
            ]);
            break;

        default:
            throw new Exception('Invalid action');

    }

} catch (Throwable $e) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => $e->getMessage()
    ]);
}
