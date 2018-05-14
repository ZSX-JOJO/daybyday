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
var util = require('util');//实用工具 具体参考node官方文档

var Person = function(name){
	this.name = name;
};

util.inherits(Person,events.EventEmitter);

var xiaoming = new Person('xiaoming');
var lili = new Person('lili');
var lucy = new Person('lucy');

var person = [xiaoming,lili,lucy];

person.forEach(function(person){
	person.on('speak',function(message){
		console.log(person.name + " said: " + message);
	});
});

xiaoming.emit('speak', 'hi');
lucy.emit('speak', 'I want a curry');
// var myEmitter = new events.EventEmitter();
// myEmitter.on('someEvent',function(message){
// 	console.log(message);
// });
// myEmitter.emit('someEvent','the envent was emitted');