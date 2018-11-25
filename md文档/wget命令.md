# wget 命令

## 打包下载整站

```JavaScript
wget --mirror -p --convert-links -P /var/www/html http://www.auicss.com/
```

## 下载文件

```JavaScript
wget http://www.linuxde.net/text.iso                       #不用参数，直接下载文件
```

## 下载文件并重命名

```JavaScript
wget -O rename.zip http://www.linuxde.net/text.iso         #O大写
```

## 断点续传

```JavaScript
wget -c http://www.linuxde.net/text.iso                    #c小写
```

## 限速下载

```JavaScript
wget --limit-rate=50k http://www.linuxde.net/text.iso
```

## 显示响应头部信息

```JavaScript
wget --server-response http://www.linuxde.net/test.iso
```

## 设置代理

```JavaScript
wget  -e "http_proxy=http://127.0.0.1:1080" http://www.baidu.com/
```



# curl命令

## 下载文件

```JavaScript
curl -O http://man.linuxde.net/text.iso                    #O大写，不用O只是打印内容不会下载
```

## 下载文件并重命名

```JavaScript
curl -o rename.iso http://man.linuxde.net/text.iso         #o小写
```

## 断点续传

```JavaScript
curl -O -C -URL http://man.linuxde.net/text.iso            #C大写
```

## 限速下载

```JavaScript
curl --limit-rate 50k -O http://man.linuxde.net/text.iso
```

## 显示响应头部信息

```JavaScript
curl -I http://man.linuxde.net/text.iso
```

