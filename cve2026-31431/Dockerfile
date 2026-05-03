# 基于 Debian 13 (Trixie)，和你的宿主机内核最匹配
FROM debian:trixie-slim

# 设置标签
LABEL description="CVE-2026-31431 漏洞靶场 - 仅限本地隔离环境使用"

# 避免安装过程中卡在交互界面
ENV DEBIAN_FRONTEND=noninteractive

# 更新源并安装必要工具
RUN apt-get update && apt-get install -y --no-install-recommends \
    python3 \
    netcat-openbsd \
    vim \
    wget \
    curl \
    procps \
    psmisc \
    build-essential \
    && rm -rf /var/lib/apt/lists/*

# 创建一个低权限普通用户
RUN useradd -m -s /bin/bash victim

# 设置工作目录
WORKDIR /lab

# 把 PoC 脚本复制进镜像，并放在 victim 用户的家目录下也留一份
COPY cve2026-31431.py /lab/cve2026-31431.py
RUN chmod +x /lab/cve2026-31431.py
RUN cp /lab/cve2026-31431.py /home/victim/

# 把 /lab 和 victim 家目录的所有权给 victim
RUN chown -R victim:victim /lab /home/victim/cve2026-31431.py

# 关键：以普通用户 victim 身份启动容器
USER victim

# 默认启动命令
CMD ["/bin/bash"]
