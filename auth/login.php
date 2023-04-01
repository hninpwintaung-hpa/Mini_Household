<?php
require '../db_connection.php';
//require '../session.php';

if (isset($_SESSION['user'])) {
    header("location:/");
    exit();
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $message = [];

    if (strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) > 0) {
        //dd("Login with email and password");
        $query = sprintf("SELECT * FROM users WHERE email= '%s'",
            mysqli_real_escape_string($conn, $email));
        $result = mysqli_query($conn, $query);

        if (!$result) {
            $error['body'] = "Errors when select the data.";
        } else {
            $row = mysqli_fetch_assoc($result);

            if (!empty($row)) {
                if (password_verify($password, $row['password'])) {
                    login([
                        'id' => $row['id'],
                        'email' => $email,
                    ]);
                    header("location:/");
                    exit();

                } else {
                    $message['error'] = "Please Enter valid email and passsword.";
                }
            } else {
                $message['error'] = "Please Enter valid email and passsword.";
            }
        }

    } else {
        $message['error'] = "Please enter valid email and password.";
    }
}
?>
<?php
require base_path('view/header.view.php');
require base_path('view/navbar.view.php');
?>
<div class="container register mt-5">
    <div class="col-5 m-auto p-3 card bg-light">

        <h2 style="text-align:center;">Register</h2>
        <form class="m-5" method="POST">

            <?php if (!empty($message['error'])): ?>
            <div style="text-align:center; color:red;padding:10px;"><?=$message['error'];?></div>
            <?php endif;?>

            <div class="form-outline mb-4">
                <input type="email" name="email" class="form-control" />
                <label class="form-label" for="form1Example1">Email address</label>
            </div>

            <div class="form-outline mb-4">
                <input type="password" name="password" class="form-control" />
                <label class="form-label" for="form1Example2">Password</label>
            </div>

            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                        <label class="form-check-label" for="form1Example3"> Remember me </label>
                    </div>
                </div>

                <div class="col">
                    <a href="#!">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
        </form>
    </div>
</div>
<?php require base_path('view/footer.view.php');?>