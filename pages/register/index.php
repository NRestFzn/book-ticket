<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    include("{$_SERVER['DOCUMENT_ROOT']}/controllers/AuthController.php");

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    $authController = new AuthController();

    $user = mysqli_fetch_assoc($authController->register($fullname, $username, $email, $password, $confirmPassword));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/_global.css">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/pages/register/style.css">
    <title>Register</title>
</head>

<body>
    <h1>Register Form</h1>
    <form method="POST" onsubmit="submitForm(event)">
        <label for="fullname">Fullname:</label>
        <input type="text" id="fullname" name="fullname" placeholder="ex: john doe" required />

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="ex: john123" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="ex: john@mail.com" required />

        <label for="password">Password:</label>
        <div class=password>
            <input type="password" id="password" name="password" placeholder="ex: johndoe123" required />
            <span onclick="showPassword('password', 'show-password')" id="show-password">show</span>
        </div>

        <label for="confirmpassword">Confirm Password:</label>
        <div>
            <div class="password">
                <input type="password" id="confirmpassword" name="confirmpassword" placeholder="ex: johndoe123" required />
                <span onclick="showPassword('confirmpassword', 'show-confirm-password')" id="show-confirm-password">show</span>
            </div>
        </div>

        <input type="submit" name="register" value="Register" />
        <p><a href="/pages/login">Have an account?</a></p>
    </form>

    <script>
        function showPassword(id, textId) {
            const showButton = document.getElementById(textId)
            const passwordInput = document.getElementById(id);

            showButton.innerText = showButton.innerText === "show" ? "hide" : "show";

            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        }

        function submitForm(event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            formData.append("register", "true");

            fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.replace(data.redirectUrl);
                        alert(data.message)
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error submitting form');
                });
        }
    </script>
</body>

</html>