<!DOCTYPE html>
<html lang="en">
<head>
  
    <title>Login Form</title>
    
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form>
        <h3>Login</h3>

		<?php if(session()->getFlashdata('msg')):?>
			<div class="alert alert-warning">
				<?= session()->getFlashdata('msg') ?>
			</div>
		<?php endif;?>

		<?php if(isset($loginStatus)):?>
			<div class="alert alert-primary">
				<?= $loginStatus?>
			</div>
		<?php endif;?>

		<form class="foolish-form login-form-height" action="<?php echo base_url(); ?>/authenticate" method="post">
			<label for="email">Email</label>
			<input type="text" placeholder="johndoe123@example.com" id="email" name="emailAddress">

			<label for="password">Password</label>
			<input type="password" placeholder="" id="password" name="password">

			<button type="submit" formmethod="post" formaction="<?= base_url(); ?>/authenticate" class="login">Log In</button>

			<div class="sign-up">Don't have an account? <a href="<?php echo base_url(); ?>/register">Create One</a></div>
			<!--<div class="social">
			<div class="go"><i class="fab fa-google"></i>  Google</div>
			<div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
			</div>-->
		</form>
    </form>
</body>
</html>
