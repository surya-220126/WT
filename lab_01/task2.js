//simple function
function greet(name) {
    document.writeln("Hello, " + name + "! Welcome to the course.<br><br>");
}
// Function call
greet("Surya");

//arrow functions
// Declare variables
let num1 = 10;
let num2 = 5;
//addition
const add = (a, b) => a + b;

// Arrow function for subtraction
const subtract = (a, b) => a - b;

// Display results using document.write
document.write("Addition of " + num1 + " and " + num2 + " = " + add(num1, num2) + "<br><br>");
document.write("Subtraction of " + num1 + " and " + num2 + " = " + subtract(num1, num2) + "<br>");

