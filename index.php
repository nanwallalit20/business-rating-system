<?php
require_once __DIR__ . '/config/Database.php';

$db = Database::connect();

/*
 | Fetch businesses with average rating
 */
$sql = "
    SELECT b.id,b.name,b.address,b.phone,b.email,IFNULL(AVG(r.rating), 0) AS avg_rating
    FROM businesses b
    LEFT JOIN ratings r ON r.business_id = b.id
    GROUP BY b.id
    ORDER BY b.id DESC";

$stmt = $db->prepare($sql);
$stmt->execute();
$businesses = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Business Listing & Rating System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Raty -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/raty/2.9.0/jquery.raty.min.css" rel="stylesheet">

    <style>
        .raty-readonly {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Business Listing</h3>
        <button class="btn btn-primary" id="btn-add-business">
            <i class="fa fa-plus"></i> Add Business
        </button>
    </div>

    <table class="table table-bordered table-hover align-middle" id="business-table">
        <thead class="table-dark">
        <tr>
            <th width="5%">ID</th>
            <th>Business Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th width="15%">Average Rating</th>
            <th width="12%">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($businesses as $business): ?>
            <tr id="row-<?= $business['id'] ?>">
                <td><?= $business['id'] ?></td>
                <td><?= htmlspecialchars($business['name']) ?></td>
                <td><?= htmlspecialchars($business['address']) ?></td>
                <td><?= htmlspecialchars($business['phone']) ?></td>
                <td><?= htmlspecialchars($business['email']) ?></td>
                <td>
                    <div
                        class="raty-readonly"
                        data-score="<?= round($business['avg_rating'], 1) ?>"
                        data-business-id="<?= $business['id'] ?>">
                    </div>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-warning btn-edit"
                            data-id="<?= $business['id'] ?>">
                        <i class="fa fa-edit"></i>
                    </button>

                    <button class="btn btn-sm btn-danger btn-delete"
                            data-id="<?= $business['id'] ?>">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- =======================
     Modals
======================== -->

<?php include __DIR__ . '/partials/business_modal.php'; ?>
<?php include __DIR__ . '/partials/rating_modal.php'; ?>
<?php include __DIR__ . '/partials/alert_modal.php'; ?>

<!-- =======================
     Scripts
======================== -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Raty -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raty/2.9.0/jquery.raty.min.js"></script>

<script>
    $(function () {
        $('.raty-readonly').raty({
            readOnly: true,
            half: true,
            path: 'https://cdnjs.cloudflare.com/ajax/libs/raty/2.9.0/images',
            score: function () {
                return $(this).data('score');
            }
        });
    });
</script>

<script src="assets/js/business.js"></script>
<script src="assets/js/rating.js"></script>

</body>
</html>
