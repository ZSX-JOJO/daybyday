const express = require('express')
const router = express.Router()

router.get('/:name', function (req, res) {
  // res.send('hello, ' + req.params.name)
  res.render('users',{
  	name:req.params.name
  })
})

module.exports = router