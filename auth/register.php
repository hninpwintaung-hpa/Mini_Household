<?php
require '../db_connection.php';

$userName = $email = $password = $confirmPassword = "";
$errorName = $errorPassword = $errorEmail = $errorConfirmPwd = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $error = [];
    $message = [];

    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($userName == "") {
        $errorName = "Name is required!";
    }
    if ($email == "") {
        $errorEmail = "Email is required!";
    }
    if ($password == "") {
        $errorPassword = "Password is required!";
    }
    if ($confirmPassword == "") {
        $errorConfirmPwd = "Confirm password is required!";
    }
    if (strlen($userName) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL) > 0 &&
        strlen($password) > 0 && strlen($confirmPassword) > 0) {

        $query = sprintf("SELECT email FROM users WHERE email='%s'",
            mysqli_real_escape_string($conn, $email),
        );
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row['email'] ?? 0 === $email) {
            $errorEmail = "Email Already Exists!";
        } else {
            if ($password === $confirmPassword) {
                $query = sprintf("INSERT INTO users (user_name,email,password) VALUES('%s','%s','%s')",
                    mysqli_real_escape_string($conn, $userName),
                    mysqli_real_escape_string($conn, $email),
                    mysqli_real_escape_string($conn, password_hash($password, PASSWORD_BCRYPT)));
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    $message['error'] = "Register Fail!";
                } else {
                    $userName = $email = $password = $confirmPassword = "";
                    $message['success'] = "Register Success.";
                }
            } else {
                $message['error'] = "Password does not match!";
            }

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
        <h2 style="text-align:center;">Register</h2>

        <form class="m-5" method="POST">

            <?php if (!empty($message['error'])): ?>
            <div style="text-align:center; color:red;padding:10px;"><?=$message['error'];?></div>
            <?php endif;?>

            <?php if (!empty($message['success'])): ?>
            <div style="text-align:center; color:green;padding:10px;"><?=$message['success'];?></div>
            <?php endif;?>


            <small style="color:red;"><?php echo $errorName; ?></small>
            <div class="form-outline mb-4">
                <input type="text" name="userName" class="form-control" value="<?php echo $userName; ?>" />
                <label class="form-label" for="form1Example1">Name</label>
            </div>

            <small style="color:red;"><?php echo $errorEmail; ?></small>
            <div class="form-outline mb-4">
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" />
                <label class="form-label" for="form1Example1">Email address</label>
            </div>

            <small style="color:red;"><?php echo $errorPassword; ?></small>
            <div class="form-outline mb-4">
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" />
                <label class="form-label" for="form1Example2">Password</label>
            </div>
            <small style="color:red;"><?php echo $errorConfirmPwd; ?></small>
            <div class="form-outline mb-4">
                <input type="password" name="confirmPassword" class="form-control"
                    value="<?php echo $confirmPassword; ?>" />
                <label class="form-label" for="form1Example2">Confirm Password</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
        </form>
    </div>
</div>
<?php require base_path('view/footer.view.php');?>