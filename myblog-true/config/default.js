/*
port: 程序启动要监听的端口号
session: express-session 的配置信息，
mongodb: mongodb 的地址，以 mongodb:// myblog-true 为 db 名
 */
module.exports = {
  port: 3000,
  session: {
    secret: 'myblog-true',
    key: 'myblog',
    maxAge: 2592000000
  },
  mongodb: 'mongodb://localhost:27017/myblog-true'
}
