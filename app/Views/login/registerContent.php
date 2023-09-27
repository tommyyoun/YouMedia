<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Form</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/foolishdeveloper.css">

</head>
<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <?php if (isset($validation)) : ?>
        <div class="error-message">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form class="foolish-form register-form-height" action="<?php base_url("register"); ?>" method="post">
        <h3>Sign Up</h3>
        

        <label for="first-name">First Name</label>
        <input type="text" placeholder="John" id="first-name" name="firstName">

        <label for="last-name">Last Name</label>
        <input type="text" placeholder="Doe" id="last-name" name="lastName">

        <label for="email">Email</label>
        <input type="text" placeholder="johndoe@example.com" id="email" name="emailAddress">

        <label for="password">Password</label>
        <input type="password" placeholder="" id="password" name="password">

        <label for="confirm-password">Confirm Password</label>
        <input type="password" placeholder="" id="confirm-password" name="confirmPassword">

        <button class="create-account">Create Account</button>

        <div class="login-back">Have an account? <a href="<?php echo base_url(); ?>/">Login</a></div>
        <!--<div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>-->
    </form>
</body>
</html>
