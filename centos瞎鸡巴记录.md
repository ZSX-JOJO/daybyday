## 快捷键:

自定义终端 /usr/bin/gnome-terminal  名称 Terminal

## 系统相关:

man ??  // 查看？？命令的信息

uname -a // 查看内核信息

kill -9 pid // 强制终止某个进程号 pid

-----------------------------------------------------------

## 配置文件：

/etc/hosts`私有 IP 对应主机名

/etc/resolv.conf`nameserver DNS 的 IP

/etc/sysconfig/network`其中 NETWORKING = 要不要有网络，HOSTNAME = 主机名，NETWORKING_IPV6 = 支持 ipv6 否

/etc/sysconfig/network-scripts/ifcfg-xxx`其中 DEVICE = 网卡代号，BOOTPROTO = 是否使用 dhcp，HWADDR，IPADDR，NETMASK，ONBOOT，GATEWAY

## 网络相关的一些命令：

route -n`查看路由的命令，特别是要看带 G 的，表示 gateway，而带 U 的表示 up。

netstat -anp`查看所有启动的`tcp`,`udp`,`unix stream`的应用程序，以及他们的状态

## CPU：

top 特别注意 load

ps aux`和`ps -ef` 特别注意进程状态

vmstat 1`表示每秒采集一次

sar -u 1` 查看所有 cpu 相关的运行时间

## Memory：

 free

 vmstat 1 注意其中的 swap ram block 之间的关系

 sar -r 1 内存使用率

  sar -W 1   查看 swap，查询是否由于内存不足产生大量内存交换

## IO：

  lsof -i:port  查询哪个进程占用了这个端口号

  lsof -u username  用户打开的文件

  lsof -p pid  进程打开的文件

## 其他:

切换到root用户  su root

## 重要命令:

find