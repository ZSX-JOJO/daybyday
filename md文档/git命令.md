# git常用命令记录

## clone pull commit push等常用命令

```
clone: 下载代码
	栗子:git clone git地址
查看本地代码状态
	栗子: git status
				git cherry -v 查看未被传送到远程代码库的提交描述和说明
	状态:
		1.已暂存 （changes to be committed）
			所列的内容是在Index中的内容，commit之后进入Git Directory
		2.已修改 （changed but not updated）
			所列的内容是在Working Directory中的内容，add之后将进入Index
		3.未跟踪 （untracked files）
			所列的内容是尚未被Git跟踪的内容，add之后进入Index
	 将文件添加到index暂存:
	 		git add 监控工作区的状态树 把工作时的所有变化提交到暂存区,包括文件内容修改(modified)以及新文件(new),但						不包括被删除的文件
	 		git add -u 仅监控已经被add的文件(即tracked file),会将被修改的文件提交到暂存区。add -u 不会提									交新文件（untracked file）。（git add --update的缩写）
	 		git add -A 是上面两个功能的合集（git add --all的缩写）
	 	提交已暂存的文件:
	 			git commit -m "备注说明"
	pull: 更新远程代码
			栗子:git pull -u origin master:master  git pull 更新默认分支
			     git push origin --all
	  强制提交
	  	git push -f origin master
	  强制覆盖本地
	  	# 从远程仓库下载最新版本
			git fetch -all 
			# 将本地设为刚获取的最新的内容
			git reset --hard origin/master
					
					
我的码云仓库地址:
git@gitee.com:zhaoshouxin/daybyday.git
```

## 更改传输协议

```
git remote set-url origin git@gitee.com:zhaoshouxin/daybyday.git
```

### 奇葩问题:

```

```

## sshkey

### 	检查是否生成过ssh密钥

```
cd ~/.ssh/
```

### 	使用ssh-keygen命令生成ssh 密钥

```
以下命令在git bash中使用

ssh-keygen -t rsa
ssh-keygen -t rsa -C "XXXX"  生成时添加注释

生成文件的默认名称 id_rsa.pub 公钥 id_rsa 私钥  [命令行中 公钥 私钥 都可以自定义名称]
查看 cat ~/.ssh/id_rsa.pub

将生成的公钥添加到gitee  or github or 其他

测试是否成功
ssh -T git@gitee.com
ssh -T git@github.com
```

### 	Git配置多个SSH-Key

```
1 生成sshkey
ssh-keygen -t rsa -C 'zhaoshouxin@gitee.com' -f ~/.ssh/gitee_id_rsa   gitee使用
ssh-keygen -t rsa -C 'LOLZSXZXM@163.COM' -f ~/.ssh/github_id_rsa  github使用

2 添加配置文件
在 ~/.ssh 目录下新建一个config文件，添加如下内容（其中Host和HostName填写git服务器的域名，IdentityFile指定私钥的路径）  touch ~/.ssh/config
# gitee
Host gitee.com
HostName gitee.com
PreferredAuthentications publickey
IdentityFile ~/.ssh/gitee_id_rsa
# github
Host github.com
HostName github.com
PreferredAuthentications publickey
IdentityFile ~/.ssh/github_id_rsa

3 将生成的公钥添加到gitee github

4 测试是否成功
ssh -T git@gitee.com
ssh -T git@github.com
```

