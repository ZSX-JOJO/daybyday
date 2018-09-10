// function successCallback(result) {
//   console.log("It succeeded with " + result);
// }

// function failureCallback(error) {
//   console.log("It failed with " + error);
// }
// //方式1 node报错
// // doSomething(successCallback, failureCallback);

// //方式2 node报错
// var promise = doSomething(); 
// promise.then(successCallback, failureCallback);



// new Promise((resolve, reject) => {
//   console.log('Initial');

//   resolve();
// })
// .then(() => {
//   throw new Error('Something failed');
      
//   console.log('Do this');//由于Something failed错误导致了拒绝操作,所以Do this 文本并未输出
// })
// .catch(() => {
//   console.log('Do that');
// })
// .then(() => {
//   console.log('Do this whatever happened before');
// });


  var CDNs = [
    {
      name: 'jQuery.com',
      url: 'https://code.jquery.com/jquery-3.1.1.min.js'
    },
    {
      name: 'googleapis.com',
      url: 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'
    }
  ];

  console.log(`------`);
  console.log(`jQuery is: ${window.jQuery}`);

  Promise.race([
    import(CDNs[0].url).then(()=>console.log(CDNs[0].name, 'loaded')),
    import(CDNs[1].url).then(()=>console.log(CDNs[1].name, 'loaded'))
  ]).then(()=> {
    console.log(`jQuery version: ${window.jQuery.fn.jquery}`);
  });