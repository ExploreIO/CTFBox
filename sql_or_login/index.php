<?php
include 'config.php';
include 'check.php';
session_start();

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (!check($username, $hack) || !check($password, $hack)) {
        $msg = 'ACCESS DENIED';
    } else {
        $sql = "SELECT * FROM UsErS WHERE username='$username' and paSsWoRd='$password'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            $_SESSION['username'] = $row['username'];
            header('Location:admin.php');
            exit;
        } else {
            $msg = 'ACCESS DENIED';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYS.LOGIN</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #1a1a2e;
            font-family: 'Press Start 2P', cursive;
            image-rendering: pixelated;
        }
        
        .crt {
            width: 600px;
            padding: 40px 36px;
            background: #0d0d1a;
            border: 4px solid #4a4a8a;
            box-shadow: 
                inset 0 0 60px rgba(0,0,0,0.8),
                0 0 20px rgba(74,74,138,0.4),
                8px 8px 0 #000;
            position: relative;
            overflow: hidden;
        }
        
        .crt::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,0,0,0.08) 2px,
                rgba(0,0,0,0.08) 4px
            );
            pointer-events: none;
            z-index: 10;
        }
        
        .decor {
            display: flex;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        
        .decor span {
            color: #333366;
            font-size: 14px;
        }
        
        .title {
            color: #00ff88;
            font-size: 20px;
            text-align: center;
            letter-spacing: 3px;
            margin-bottom: 10px;
            text-shadow: 3px 3px 0 #003322;
        }
        
        .sub {
            color: #339966;
            font-size: 11px;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 3px;
        }
        
        .msg {
            text-align: center;
            color: #ff4444;
            font-size: 11px;
            margin-bottom: 24px;
            padding: 12px;
            border: 2px solid #ff4444;
            background: rgba(255,0,0,0.1);
            text-shadow: 2px 2px 0 #440000;
            animation: blink 0.8s infinite;
        }
        
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .field {
            margin-bottom: 24px;
        }
        
        .field label {
            display: block;
            color: #6688cc;
            font-size: 11px;
            margin-bottom: 10px;
            letter-spacing: 3px;
        }
        
        .field input {
            width: 100%;
            padding: 14px;
            background: #000;
            border: 3px solid #333366;
            color: #00ff88;
            font-family: 'Press Start 2P', cursive;
            font-size: 12px;
            outline: none;
        }
        
        .field input:focus {
            border-color: #00ff88;
            box-shadow: 0 0 10px rgba(0,255,136,0.3);
        }
        
        .btn {
            width: 100%;
            padding: 18px;
            background: #333366;
            border: none;
            border-bottom: 4px solid #1a1a4a;
            color: #00ff88;
            font-family: 'Press Start 2P', cursive;
            font-size: 13px;
            cursor: pointer;
            letter-spacing: 4px;
            margin-top: 14px;
            transition: all 0.1s;
        }
        
        .btn:hover {
            background: #444488;
            border-bottom-color: #222266;
        }
        
        .btn:active {
            border-bottom-width: 2px;
            transform: translateY(2px);
        }
        
        .info {
            text-align: center;
            margin-top: 26px;
            color: #333366;
            font-size: 9px;
            letter-spacing: 3px;
        }
    </style>
</head>
<body>
    <div class="crt">
        <div class="decor">
            <span>[##]</span>
            <span>[##]</span>
            <span>[##]</span>
        </div>
        
        <h1 class="title">SYS.LOGIN</h1>
        <p class="sub">> SYSTEM_AUTH v2.1</p>
        
        <?php if ($msg): ?>
            <div class="msg">[!] <?php echo $msg; ?></div>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div class="field">
                <label>> USERNAME:_</label>
                <input type="text" name="username" placeholder="********" required autocomplete="off">
            </div>
            <div class="field">
                <label>> PASSWORD:_</label>
                <input type="password" name="password" placeholder="********" required>
            </div>
            <button type="submit" class="btn">[ AUTH ]</button>
        </form>
        
        <p class="info">SECURE_CHANNEL // ENCRYPTED</p>
    </div>
</body>
</html>