<?php

session_start();

// If already logged in, go straight to manage page
if (isset($_SESSION["admin"])) {
    header("Location: manage.php");
    exit();
}

require_once("settings.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitise username input (never trust user input)
    $username = trim($_POST["username"] ?? "");

    // Do NOT escape the password — it is never placed raw into SQL;
    // it is verified with password_verify() against the stored hash.
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $error = "Please enter both username and password.";
    } else {
        // Use a prepared statement to avoid SQL injection entirely
        $stmt = $conn->prepare(
            "SELECT id, username, password FROM users WHERE username = ?"
        );

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $row = $result->fetch_assoc();

                // password_verify() is safe against timing attacks
                if (password_verify($password, $row["password"])) {
                    // Regenerate session ID on privilege change (session fixation)
                    session_regenerate_id(true);

                    $_SESSION["admin"]    = true;
                    $_SESSION["username"] = $row["username"];

                    header("Location: manage.php");
                    exit();
                }
            }

            $stmt->close();
        }

        // Generic message — do not reveal whether username exists
        $error = "Invalid username or password.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Manager Login</title>
    <link rel="stylesheet" href="styles/unified.css">
    <style>
        /* ── login-specific overrides ── */
        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 60vh;
        }

        .login-box {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 2rem 2.5rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
        }

        .login-box h2 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .login-box label {
            display: block;
            margin-bottom: .3rem;
            font-weight: bold;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: .55rem .75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        .login-box input[type="submit"] {
            width: 100%;
            padding: .65rem;
            background-color: #0056b3;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }

        .login-box input[type="submit"]:hover {
            background-color: #003d80;
        }

        .error-msg {
            background: #ffe0e0;
            border: 1px solid #f5a5a5;
            color: #900;
            padding: .6rem .9rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            font-size: .95rem;
        }
    </style>
</head>
<body>

<?php include 'header.inc'; ?>
<?php include 'nav.inc'; ?>

<div class="form-container login-wrapper">
    <div class="login-box">

        <h2>HR Manager Login</h2>

        <?php if ($error !== ""): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post" action="login.php">

            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                autocomplete="username"
                value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                required>

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="current-password"
                required>

            <input type="submit" value="Login">

        </form>

    </div>
</div>

<?php include 'footer.inc'; ?>

</body>
</html>
