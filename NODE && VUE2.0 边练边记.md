# NODE && VUE2.0 边练边记

## 1：node安装以及 环境变量 （略。。。）

## 2： npm

​	（若执行 npm 某项命令时提示要求更高版本的 npm时 使用）

​	   npm install -g npm     or     npm update -g  【全局安装or 升级npm】
       cnpm install npm -g [使用淘宝镜像的命令]

​	设置npm代理

​		npm config set proxy http://地址:端口

​		npm config set https-proxy http://地址:端口

​	若代理需要认证

​		npm config set proxy http://username:password@server:port

​		npm config set https-proxy http://username:pawword@server:port

​	清除npm代理

​		npm config delete proxy

​		npm config delete https-proxy

        或者npm config set proxy null

​	查看`config`配置

​		npm config list

    清理缓存

        npm cache clean --force

    查看全局安装的模块

        npm list -g

    查看某个模块的版本号

        npm list 模块名称

    卸载模块

        npm uninstall 模块名称

    更新模块

        npm update 模块名称

    搜索模块

        npm search 模块名称

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

​		css预编译

​			

### 	4.3

​		遇到的问题：

​			问题？不存在的！依赖问题？挂代理再来一次就好了！其他？百度就好了！
            1.405 Method Not Allowed  [是否使用了代理?若报此错 关闭代理]

​		