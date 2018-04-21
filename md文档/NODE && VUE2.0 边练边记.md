# NODE && VUE2.0 边练边记

## 1：node安装以及 环境变量 （略。。。）

## 2： npm 

​	（若执行 npm 某项命令时提示要求更高版本的 npm时 使用）

​	   npm install -g npm     or     npm update -g  【全局安装】 

### 	2.1 设置npm代理 

​		npm config set proxy http://地址:端口

​		npm config set https-proxy http://地址:端口

### 	2.2 若代理需要认证

​		npm config set proxy http://username:password@server:port

​		npm config set https-proxy http://username:pawword@server:port

### 	2.3 清除npm代理

​		npm config delete proxy

​		npm config delete https-proxy

### 	2.4 查看`config`配置

​		npm config list

## 3：nrm 

​	npm registry 管理工具 能够查看和切换当前使用的 registry

​	npm install -g nrm  【全局安装】

​	 nrm ls 【列出 可用的registry】

​		npm ---- https://registry.npmjs.org/
​		cnpm --- http://r.cnpmjs.org/

​		taobao - https://registry.npm.taobao.org/

​		nj ----- https://registry.nodejitsu.com/
​		rednpm - http://registry.mirror.cqupt.edu.cn/
​		npmMirror  https://skimdb.npmjs.com/registry/
​		edunpm - http://registry.enpmjs.org/

​	nrm use *** 【切换registry】

## 4：VUE 2.0  环境搭建

### 	4.1

​		vue-cli 脚手架构建工具

​			npm install -g vue-cli  【全局安装】

​			npm update vue-cli   【更新】

​			npm view vue-cli   【查看一下当前全局 vue-cli 的版本】

​		webpack

​			npm install webpack -g 【全局安装】

​		vue 路由模块 && 网络请求模块 【】

​			npm install vue-router vue-resource --save

### 	4.2

​		用 vue-cli 构建项目

​			1：选定目录 存放vue项目

​			2：vue init webpack 英文文件夹名称      【初始化一个项目  整个项目基于webpack 构建】

​			3：运行初始化命令的时  自定义输入信息

​			4：整个项目需要的依赖资源配置 存放于package.json中

​			5：定位到  " 英文文件夹名称"  运行 npm install

​			6：运行项目 npm run dev   

​				【 “run” 对应的是 package.json 文件中，scripts 字段中的 dev，也就是 node build/dev-server.js 	命令的一个快捷方式】

​			7：项目运行成功后，浏览器会自动打开 localhost:8080 (or 其他端口)

### 	4.3

​		遇到的问题：

​			问题？不存在的！依赖问题？挂代理再来一次就好了！其他？百度就好了！

# cmder 

```javascript
1、把 Cmder 加到环境变量 
把 Cmder.exe 存放的目录添加到系统环境变量； 
加完之后, Win+r 一下输入 cmder, 即可。

2、添加 cmder 到右键菜单：环境变量添加后，在任意文件夹中即可打开 Cmder，上一步的把 Cmder 加到环境变量就是为此服务的, 在管理员权限的终端输入以下语句即可: 
Cmder.exe /REGISTER ALL

3、为 Cmder.exe 创建快捷方式，右击 Cmder.exe 选择 “创建快捷方式” 点击即可，以后打开 Cmder.exe 只要点击桌面对应的快捷方式即可
```



# Electron

```javascript
1 electron-packager //electron打包工具
npm install -g electron-packager  

2 electron-builder //electron打包工具  ok的
npm install electron-builder -g
electron-builder --version
//查询命令
electron-builder -help
```

# bower  包管理工具

```javascript
npm install -g bower

.bowerrc //配置文件
{
  "directory" : "js/lib" //自定义位置
}
1 bower 初始化
bower init //在项目目录下 执行  初始化
2 包的安装
bower install 库的名字 --save //包的安装   --save参数是保存配置到你的bower.json
3 包的信息
bower info 库的名称  //  查找库的版本(所有) 
4 包的更新
直接修改bower.json文件中的 库 版本号
"dependencies": {
    "jquery": "~1.11.3"
  }
bower update //执行 进行更新
5 包的查找
bower search 库的名字 
6 包的卸载
bower uninstall //库的名字
7 当前应用中 安装的包
bower list
8 查找单个包信息
bower info 名字#版本号
```

# express  (Node 应用框架)

```JavaScript

```

