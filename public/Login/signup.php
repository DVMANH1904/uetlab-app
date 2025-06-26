<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
    <section1>
        <div class="Signup-box">
            <form method="POST" action="signup-func.php">
                <h2>Signup</h2>
                <div class="input-signup-box">
                    <div class="icon-signup"><ion-icon name="logo-octocat"></ion-icon></div>
                    <input type="text" id="name" name="name" required>
                    <label for="name">Your Name</label>
                </div>
                <div class="input-signup-box">
                    <div class="icon-signup"><ion-icon name="mail-open-outline"></ion-icon></ion-icon></div>
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-signup-box">
                    <div class="icon-signup"><ion-icon name="lock-closed-outline"></ion-icon></div>
                    <input type="password" id="password" name="password" required>
                    <label for="password">Enter Your Password</label>
                </div>
                <div class="input-signup-box">
                    <div class="icon-signup"><ion-icon name="lock-closed-outline"></ion-icon></div>
                    <input type="password" id="password" required>
                    <label for="password">Enter Your Password Again</label>
                </div>
                <button type="submit">Sign up</button>
                <div class="link-to-login">
                    <p>You have a account? <a href="index.php">Login</a></p>
                </div>
            </form>
        </div>
    </section1>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
