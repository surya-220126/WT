<?php
session_start();


if (!isset($_SESSION['github_user'])) {
    header("Location: github_index.html");
    exit();
}


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: github_index.html");
    exit();
}

$username = $_SESSION['github_user'];
$avatar = $_SESSION['github_avatar'] ?? 'https://avatars.githubusercontent.com/u/0?v=4';
$name = $_SESSION['github_name'] ?? 'GitHub User';
$id = $_SESSION['github_id'] ?? 'N/A';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background-color: #000000;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 2px,
                    rgba(255, 255, 255, 0.02) 2px,
                    rgba(255, 255, 255, 0.02) 4px
                );
            pointer-events: none;
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 600px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
            border-bottom: 3px solid #ffffff;
            padding-bottom: 30px;
            animation: fadeInDown 0.8s ease;
        }

        .header::before {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background-color: #ffffff;
            margin: 0 auto 20px;
            animation: expandWidth 0.6s ease;
        }

        .header h1 {
            font-size: 48px;
            font-weight: 300;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 10px;
            font-style: italic;
        }

        .header p {
            font-size: 13px;
            letter-spacing: 2px;
            color: #cccccc;
            text-transform: uppercase;
        }

       
        .profile-card {
            background-color: #ffffff;
            color: #000000;
            padding: 50px;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 0.8s ease 0.2s both;
            position: relative;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #000000;
        }

        .avatar-container {
            display: flex;
            justify-content: center;
            margin-bottom: 35px;
        }

        .avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #000000;
            background-color: #f0f0f0;
        }

        .profile-name {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
        }

        .profile-name h2 {
            font-size: 32px;
            font-weight: 300;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .profile-username {
            font-size: 16px;
            color: #666666;
            font-style: italic;
            letter-spacing: 0.5px;
        }

        .badge-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .badge {
            background-color: #000000;
            color: #ffffff;
            padding: 6px 16px;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 2px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-item {
            text-align: center;
        }

        .info-label {
            font-size: 10px;
            color: #999999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: block;
        }

        .info-value {
            font-size: 18px;
            font-weight: 500;
            color: #000000;
            font-family: 'Courier New', monospace;
        }

        
        .action-buttons {
            display: flex;
            gap: 12px;
            flex-direction: column;
        }

        .btn {
            padding: 14px 20px;
            border: 2px solid;
            background-color: #ffffff;
            color: #000000;
            font-size: 13px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            border-radius: 2px;
        }

        .btn-primary {
            border-color: #000000;
            background-color: #000000;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #ffffff;
            color: #000000;
        }

        .btn-secondary {
            border-color: #000000;
            background-color: #ffffff;
            color: #000000;
        }

        .btn-secondary:hover {
            background-color: #000000;
            color: #ffffff;
        }

        .btn-danger {
            border-color: #ff0000;
            background-color: #ffffff;
            color: #ff0000;
        }

        .btn-danger:hover {
            background-color: #ff0000;
            color: #ffffff;
        }

       
        .footer-accent {
            text-align: center;
            color: #999999;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 40px;
        }

        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes expandWidth {
            from {
                width: 0;
            }
            to {
                width: 60px;
            }
        }

      
        @media (max-width: 600px) {
            .profile-card {
                padding: 35px 25px;
            }

            .header h1 {
                font-size: 36px;
                letter-spacing: 2px;
            }

            .avatar {
                width: 120px;
                height: 120px;
            }

            .profile-name h2 {
                font-size: 26px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                padding: 12px 16px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Dashboard</h1>
            <p>Welcome</p>
        </div>

        <div class="profile-card">
            <div class="avatar-container">
                <img src="<?php echo htmlspecialchars($avatar); ?>" alt="Profile" class="avatar">
            </div>

            <div class="profile-name">
                <h2><?php echo htmlspecialchars($name ?: $username); ?></h2>
                <div class="profile-username">@<?php echo htmlspecialchars($username); ?></div>
            </div>

            <div class="badge-container">
                <span class="badge">Verified</span>
                <span class="badge">Active</span>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Username</span>
                    <span class="info-value"><?php echo htmlspecialchars($username); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">ID</span>
                    <span class="info-value"><?php echo htmlspecialchars($id); ?></span>
                </div>
            </div>

            <div class="action-buttons">
                <a href="https://github.com/<?php echo htmlspecialchars($username); ?>" target="_blank" class="btn btn-primary">
                    View GitHub Profile
                </a>
                <a href="?logout=true" class="btn btn-danger">
                    Sign Out
                </a>
            </div>
        </div>

        <div class="footer-accent">
            ✦ Secure Session Active ✦
        </div>
    </div>

</body>
</html>
