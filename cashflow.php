<?php
require 'db_connection.php';

if (!isset($_SESSION['user'])) {
    header("location:login");
    exit();
}

$query = "SELECT * FROM cash_flow";
$result = mysqli_query($conn, $query);

if (!result) {
    die("error");
}
?>

<?php
require base_path('view/header.view.php');
require base_path('view/navbar.view.php');
?>
<div class="container">
    <div class="mt-5">
        <a href="cashflow_add" class="btn btn-primary">Add New</a>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Income</th>
                    <th>Expense</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc): ?>
                <tr>
                    <td>
                        date
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" class="rounded-circle" alt=""
                                style="width: 45px; height: 45px" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">Kate Hunington</p>
                                <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-success rounded-pill d-inline">Active</span>
                    </td>
                    <td>Senior</td>
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded">
                            Edit
                        </button>
                    </td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </div>
</div>
<?php
require base_path('view/footer.view.php');
?>