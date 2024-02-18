<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= base_url('/css/style.css'); ?>">
</head>
<body>
    <div class="sign">
        <div class="sign-content">
            <img class="img1" src="/img/top-rigth.png" alt="Text Image">
            <img class="img2" src="/img/left-bottom.png" alt="Text Image">
            <img class="img3" src="/img/text-image.png" alt="Text Image">

            <h1>Welcome <span class="black-text">Back!</span></h1>

            <div style="color: red;">
                <?= \Config\Services::validation()->listErrors(); ?>
            </div>
            
            <form method="post" action="<?= base_url('signup'); ?>">
                <input type="text" name="full_name" id="name" placeholder="Full Name" required>
                <input type="email" name="email" id="email" placeholder="Email address" required>
                <input type="password" name="password" id="password" placeholder="Password" required>

                <div class="remember">
                    <div class="remember-check">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember"> Remember me</label>
                    </div>
                    <div>
                        <a href="#">Forgot password?</a>
                    </div>
                </div>

                <button class="submit" type="submit">Register</button>
                
                <div>
                    <p>You have an account? <a href="<?= base_url('signin') ?>">Sign In</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
