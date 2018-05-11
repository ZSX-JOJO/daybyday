// const path = require('path');
// const express = require('express');
// const app = express();
// // app.get('/',function(req,res){
// // 	res.send('hello,express')
// // })
// // app.get('/users/:name',function(req,res){
// // 	res.send('hello,'+req.params.name)
// // })
// const indexRouter = require('./routes/index');
// const userRouter = require('./routes/users');
// app.set('views', path.join(__dirname, 'views'))// 设置存放模板文件的目录
// app.set('view engine', 'ejs')// 设置模板引擎为 ejs
// app.use('/',indexRouter);
// app.use('/users',userRouter);
// app.listen(3000);


/**
 *ejs模板引擎
 */


// const express = require('express')
// const app = express()

// app.use(function (req, res, next) {
//   console.log('1')
//   next()
// })

// app.use(function (req, res, next) {
//   console.log('2')
//   res.status(200).end()
// })

// app.listen(3000)


const express = require('express')
const app = express()

app.use(function (req, res, next) {
  console.log('1')
  next(new Error('haha'))
})

app.use(function (req, res, next) {
  console.log('2')
  res.status(200).end()
})

//错误处理
app.use(function (err, req, res, next) {
  console.error(err.stack)
  res.status(500).send('Something broke!')
})

app.listen(3000)