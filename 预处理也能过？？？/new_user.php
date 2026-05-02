<?php
include 'config.php';
session_start();


// 检查是否提交表单
if (isset($_POST['submit'])) {
    $new_user = $_POST['new_username'];
    $new_pass = $_POST['new_password'];
    
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $new_user, $new_pass);
    
    if ($stmt->execute()) {
        echo "<script>alert('用户创建成功'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "创建失败: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新建用户</title>
    <style>
        /* 基础重置与字体 - 与登录页保持一致 */
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
        .register-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 320px;
            text-align: center;
        }

        .register-card h1 {
            margin-top: 0;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        /* 输入框样式 */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        input[type="text"],
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
            border-color: #28a745; /* 聚焦时变为绿色，呼应按钮 */
            outline: none;
        }

        /* 提交按钮 - 使用绿色表示“新增/成功” */
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745; 
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
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
            color: #28a745;
        }
    </style>
</head>
<body>

    <div class="register-card">
        <h1>新建用户</h1>
        <form method="post">
            <div class="form-group">
                <input type="text" name="new_username" placeholder="设置用户名" required>
            </div>
            
            <div class="form-group">
                <input type="password" name="new_password" placeholder="设置密码" required>
            </div>

            <input type="submit" name="submit" value="创建用户">
        </form>
        
        <a href="index.php" class="footer-link">回到首页</a>
    </div>

</body>
</html>