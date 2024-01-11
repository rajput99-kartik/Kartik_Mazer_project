@extends('backend.layouts.master')
@section('content')

<style>
    /* Add your CSS styles here */
    p.message {
        font-size: 18px;
        color: #007bff;
        font-weight: bold;
       
    }

    .error-message {
            color: red;
            font-size: 14px;
            display: none;
        }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <h3>Click Event</h3>
   <div>
        <button class=" btn btn-success" id="btn1">Click </button>
        <p id="cntr">0</p>
        <p id="message-container" class="message"></p>
    </div>


<div>
 <button class="btn btn-danger" id="myButton">Click me</button>

<p id="clickcount">0</p>
</div>


<h3>Mouse Events </h3>


<div id="myElement" style="width: 100px; height: 100px; background-color: white; border: 1px solid black; padding: 20px; text-align: center;">
    Hover over me!
</div>


<div class="container mt-5">
    <div class="row">
        <h3>Form Validation</h3>
        <form id="myForm">
            <div class="mt-3">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
                <div id="nameError" class="error-message"></div>
            </div>
            <div class="mt-3">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <div id="emailError" class="error-message"></div>
            </div>
            <input class="mt-3" type="submit" value="Submit">
        </form>
    </div>
</div>

<div>
<h3>Input Field Events</h3>
    <p id="pchange">When you clicked on input field it will change the background color of input field</p>
    <input type="text" id="myInput" placeholder="Type here" style="padding: 5px; font-size: 16px;">
    
</div>












</div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("myForm");
            const nameInput = document.getElementById("name");
            const emailInput = document.getElementById("email");
            const nameError = document.getElementById("nameError");
            const emailError = document.getElementById("emailError");

            form.addEventListener("submit", function(event) {
                
                const name = nameInput.value;
                const email = emailInput.value;
                let isValid = true;
                
                if (name === "") {
                    nameError.textContent = "Name is required.";
                    nameError.style.display = "block";
                    event.preventDefault();
                     isValid = false;
                } else {
                    nameError.textContent = "";
                }

                
                const ValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!ValidEmail.test(email)) {
                    emailError.textContent = "Please enter a valid email address.";
                    emailError.style.display = "block";
                    
                     isValid = false;
                } else {
                    emailError.textContent = "";
                }
                    if(!isValid){
                        event.preventDefault();
                    }else{
               alert("Submitted")
                    }
            });
        });

        
        // Input field events

        const inputField = document.getElementById("myInput");
        const message = document.getElementById("pchange");
        let messageorg = message.textContent;
        


        inputField.addEventListener("focus", function() {
            message.textContent = "You have clicked in the input field"
            inputField.style.backgroundColor = "#ccffcc"; // Change the background color when focused
        });

        inputField.addEventListener("blur", function() {
            inputField.style.backgroundColor = "";
            message.textContent = messageorg;
        });

        // input field events end


       

    document.addEventListener("DOMContentLoaded", function() {
        const element = document.getElementById("myElement");

        element.addEventListener("mouseenter", function() {
            element.style.backgroundColor = "lightblue";
        });

        element.addEventListener("mouseleave", function() {
            element.style.backgroundColor = "white";
        });

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function(){
      const a =   document.getElementById('btn1');
      const b = document.getElementById('cntr');
      const messageContainer = document.getElementById('message-container');

      const messageParagraph = document.createElement("p");
      messageParagraph.textContent = "Wow, you clicked on the button!";
      messageParagraph.className = "message";
      let c = 0;

      a.addEventListener('click', function(){

        c= c+1;
        b.textContent = c;
         document.body.appendChild(messageParagraph);
         
         messageContainer.innerHTML = '';
            messageContainer.appendChild(messageParagraph);
      })

    })

    document.addEventListener("DOMContentLoaded", function() {
        const myButton = document.getElementById("myButton");
        const clickCountSpan = document.getElementById("clickcount");
            let clickCount = 0;

        

        myButton.addEventListener("click", function() {
            myButton.innerHTML = "Clicked!";
           clickCount++;
           clickCountSpan.textContent = clickCount;

        });
    });



</script>

