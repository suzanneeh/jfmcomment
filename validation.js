    window.addEventListener("load", function(){
        "use strict";
        const form = document.querySelector(".contact")
        form.addEventListener("submit", function (event){
            event.preventDefault()
            console.log("form submitted")
            let field = document.querySelectorAll("contact .form-control")
            let valid = true 
            for (var i = 0; i < fields.length; i ++){
                fields[i].classlist.remove("no-error")
                if(fields[i].calue === " "){
                    fields[i].classlist.add("has-error")
                    fields[i].nextElementSibling.style.display = "block"
                    valid = false 
                }else{
                    fields[i].classlist.remove("has-error")
                    fields[i].classlist.add("no-error")
                    fields[i].nextElementSibling.style.display = "none"
                }
            }
            if(valid){
                document.querySelector(".formfields").style.display = "none"
                document.querySelector(".alert").innerText = "Submission Processing, Please Wait..."
                grecaptcha.ready(function() {
                   grecaptcha.execute ("6Lc92REiAAAAAHT0cifOKoXj343OCPt0jahls7GR", {
                        action: "contact" 
                    })
                    .then(function(token) {
                        let recaptchaResponse = document.getElementById
                        ("recaptchaResponse")
                        recaptchaResponse.value = token
                        fetch("/sendmail.php", {
                            method: "POST",
                            body: new FormData(form),
                        })
                        .then((response) => response.text())
                        .then((response) => {
                            const responseText = JASON.parse(response)
                            if(responseText.error !== " "){
                                document.querySelector("#alert").
                                innerText = responsetext.error
                                document.querySelector("#alert").
                                classList.add("error")
                                document.querySelector(".formfields").
                                style.display = "block"
                                return
                                document.querySelector('#alert').
                                classList.add("sucess")
                                window.location.replace("/thankyou")
                            }
                        })  
                    })
            }) 
        }
    })
})