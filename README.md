# CTFBox 🛡️

> 🚀 一个持续更新的 CTF 题目开源合集，旨在分享高质量的网络安全挑战与解题思路。

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Status](https://img.shields.io/badge/status-updating-brightgreen.svg)](https://github.com/ExploreIO/CTFBox)

## 📖 项目简介

欢迎来到 **CTFBox**！这里是一个专为 CTF 爱好者、安全研究人员和学生打造的开源题库。

无论你是想练习 Web 渗透、逆向工程，还是对密码学感兴趣，这里都有适合你的挑战。本项目致力于提供**结构清晰**、**易于复现**的 CTF 题目环境，并附带详细的 Writeups（解题思路），帮助大家共同进步。

---

## 📂 题目分类

目前仓库包含以下几类题目（点击分类跳转）：

-   **🌐 Web 安全**：SQL注入、XSS、RCE、SSRF 等常见漏洞复现。
-   **🔐 密码学**：古典密码、现代加密算法分析、RSA/AES 攻击等。
-   **⚙️ 逆向工程**：Windows/Linux 下的二进制逆向分析。
-   **💥 Pwn**：栈溢出、堆利用等二进制漏洞挖掘。
-   **🔍 杂项**：流量分析、隐写术、编码转换等。

---

## 🛠️ 快速开始

想要运行这些题目？非常简单！请确保你本地已安装 **Docker** 和 **Docker Compose**。

1.  **克隆项目到本地：**
    ```bash
    git clone https://github.com/ExploreIO/CTFBox.git
    cd CTFBox
    ```

2.  **启动题目环境：**
    每一个题目的文件夹里面会有启动题目的说明

3.  **查看运行状态：**
    ```bash
    docker ps
    ```
    题目通常运行在 `http://127.0.0.1:端口`。

---

## 🤝 贡献指南

开源的力量在于分享！如果你发现题目中的错误，或者有好的题目想要分享，欢迎提交 Pull Request。

1.  Fork 本仓库
2.  创建你的特性分支 (`git checkout -b feature/AmazingFeature`)
3.  提交你的更改 (`git commit -m 'Add some amazing feature'`)
4.  推送到分支 (`git push origin feature/AmazingFeature`)
5.  打开一个 Pull Request

---

## ⚠️ 免责声明

本项目仅供网络安全学习和技术研究使用。**严禁利用本项目中的技术或代码进行非法攻击**。如因不当使用造成的任何后果，与本项目作者无关。

---

## 🌟 支持项目

如果你觉得 **CTFBox** 对你有帮助，请给本项目点一个 **Star** ⭐️！你的支持是我持续更新的最大动力。

**Happy Hacking!** 🎉
