const form = document.querySelector(".signup form"),
continueBtn = document.querySelector(".button input"),
errorText = document.querySelector(".error-txt");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    //start Ajax
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "users.php";
                } else{
                    errorText.style.display = "block";
                    errorText.textContent = data;  
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}