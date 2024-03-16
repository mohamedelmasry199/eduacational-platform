////////////// Static Method  ////////////////
// var x = 1.5; // Starting Point

// var funct = x ** 2 * x + 4 * x ** 2 - 10; // Function
// var dervFunct = 3 * x ** 2 + 8 * x; // Dervities Of Function

// var nemominator = funct;
// var denominator = dervFunct;
// let x1 = x - nemominator / denominator;
// console.log(`X1 = ${x1}`);

// x = x1;
// var funct = x ** 2 * x + 4 * x ** 2 - 10;
// var dervFunct = 3 * x ** 2 + 8 * x;
// nemominator = funct;
// denominator = dervFunct;
// let x2 = x - nemominator / denominator;
// console.log(`X2 = ${x2}`);

// x = x2;
// var funct = x ** 2 * x + 4 * x ** 2 - 10;
// var dervFunct = 3 * x ** 2 + 8 * x;
// nemominator = funct;
// denominator = dervFunct;
// let x3 = x - nemominator / denominator;
// console.log(`X3 = ${x3}`);

// x = x3;
// var funct = x ** 2 * x + 4 * x ** 2 - 10;
// var dervFunct = 3 * x ** 2 + 8 * x;
// nemominator = funct;
// denominator = dervFunct;
// let x4 = x - nemominator / denominator;
// console.log(`X3 = ${x3}`);

///////////// Dynamiy Method /////////////////
// var result_dev = document.getElementById("result");
// var start_point = document.querySelector("#start_point").value;
// var a = document.querySelector("#a").value;
// var b = document.querySelector("#b").value;
// var c = document.querySelector("#c").value;
// var d = document.querySelector("#d").value;
// var array = [];
// var y;
// result_dev.innerHTML += `<h1>f(x) = ax^3 + bx^2 + cx + d </h1>`;

// function calculate() {
//   result_dev.innerHTML = "";
//   a = document.querySelector("#a").value;
//   b = document.querySelector("#b").value;
//   c = document.querySelector("#c").value;
//   d = document.querySelector("#d").value;
//   start_point = document.querySelector("#start_point").value;
//   result_dev.innerHTML += `<h1>f(x) = ${a}x^3 + ${b}x^2 + ${c}x + ${+d} </h1>`;
//   result_dev.innerHTML += `<h1>Starting Point : ${start_point} </h1>`;

//   for (let n = 0; n <= 4; n++) {
//     if (n === 0) {
//       var x = start_point; // Starting Point
//     } else {
//       var x = y;
//     }
//     var funct = +a * x ** 3 + +b * x ** 2 + +c * x + +d;
//     var dervFunct = 3 * +a * x ** 2 + +b * 2 * x + +c;
//     nemominator = funct;
//     denominator = dervFunct;
//     y = x - nemominator / denominator;

//     array.push(y);
//     var number = n - 1;

//     result_dev.innerHTML += `<h2> X${n} = ${y} </h2>`;
//     if (n > 0) {
//       if (array[number].toFixed(3) === y.toFixed(3)) {
//         break;
//       }
//     }
//   }
//   result_dev.innerHTML += `<h2> Your Root Is : ${y.toFixed(4)}</h2>`;
// }
///////////////////////
var result_dev = document.getElementById("result");
var start_point = document.querySelector("#start_point").value;
var a = document.querySelector("#a").value;
var b = document.querySelector("#b").value;
var c = document.querySelector("#c").value;
var d = document.querySelector("#d").value;
var array = [];
var y;
result_dev.innerHTML += `<h1>f(x) = ax^3 + bx^2 + cx + d </h1>`;

function calculate() {
  result_dev.innerHTML = "";
  a = document.querySelector("#a").value;
  b = document.querySelector("#b").value;
  c = document.querySelector("#c").value;
  d = document.querySelector("#d").value;
  start_point = document.querySelector("#start_point").value;
  result_dev.innerHTML += `<h1>f(x) = ${a}x^3 + ${b}x^2 + ${c}x + ${+d} </h1>`;
  result_dev.innerHTML += `<h1>Starting Point : ${start_point} </h1>`;

  var prevY = null;
  for (let n = 0; n <= 4; n++) {
    if (n === 0) {
      var x = start_point; // Starting Point
    } else {
      var x = y;
    }
    var funct = +a * x ** 3 + +b * x ** 2 + +c * x + +d;
    var dervFunct = 3 * +a * x ** 2 + +b * 2 * x + +c;
    nemominator = funct;
    denominator = dervFunct;
    y = x - nemominator / denominator;

    array.push(y);
    var number = n - 1;

    result_dev.innerHTML += `<h2> X${n} = ${y} </h2>`;
    if (prevY !== null && prevY.toFixed(3) === y.toFixed(3)) {
      break;
    }
    prevY = y;
  }

  result_dev.innerHTML += `<h2> Your Root Is : ${y.toFixed(4)}</h2>`;
}
