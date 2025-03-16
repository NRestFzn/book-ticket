<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
  include("{$_SERVER['DOCUMENT_ROOT']}/controllers/AuthController.php");
  $email = $_POST['email'];
  $password = $_POST['password'];

  $controller = new AuthController();

  $user = $controller->login($email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/styles/_global.css">
  <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/pages/login/style.css">
  <title>Login</title>
</head>

<body>
  <h1>Login Form</h1>
  <form onsubmit="submitForm(event)" method="POST" class="login">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="ex: john@mail.com" required />

    <label for="password">Password:</label>
    <div class="password">
      <input type="password" id="password" name="password" placeholder="ex: johndoe123" required />
      <span id="show-password" onclick="showPassword()">show</span>
    </div>

    <input type="submit" name="login" value="Login" />
    <p><a href="<?php $_SERVER['DOCUMENT_ROOT']; ?>/pages/register">Don't have an account?</a></p>
  </form>

  <script>
    function showPassword() {
      const showButton = document.getElementById('show-password')
      const passwordInput = document.getElementById("password");

      showButton.innerText = showButton.innerText === "show" ? "hide" : "show";

      passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    }

    function submitForm(event) {
      event.preventDefault();

      const formData = new FormData(event.target);
      formData.append("login", "true");

      fetch('', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'ok') {
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