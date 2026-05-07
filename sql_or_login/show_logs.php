<?php
session_start();
include 'config.php';
include 'logs.php';

// 不是admin连页面都看不到
if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    echo '<script>alert("你不是管理员，无法查看日志");window.location.href="admin.php";</script>';
    exit;
}

$output = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $con->prepare("SELECT paSsWoRd FROM UsErS WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if ($password === $row['paSsWoRd']) {
            $_SESSION['username'] = $username;
            
            if ($_SESSION['username'] == 'admin') {
                $output = '<pre style="color:#00ff88;font-size:11px;text-align:left;">' . $log . '</pre>';
                $output .= '<div style="color:#ffcc00;font-size:13px;text-align:center;margin-top:10px;text-shadow:2px 2px 0 #332200;"><' . $flag . '></div>';
            }
        } else {
            $output = '<div class="msg">[!] 你是admin吗???，我保持怀疑</div>';
        }
    } else {
        $output = '<div class="msg">[!] 你是admin吗???，我保持怀疑</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIEW_LOGS</title>
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
            width: 650px;
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
            margin-bottom: 24px;
            letter-spacing: 3px;
        }
        
        .warning {
            text-align: center;
            color: #ffcc00;
            font-size: 10px;
            margin-bottom: 24px;
            padding: 14px;
            border: 2px solid #ffcc00;
            background: rgba(255,204,0,0.1);
            letter-spacing: 2px;
        }
        
        .msg {
            text-align: center;
            color: #ff4444;
            font-size: 10px;
            margin: 18px 0;
            padding: 12px;
            border: 2px solid #ff4444;
            background: rgba(255,0,0,0.1);
            animation: blink 0.8s infinite;
        }
        
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .log-output {
            margin-bottom: 24px;
            padding: 16px;
            border: 2px solid #1a1a3a;
            background: #000;
            max-height: 300px;
            overflow-y: auto;
        }
        
        .field {
            margin-bottom: 18px;
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
            letter-spacing: 3px;
            transition: all 0.1s;
            margin-bottom: 14px;
        }
        
        .btn:hover {
            background: #444488;
            border-bottom-color: #222266;
        }
        
        .btn:active {
            border-bottom-width: 2px;
            transform: translateY(2px);
        }
        
        .btn-back {
            background: #1a1a3a;
            border: 3px solid #333366;
            border-bottom-width: 3px;
        }
        
        .btn-back:hover {
            border-color: #00ff88;
            box-shadow: 0 0 15px rgba(0,255,136,0.2);
        }
        
        .info {
            text-align: center;
            margin-top: 20px;
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
        
        <h1 class="title">VIEW_LOGS</h1>
        <p class="sub">> SECURE_LOG_VIEWER</p>
        
        <div class="warning">
            [!] 需要再次输入管理员账号和密码
        </div>
        
        <?php if ($output): ?>
            <div class="log-output">
                <?php echo $output; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="field">
                <label>> USERNAME:_</label>
                <input type="text" name="username" placeholder="admin" required autocomplete="off">
            </div>
            <div class="field">
                <label>> PASSWORD:_</label>
                <input type="password" name="password" placeholder="********" required>
            </div>
            <button type="submit" class="btn">[ 验证身份 ]</button>
        </form>
        
        <button class="btn btn-back" onclick="window.location.href='admin.php'">[ 回到首页 ]</button>
        
        <p class="info">RESTRICTED_AREA // LOG_ACCESS</p>
    </div>
</body>
</html>