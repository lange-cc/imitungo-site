var web_url = document.getElementById("LINK").value;
// var  home  = new Vue({
//         el: "#html-element",
//         data: {
//             url: web_url,
//             valiable: null,
//         },
//         mounted() {
//                  // Codes .............
//         },
//         methods: {
//             Test : function(){
//                 let formData = new FormData();
//                 formData.append("page", this.valiable);

//                 axios.post(this.url+"page/function",formData).then(function(response){
//                     if (response.data != null) {
//                           if(response.data.status == "success"){
//                                // Codes .............
//                          }else{
//                              // Codes .............
//                           }
//                     }
//                 });
//             },
//         }

//     });


// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 90 || document.documentElement.scrollTop > 90) {
    document.getElementById("top").style.display = "block";
  } else {
    document.getElementById("top").style.display = "none";
  }
}
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();  
//     setInterval(function(argument) {
//   window.location.reload();
// },2000); 
});
     

// Get the modal
// var modal = document.getElementById('myModal');
// var close_btn = document.getElementsByClassName("close")[0];
// var answer_btn = document.getElementsByClassName("answer_btn")[0];

// answer_btn.onclick = function() {
//     modal.style.display = "block";
// }
// close_btn.onclick = function() {
//     modal.style.display = "none";
// }
// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }

