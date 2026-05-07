<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location:index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN_PANEL</title>
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
            margin-bottom: 14px;
            letter-spacing: 3px;
        }
        
        .welcome {
            text-align: center;
            color: #6688cc;
            font-size: 12px;
            margin-bottom: 36px;
            padding: 14px;
            border: 2px solid #333366;
            background: rgba(102,136,204,0.1);
        }
        
        .menu {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        
        .menu button {
            width: 100%;
            padding: 20px;
            background: #1a1a3a;
            border: 3px solid #333366;
            color: #00ff88;
            font-family: 'Press Start 2P', cursive;
            font-size: 13px;
            cursor: pointer;
            letter-spacing: 2px;
            transition: all 0.1s;
            text-align: left;
        }
        
        .menu button::before {
            content: '>';
            margin-right: 14px;
            color: #4a4a8a;
        }
        
        .menu button:hover {
            border-color: #00ff88;
            background: #222244;
            box-shadow: 0 0 15px rgba(0,255,136,0.2);
        }
        
        .menu button:active {
            transform: translateY(2px);
            border-bottom-width: 1px;
        }
        
        .info {
            text-align: center;
            margin-top: 30px;
            color: #333366;
            font-size: 10px;
            letter-spacing: 3px;
        }
        
        .status {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            color: #333366;
            font-size: 10px;
        }
        
        .status .online {
            color: #00ff88;
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
        
        <h1 class="title">ADMIN_PANEL</h1>
        <p class="sub">> SYSTEM_CONTROL v2.1</p>
        
        <div class="welcome">
            > WELCOME: <?php echo $_SESSION['username']; ?>
        </div>
        
        <div class="menu">
            <button onclick="window.location.href='show_logs.php'">
                [1] 查看日志
            </button>
            <button onclick="window.location.href='show_users.php'">
                [2] 人员名单
            </button>
            <button onclick="window.location.href='reset_password.php'">
                [3] 重置密码
            </button>
        </div>
        
        <div class="status">
            <span class="online">● ONLINE</span>
            <span>ENC: AES-256</span>
            <span>PORT: 443</span>
        </div>
        
        <p class="info">SECURE_ADMIN // ROOT_ACCESS</p>
    </div>
</body>
</html>