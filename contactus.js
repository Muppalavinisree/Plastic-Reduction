function sendEmail(){
    Email.send({
        Host : "smtp.gmail.com",
        Username : "vinisreemuppala248@gmail.com",
        Password : "Vinisree@29/",
        To : 'vinisreemuppala248@gmail.com',
        From : document.getElementById("email").value,
        Subject : "New contact form enquiry",
        Body : "name: "+document.getElementById("FirstName").value
                + "<br> email: "+ document.getElementById("email").value
                + "<br> phno: "+ document.getElementById("mobile").value
                + "<br> message: "+ document.getElementById("message").value
                
    }).then(
      message => alert("message sent successfully")
    );
}