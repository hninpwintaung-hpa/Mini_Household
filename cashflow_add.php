<?php

require 'db_connection.php';

if (!isset($_SESSION['user'])) {
    header("location:login");
    exit();
}

$user_id = $_SESSION['user']['id'];
$description = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $message = [];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $radio = $_POST['radio'];
    //$income = $expense = 0;

    if ($description == "") {
        $message['errorDescription'] = "Description is require!";
    }
    if ($amount == "") {
        $message['errorAmount'] = "Amount is require!";
    }

    if (strlen($date) > 0 && strlen($description) > 0 && strlen($amount) > 0) {
        if ($radio === "income") {
            $income = $amount;
            $expense = 0;
        } else {
            $expense = $amount;
            $income = 0;
        }
        $query = sprintf("INSERT INTO cash_flow (date,description,income,expense,user_id)
            VALUES ('$date','$description','$income','$expense','$user_id')",
            mysqli_real_escape_string($conn, $date),
            mysqli_real_escape_string($conn, $description),
            mysqli_real_escape_string($conn, $income),
            mysqli_real_escape_string($conn, $expense),
            mysqli_real_escape_string($conn, $user_id));

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("error");
        } else {
            header("location:cashflow");
        }
    }
}
?>
<?php
require base_path('view/header.view.php');
require base_path('view/navbar.view.php');
?>
<div class="container register mt-5">
    <div class="col-5 m-auto p-3 card bg-light">

        <h2 style="text-align:center;">Add New</h2>
        <form class="m-5" method="POST">
            <div class="form-outline mb-4">
                <input type="date" name="date" class="form-control" value="<?=date('Y-m-d');?>" />
                <label class="form-label">Date</label>
            </div>

            <?php if (!empty($message['errorDescription'])): ?>
            <small style="color:red;"><?=$message['errorDescription'];?></small>
            <?php endif;?>

            <div class="form-outline mb-4">
                <input type="text" name="description" class="form-control" value="<?=$description;?>" />
                <label class="form-label">Description</label>
            </div>

            <?php if (!empty($message['errorAmount'])): ?>
            <small style=" color:red;"><?=$message['errorAmount'];?></small>
            <?php endif;?>

            <div class="form-outline mb-4">
                <input type="number" name="amount" class="form-control" value="<?=$amount;?>" />
                <label class="form-label" for="form1Example2">Enter Amount</label>
            </div>
            <div class="radio-group text-center mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="income"
                        checked />
                    <label class="form-check-label" for="inlineRadio1">Income</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="expense" />
                    <label class="form-check-label" for="inlineRadio2">Expense</label>
                </div>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block">ADD</button>
        </form>
    </div>
</div>
<?php
require base_path('view/footer.view.php');