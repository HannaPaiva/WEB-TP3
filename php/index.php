<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div style="text-align: center;">
    <h2>Login</h2>
    <form action="php/login.php" method="post">
        <div style="margin: 10px">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>
        <div style="margin: 10px">
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
        <div style="margin: 10px">   
            <input type="submit" value="Login">
        </div>
    </form>
</div>
</body>
</html>
