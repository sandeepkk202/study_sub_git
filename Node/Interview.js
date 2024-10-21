// 1. Introduction to javascript
/*
    ES1 - 1997, ES2 - 1998, ES3 - 1999, ES4 - Abandoned (2003), ES5 - 2009, ES6 - 2015, ES7 - 2016, 
    ES8 - 2017, ES9 - 2018, ES10 - 2019, ES11 - 2020, ES12 - 2021, ES13 - 2022, ES14 - 2023

    ----------------------------
    # JavaScript, which may have browser-specific behaviors.
    # ECMAScript includes features not present in JavaScript, such as support for class-based programming.

    ----------------------------
    # Main Features of ES:
        ECMAScript significantly enhanced JavaScript with features that bolstered its functionality, usability, and robustness for developers. Here’s a refined overview:

    # Object-Oriented Programming (OOP): Facilitates code organization and reuse through support for classes, inheritance, and objects.
    # Event-Driven Programming: Enables the creation of interactive web applications by allowing the code to respond to user actions, network requests, and other events efficiently.
    # Rich Set of Built-In Objects: Provides diverse objects for handling dates, regular expressions, and complex mathematical calculations, which aid in accomplishing various programming tasks.
    # Standard Library of Functions: Offers a broad collection of utility functions for tasks like string manipulation, array operations, making development faster and more efficient.
    # Error Handling: Improves code reliability and debuggability with structured error handling using try, catch, and finally blocks.

    ----------------------------
    # Major JavaScript Engines:
    - V8 (by Google) 
        // Used in: Chrome, Node.js, and other Chromium-based browsers (like Microsoft Edge).
    
    - SpiderMonkey (by Mozilla) 
        // Used in: Firefox.
    
    - JavaScriptCore (also known as Nitro) (by Apple) 
        // Used in: Safari, WebKit-based browsers.
    
    - Chakra (by Microsoft) 
        // Used in: Safari, WebKit-based browsers.
    
    - Hermes (by Facebook/Meta)
        // Used in: React Native.
*/

// 2. Scope (Scope means variable access.)
/* 
    ----------------------------
    var globalVar = "I'm global!";
    function test() {
        console.log(globalVar);  // Accessible here
    }
    test();  // Output: "I'm global!"
    
    ----------------------------
    function test() {
        var localVar = "I'm local!";
        console.log(localVar);  // Accessible here
    }
    test();  
    console.log(localVar);  // Error: localVar is not defined
    
    ----------------------------
    if (true) {
        let blockVar = "I'm block scoped!";
        console.log(blockVar);  // Accessible here
    }
    console.log(blockVar);  // Error: blockVar is not defined

    ----------------------------
    if (true) {
        var notBlockScoped = "I'm not block scoped!";
    }
    console.log(notBlockScoped);  // Output: "I'm not block scoped!"

    ----------------------------
    function outer() {
        let outerVar = "I'm outer!";
        
        function inner() {
            console.log(outerVar);  // Accessible here due to closure
        }
        
        return inner;
    }
    const innerFunc = outer();
    innerFunc();  // Output: "I'm outer!"

*/

// 3. IIFE (Immediately Invoked Function Expression)
/*
    # An IIFE is a JavaScript function that is defined and executed immediately after its creation.
    # Function Expression: The function is defined inside parentheses: (function() { ... }). This makes it a function expression rather than a function declaration.
    # Immediate Invocation: The () at the end immediately invokes the function after it is defined.

    -----------------------
    (function(name) {
        console.log("Hello, " + name + "!");
    })("John");

    -----------------------
    var counterModule = (function() {
        var counter = 0;

        return {
            increment: function() {
                counter++;
                console.log(counter);
            },
            reset: function() {
                counter = 0;
                console.log(counter);
            }
        };
    })();

    counterModule.increment();  // Output: 1
    counterModule.increment();  // Output: 2
    counterModule.reset();      // Output: 0

*/

// 1. Hoisting ("hoisted") 
/*
    # Variable Declarations are Hoisted:
    - Only the declarations (i.e., var, let, const) are hoisted, not the initializations (the assignments).

    # Function Declarations are Hoisted:

    # Function Expressions and Arrow Functions are NOT Hoisted:

    # Example
        console.log(a);  // undefined
        var a = 10;

        console.log(b);  // ReferenceError: Cannot access 'b' before initialization
        let b = 20;

        console.log(c);  // ReferenceError: Cannot access 'c' before initialization
        const c = 30;

        foo();           // "Function hoisting works!"
        function foo() {
            console.log("Function hoisting works!");
        }

        bar();           // TypeError: bar is not a function
        var bar = function() {
            console.log("Function expression does not hoist!");
        };
*/

// 2. Closures
/*
    # Example of a Closure: 
    - Closures allow you to create private variables that can’t be accessed from outside the function.
        This is helpful for encapsulating data and creating a more controlled environment where only specific functions can access or modify the variables.
        
    function outer() {
        let outerVar = "I'm from the outer function!";
        
        function inner() {
            console.log(outerVar);  // Accessing outerVar from the outer function
        }
        
        return inner;
    }

    const innerFunc = outer();  // Call outer(), it returns inner function
    innerFunc();  // Output: "I'm from the outer function!"

*/

// 1. Callbacks
/*
    # Synchronous Callbacks:
    function greet(name, callback) {
        console.log("Hello, " + name + "!");
        callback();  // Calling the callback function
    }

    function sayGoodbye() {
        console.log("Goodbye!");
    }

    greet("Alice", sayGoodbye);

    -----------------------------
    # Asynchronous Callbacks:
    function delayedGreeting(name) {
        setTimeout(function() {
            console.log("Hello, " + name + "!");
        }, 2000);  // Delay of 2 seconds
    }

    delayedGreeting("John");

    -----------------------------
    # Asynchronous Callback Example with HTTP Request (using XMLHttpRequest):
    function fetchData(callback) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "https://api.example.com/data", true);
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                callback(null, xhr.responseText);  // Call the callback on success
            } else {
                callback("Error: " + xhr.status);  // Call the callback on failure
            }
        };
        
        xhr.send();
    }

    function handleData(error, data) {
        if (error) {
            console.log(error);
        } else {
            console.log("Data received: " + data);
        }
    }

    fetchData(handleData);  // Fetch data and handle it with the callback

    ----------------------------------------
    # Handling Asynchronous Operations Without Callback Hell:
    function getUser(userId) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                console.log("Fetched user");
                resolve(userId);
            }, 1000);
        });
    }

    function getUserPosts(userId) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                console.log("Fetched posts for user " + userId);
                resolve();
            }, 1000);
        });
    }

    function getCommentsForPost(postId) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                console.log("Fetched comments for post " + postId);
                resolve();
            }, 1000);
        });
    }

    getUser(1)
        .then((userId) => getUserPosts(userId))
        .then(() => getCommentsForPost(1))
        .then(() => console.log("Done fetching all data."))
        .catch((error) => console.log("Error: " + error));
*/

// 2. Promises
/*
    # the eventual completion (or failure) of an asynchronous operation.
    # Promises provide a cleaner and more readable way to handle asynchronous operations than using callbacks, especially for avoiding "callback hell.

    const promise = new Promise((resolve, reject) => {
        const success = true;  // Simulate an operation's outcome

        if (success) {
            resolve("The operation was successful!");  // Fulfill the promise
        } else {
            reject("The operation failed.");  // Reject the promise
        }
    });

    ------------------------
    function fetchData() {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                const data = { id: 1, name: "John Doe" };
                const success = true;

                if (success) {
                    resolve(data);  // Fulfilled with the data
                } else {
                    reject("Failed to fetch data.");  // Rejected with an error
                }
            }, 2000);
        });
    }

    fetchData()
        .then((data) => {
            console.log("Data fetched successfully:", data);
        })
        .catch((error) => {
            console.error(error);
        })
        .finally(() => {
            console.log("Operation completed.");
        });


*/

// 3. Async & Await
/*
    # async and await are JavaScript keywords that simplify working with asynchronous code. They build on top of Promises and allow you to write asynchronous code that looks and behaves more like synchronous code, making it easier to read and maintain.

    # Key Concepts:
    - async Function: An async function always returns a Promise. If the function returns a value, that value is wrapped in a resolved Promise. If the function throws an error, it returns a rejected Promise.
    - await Expression: The await keyword can only be used inside an async function. It pauses the execution of the async function and waits for the Promise to resolve or reject.

    # Basic Example:
    function fetchData() {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                const data = { id: 1, name: "John Doe" };
                resolve(data);  // Simulate successful data fetch
            }, 2000);
        });
    }

    async function getUser() {
        console.log("Fetching user...");
        const user = await fetchData();  // Wait for the Promise to resolve
        console.log("User fetched:", user);
    }

    getUser();

    --OUTUPT--
    Fetching user...
    User fetched: { id: 1, name: 'John Doe' }
*/

// 1. javascript logic programs
// 1. Problem solving with javascript
