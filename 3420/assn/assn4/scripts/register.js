//This document has 
//toggle pass visibility
//Password strenght indicator
//passconfirm


//user not pass else has special character, if pass weak no submission
//password suggest


function calculatePasswordStrength(pass, username) {

    let strength = 0;

    //Number check
    //Numbers (the more numbers the better)
    numbers = pass.match(/\d/g)
    if ( numbers ) {

        strength += 1;
        
        if ( numbers.length > 2){
            strength += 1; 
        }
    }
    
    //Characters check
    //Special characters (the more special characters the better)
    spec = pass.match(/[`!@#$%^&*()_\-+=\[\]{};':"\\|,.<>\/?~ ]/g)  //[!@#$%^&*(),.?":{}|<>]
    if ( spec ) {

        strength += 1;
        
        if ( spec.length > 2){
            strength += 1; 
        }
    }

    //uppercase letters
    capital = pass.match(/[A-Z]/g)
    if ( capital ) {

        strength += 1;
        
        if ( capital.length > 2){
            strength += 1; 
        }
    }

    //lowercase letters dont care

    //length
    if ( pass.length > 8 ) {

        strength += 1;
        
        if ( pass.length > 12){
            strength += 1; 
        }

    } else {

        strength -= 1;
    }

    //Deduct
    //username match (case insensitive too)
    if ( pass.includes(username) ) {

        strength -= 1;

        //Case insensitive
        if ( pass.toLowerCase().includes(username.toLowerCase()) ){

            strength -= 1;
        }
    }


    //gettting test results
    let result = "weak";

    if ( strength > 2 ) {
        result = "good";
    }
    if ( strength > 4 ) {   
        result = "strong";
    }
    if ( strength > 6 ) {
        result = "very strong";
    }

    return result;
}

//get username
//const username = "<?php echo $username; ?>";
//password event

//Geting elements
const password_Input    = document.getElementById("password");
const username_Input    = document.getElementById("username");
const pass_indicate     = document.getElementById("pass-indicate");
const match_indicate    = document.getElementById("match-indicate");
const con_pass          = document.getElementById("c_password");

//Just to get the active username
    username_Input.addEventListener('input', function () {
        username = username_Input.value;    
    });

//Just to parse pass and test strength
    password_Input.addEventListener('input', function () {

        //real time input
        let password    = password_Input.value;
        let match       = con_pass.value;
        //realtime pass calculate
        let strength = calculatePasswordStrength(password, username);
        //Passmathces
        checkmatch(password,match);


        //Update based on strength
        if (password != ""){

            if (strength == "weak"){
                pass_indicate.textContent = "Password is weak, you need to make it stronger!";
            }
            else if (strength == "good"){
                pass_indicate.textContent = "Password is good but trivial";
            }
            else if (strength == "strong"){
                pass_indicate.textContent = "Password is strong, you are set";
            }
            else if (strength == "very strong"){
                pass_indicate.textContent = "Password is very strong, good job";
            }

        }else{

            //if empty
            pass_indicate.textContent = "";
        }
        

    })

//Toggle pass
    function togglePass() {

        if (password_Input.type === "password") {
        password_Input.type = "text";
        } else {
        password_Input.type = "password";
        }
    }



//Matching passes
    con_pass.addEventListener('input', function () {

        //get pass values
        let password    = password_Input.value;
        let match       = con_pass.value;

        checkmatch(password,match);

    });


    //password matcher
    function checkmatch(pass, confirm) {

        if(confirm == ""){
            match_indicate.textContent = "Now please confirm password"
        }
        else if(pass != confirm){
            match_indicate.textContent = "The passwords dont match!"
        }
        else { match_indicate.textContent = "";}

    }



//Form

const voteForm = document.querySelector("#register-form");

voteForm.addEventListener("submit", (ev) => {

    
    // IF THERE ARE ERRORS, PREVENT FORM SUBMISSION
    if(errors){

        ev.preventDefault();
        
    }
});
