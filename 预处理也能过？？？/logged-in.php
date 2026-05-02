<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    die('请先登录');
}

if (isset($_POST['submit'])) {
    
    $username = $_SESSION["username"];
    $curr_pass = $_POST["current_password"];
    $new_pass = $_POST["new_password"];
    
    $sql = "UPDATE users SET password=? WHERE username='$username' AND password=?";
    $stmt = $con->prepare($sql);
    
    if ($stmt === false) {
        die('SQL 预处理失败: ' . $con->error);
    }
    
    $stmt->bind_param("ss", $new_pass, $curr_pass);
    $stmt->execute();
    
    //直接用 affected_rows
    $ant = $stmt->affected_rows;
    
    if ($ant == 1) {
        echo '执行成功';
    } else {
        echo '当前密码错误或修改失败';
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改密码</title>
    <style>
        /* 基础重置 - 保持全局风格一致 */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* 卡片容器 */
        .edit-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 360px; /* 稍微加宽一点点以容纳文字 */
            text-align: center;
        }

        .edit-card h1 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        /* 提示语样式 */
        .notice-box {
            background-color: #fff8e1; /* 浅黄色背景 */
            color: #856404; /* 深黄色文字 */
            padding: 12px;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 30px;
            border-left: 4px solid #ff9800; /* 左侧橙色线条装饰 */
            text-align: left;
            line-height: 1.5;
        }

        /* 输入框样式 */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #ff9800; /* 聚焦时变为橙色 */
            outline: none;
        }

        /* 提交按钮 - 橙色系 */
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #ff9800; 
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #f57c00;
        }

        /* 底部链接 */
        .footer-link {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            text-decoration: none;
        }

        .footer-link:hover {
            color: #ff9800;
        }
    </style>
</head>
<body>

    <div class="edit-card">
        <h1>修改密码</h1>
        <div class="welcome-msg">
            欢迎 <?php echo $_SESSION["username"]; ?> 到来
        </div>
        <!-- 提示语区域 -->
        <div class="notice-box">
            恭喜你登录成功，需要修改密码吗？
        </div>

        <form name="mylogin" method="POST">
            <div class="form-group">
                <input type="password" name="current_password" placeholder="请输入当前密码" required>
            </div>
            
            <div class="form-group">
                <input type="password" name="new_password" placeholder="请输入新密码" required>
            </div>

            <input type="submit" name="submit" value="确认修改">
        </form>
        
        <a href="index.php" class="footer-link">回到首页</a>
    </div>

</body>
</html>

