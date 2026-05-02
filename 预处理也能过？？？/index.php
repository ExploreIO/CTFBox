<?php
include 'config.php';
session_start();
function login($con){
    $username = @$_POST["login_user"];
    $password = @$_POST["login_password"];

    $sql = "SELECT username, password FROM users WHERE username = ? AND password = ?";
    # 下面开始预处理输出的username和password，所以这两个参数是安全的
    $stmt = $con->prepare($sql);

    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();

    $res = $stmt->get_result();
    
    $row = $res->fetch_row(); 

    # row一共有两个内容，索引0是username，1是password
    if($row){
        return $row[0]; 
    } else {
        return 0;
    }
}

$login = login($con);

if($login!==0){
    $_SESSION["username"] = $login;
    setcookie("Auth", 1, time()+3600);
    # cookie 持续一个小时
    echo "<script>alert('用户登录成功'); window.location.href='logged-in.php';</script>";
    # 跳转页面
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户登录</title>
    <style>
        /* 基础重置与字体 */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f4f6f8; /* 浅灰背景 */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* 登录卡片容器 */
        .login-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* 柔和的阴影 */
            width: 100%;
            max-width: 320px;
            text-align: center;
        }

        /* 标题样式 */
        .login-card h1 {
            margin-top: 0;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        /* 表单元素布局 */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* 确保padding不撑大宽度 */
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        /* 输入框聚焦效果 */
        input:focus {
            border-color: #007BFF;
            outline: none;
        }

        /* 登录按钮 */
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007BFF; /* 简洁蓝 */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
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
            color: #007BFF;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h1>登录</h1>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" id="username" name="login_user" placeholder="请输入用户名" required>
            </div>
            
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" id="password" name="login_password" placeholder="请输入密码" required>
            </div>

            <input type="submit" value="登录">
        </form>
        
        <a href="new_user.php" class="footer-link">创建新用户</a>
    </div>

</body>
</html>

