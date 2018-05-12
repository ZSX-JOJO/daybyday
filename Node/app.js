// setTimeout(() =>{
// 	console.log("箭头函数");
// },3000);

// setTimeout(function(){
// 	console.log("传统函数");
// },3000);

/*
事件
*/
var events = require('events');
var myEmitter = new events.EventEmitter();
myEmitter.on('someEvent',function(message){
	console.log(message);
});
myEmitter.emit('someEvent','the envent was emitted');