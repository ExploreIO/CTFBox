<?php
session_start();
if($_SESSION['username']!='admin'){
    echo '<script>alert("你不是管理员");window.location.href="admin.php";</script>';
    exit;
}

// 处理验证码提交 - 永远返回message=0
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'verify') {
    $response = array(
        "status" => "success",
        "message" => "0"
    );
    echo json_encode($response);
    exit;
}

// 处理重置密码 - 漏洞点：只要data里的message=1就能改
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'reset') {
    $input = json_decode($_POST['data'], true);
    
    if ($input['message'] == '1') {
        $newpass = $_POST['newpass'];
        $username = 'admin';
        
        include 'config.php';
        $stmt = $con->prepare("UPDATE UsErS SET paSsWoRd = ? WHERE username = ?");
        $stmt->bind_param("ss", $newpass, $username);
        $stmt->execute();
        
        echo "密码重置成功！";
        exit;
    } else {
        echo "验证码错误";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESET_PASS</title>
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
        
        .phone-box {
            text-align: center;
            color: #6688cc;
            font-size: 12px;
            margin-bottom: 28px;
            padding: 14px;
            border: 2px solid #333366;
            background: rgba(102,136,204,0.1);
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
            margin-bottom: 18px;
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
        
        .field {
            margin-bottom: 18px;
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
        
        #resetBox {
            display: none;
            margin-top: 10px;
            margin-bottom: 18px;
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
        
        <h1 class="title">RESET_PASS</h1>
        <p class="sub">> PASSWORD_RECOVERY v1.0</p>
        
        <div class="phone-box">
            > PHONE: 19*******75
        </div>
        
        <button class="btn" onclick="sendCode()">[ 发送验证码 ]</button>
        
        <div class="field">
            <input type="text" id="code" placeholder="_VERIFY_CODE">
        </div>
        <button class="btn" onclick="verifyCode()">[ 提交验证码 ]</button>
        
        <div id="resetBox">
            <div class="field">
                <input type="password" id="newpass" placeholder="_NEW_PASSWORD">
            </div>
            <button class="btn" onclick="resetPass()">[ 确认重置 ]</button>
        </div>
        
        <button class="btn btn-back" onclick="window.location.href='admin.php'">[ 回到首页 ]</button>
        
        <p class="info">SECURE_RESET // 2FA_ENABLED</p>
    </div>
</body>
</html>

<script>
function sendCode() {
    alert("验证码已发送");
}

function verifyCode() {
    var code = document.getElementById("code").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        var res = JSON.parse(xhr.responseText);
        if (res.message == "1") {
            document.getElementById("resetBox").style.display = "block";
        } else {
            alert("验证码错误");
        }
    };
    xhr.send("action=verify&code=" + code);
}

function resetPass() {
    var newpass = document.getElementById("newpass").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        alert(xhr.responseText);
        window.location.href = "admin.php";
    };
    xhr.send("action=reset&data={\"status\":\"success\",\"message\":\"1\"}&newpass=" + newpass);
}
</script>