## ruby

### 1  gem

```ruby
export http_proxy=http://localhost:8118   win 使用 set
export https_proxy=http://localhost:8118 
gem update --system



查看当前使用的gem源
gem source -l
删除源
gem source -r 地址    gem sources --remove https://rubygems.org/
添加源
gem source -a 地址    gem sources --add https://gems.ruby-china.com/
  
gem版本
gem -v

gem查看当前ruby环境
gem env

gem update


dig api.rubygems.org   dig api.ruby-china.com  ???
dig api.rubygems.org +short  dig api.gems.ruby-china.com +short  ????


gem install jekyll     gem update jekyll
gem install bundler    gem update bundler

jekyll安装依赖
bundle install
jekyll构建网站并启动一个本地 web服务   http://localhost:4000
jekyll server 报错使用下一行
bundle exec jekyll server
```

