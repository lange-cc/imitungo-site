var web_url = document.getElementById("LINK").value;




var  contact  = new Vue({
        el: "#contact-modal",
        data: {
            url: web_url,
            notification:null,
        },
        mounted() {
                 
        },
        methods: {
        
            ContactUs:function (el) {
                let data = JSON.stringify($(el.target).serializeArray());
                let url = el.target.action;
                let formData = new FormData();
                formData.append("data", data);
                contact.notification = "Please wait...";
                axios.post(url, formData).then(function (response) {
                    if (response.data != null) {
                        if (response.data.status == "success") {
                           contact.notification = response.data.msg;
                           setTimeout(function () {
                             window.location.reload();
                           },2000);
                           
                        } else {
                            contact.notification = response.data.msg;
                        }
                    }
                });
               
            }


        }

    });

 $(document).on('ready', function() {
      $(".vertical-center-4").slick({
        dots: true,
        vertical: true,
        centerMode: true,
        slidesToShow: 4,
        slidesToScroll: 2
      });
      $(".vertical-center-3").slick({
        dots: true,
        vertical: true,
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".vertical-center-2").slick({
        dots: true,
        vertical: true,
        centerMode: true,
        slidesToShow: 2,
        slidesToScroll: 2
      });
      $(".vertical-center").slick({
        dots: true,
        vertical: true,
        centerMode: true,
      });
      $(".vertical").slick({
        dots: true,
        vertical: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".center").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 5,
        slidesToScroll: 3
      });
      $(".variable").slick({
        dots: true,
        infinite: true,
        variableWidth: true
      });
      $(".lazy").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true
      });
    });
     


     // Get the modal
var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close")[0];
// Get the button that opens the modal
var btn = document.getElementById("long");
var btn2 = document.getElementById("long20");
var btn3 = document.getElementById("long30");
var btn4 = document.getElementById("long40");
var btn5 = document.getElementById("long50");
var btn6 = document.getElementById("long60");
var btn7 = document.getElementById("long70");
var btn8 = document.getElementById("long80");
var btn9 = document.getElementById("long90");
var btn10 = document.getElementById("long100");
var btn11 = document.getElementById("long110");
var btn12 = document.getElementById("long120");

// Get the <span> element that close2s the modal

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}
btn2.onclick = function() {
    modal.style.display = "block";
}
btn3.onclick = function() {
    modal.style.display = "block";
}
btn4.onclick = function() {
    modal.style.display = "block";
}
btn5.onclick = function() {
    modal.style.display = "block";
}
btn6.onclick = function() {
    modal.style.display = "block";
}
btn7.onclick = function() {
    modal.style.display = "block";
}
btn8.onclick = function() {
    modal.style.display = "block";
}
btn9.onclick = function() {
    modal.style.display = "block";
}
btn10.onclick = function() {
    modal.style.display = "block";
}
btn11.onclick = function() {
    modal.style.display = "block";
}
btn12.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close2 the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close2 it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


