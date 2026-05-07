<?php
session_start();
include 'config.php';

$sql = "SELECT id, username, paSsWoRd FROM UsErS WHERE username != 'admin'";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER_LIST</title>
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
            margin-bottom: 30px;
            letter-spacing: 3px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 28px;
        }
        
        th {
            color: #6688cc;
            font-size: 11px;
            text-align: left;
            padding: 14px 12px;
            border-bottom: 3px solid #333366;
            letter-spacing: 2px;
        }
        
        td {
            color: #00ff88;
            font-size: 10px;
            padding: 14px 12px;
            border-bottom: 1px solid #1a1a3a;
            letter-spacing: 1px;
        }
        
        tr:hover td {
            background: rgba(0,255,136,0.05);
        }
        
        .btn {
            width: 100%;
            padding: 18px;
            background: #1a1a3a;
            border: 3px solid #333366;
            color: #00ff88;
            font-family: 'Press Start 2P', cursive;
            font-size: 13px;
            cursor: pointer;
            letter-spacing: 3px;
            transition: all 0.1s;
        }
        
        .btn:hover {
            border-color: #00ff88;
            box-shadow: 0 0 15px rgba(0,255,136,0.2);
        }
        
        .btn:active {
            transform: translateY(2px);
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
        
        <h1 class="title">USER_LIST</h1>
        <p class="sub">> EMPLOYEE_RECORDS v1.2</p>
        
        <table>
            <tr>
                <th>USERNAME</th>
                <th>PASSWORD</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo substr($row['paSsWoRd'], 0, -3) . '***'; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        
        <button class="btn" onclick="window.location.href='admin.php'">[ 回到首页 ]</button>
        
        <p class="info">CONFIDENTIAL // INTERNAL_USE_ONLY</p>
    </div>
</body>
</html>