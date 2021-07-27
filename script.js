const form = document.querySelector(".wrapper form"),
fullURL = form.querySelector("input"),
shortenBtn = form.querySelector("button"),
blurEffect = document.querySelector(".blur-effect"),
popupBox = document.querySelector(".popup-box"),
form2 = popupBox.querySelector("form"),
shortenURL = popupBox.querySelector("input"),
saveBtn = popupBox.querySelector("button"),
copyBtn = popupBox.querySelector(".copy-icon"),
infoBox = popupBox.querySelector(".info-box");

form.onsubmit = (e) =>{
    e.preventDefault(); //preventing form from submitting
}

shortenBtn.onclick = ()=> {
    //let's start ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "url-control.php", true);
    xhr.onload = ()=>{
        //if ajax request status is success
        if(xhr.readyState == 4 && xhr.status == 200){
            
            let data = xhr.response;
            
            if(data.length <= 5){
                blurEffect.style.display = "block";
                popupBox.classList.add("show");

                let domain = "localhost/URL Shortener/";
                shortenURL.value = domain + data;

                copyBtn.onclick = () => {
                    shortenURL.select();
                    document.execCommand("copy");
                }

                form2.onsubmit = (e) =>{
                    e.preventDefault(); //preventing form from submitting
                }

                saveBtn.onclick = () => {
                    let xhr2 = new XMLHttpRequest();
                    xhr2.open("POST", "save-url.php", true);
                    xhr2.onload = ()=>{
                        //if ajax request status is success
                        if(xhr2.readyState == 4 && xhr2.status == 200){

                            let data = xhr2.response;
                            if(data == "success"){
                                location.reload();
                            } else {
                                infoBox.classList.add("error");
                                infoBox.innerText = data;
                            }

                        }
                    }
 
                    //sned two data/value from ajax to php
                    let short_url = shortenURL.value;
                    let hidden_url = data;;
                    xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    xhr2.send("shorten_url="+short_url+"&hidden_url="+hidden_url);
                }

            } else {
                alert(data);
            }

        }
    }

    //sending data to php file
    let formData = new FormData(form); //creating new FormData object
    xhr.send(formData);

}