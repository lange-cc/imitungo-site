var web_url = document.getElementById("LINK").value;
var  profile  = new Vue({
        el: "#html-element",
        data: {
            url: web_url,
            valiable: null,
        },
        mounted() {
                 // Codes .............
        },
        methods: {
            Test : function(){
                let formData = new FormData();
                formData.append("page", this.valiable);

                axios.post(this.url+"page/function",formData).then(function(response){
                    if (response.data != null) {
                          if(response.data.status == "success"){
                               // Codes .............
                         }else{
                             // Codes .............
                          }
                    }
                });
            },
        }

    });
     