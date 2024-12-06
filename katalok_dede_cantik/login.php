<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('kementerian_pertahanan_republik_indonesia_cover.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
        }
        .login-container {
            position: relative; /* Set position relative for the waves */
            background: white; /* Solid white background */
            padding: 5rem; /* Adjust padding */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 600px; /* Adjust width for a larger container */
            overflow: hidden; /* Prevent overflow for wave effect */
        }
        
        
        
        /* Wave Animation */
        .wave {
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 200%; /* Wider for a smoother wave */
            height: 50px; /* Height of the wave */
            background: rgba(0, 123, 255, 0.6); /* Light blue color */
            border-radius: 50%;
            animation: wave-animation 4s infinite linear;
            transform: translateX(-50%); /* Center the wave */
        }

        @keyframes wave-animation {
            0% {
                transform: translateX(-50%) translateY(0); /* Start position */
            }
            50% {
                transform: translateX(-50%) translateY(-10px); /* Move up */
            }
            100% {
                transform: translateX(-50%) translateY(0); /* Return to start */
            }
        }

        h2 {
            text-align: center; /* Center align the heading */
            font-size: 2rem; /* Increase font size */
            margin-bottom: 2rem; /* Margin for spacing */
        }

        .form-control {
            font-size: 1.25rem; /* Increase font size of inputs */
        }

        
    </style>
    <br>
    <br>
    <br>
    <br>
</head>
<body>
    <div class="login-container">
        <div class="wave"></div> <!-- Wave element -->
        <h2>Login Admin</h2>
        <form action="login_process.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <a href="index.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
            Swal.fire({
                title: "Login Gagal!",
                text: "Username atau password yang Anda masukkan salah.",
                icon: "error"
            });
        <?php endif; ?>
    </script>
</body>
</html>
