var web_url = document.getElementById('LINK').value;
var create = new Vue({
        el: '#create-form',
        data: {
            url: web_url,
            alert_success: false,
            alert_dander: false,
            loading_icon: false,
            page_name:"",
            page_type:'admin',
            message:"",
        },
        mounted() {

        },
        methods: {
            Request(){
                let formData = new FormData();
                formData.append('page', this.page_name);
                formData.append('type', this.page_type);
                axios.post(this.url+'create/page',formData).then(function(response){
                    if (response.data != null) {
                          if(response.data.status == 'success'){
                              create.alert_success = true;
                              create.alert_dander = false;
                              create.message = response.data.message;
                              setInterval(() => {
                                  create.alert_success = false;
                              },5000);
                         }else{
                              create.alert_success = false;
                              create.alert_dander = true;
                              create.message = response.data.message;
                              setInterval(() => {
                                  create.alert_dander = false;
                              },5000);
                          }
                    }
                });
            },
        }

    })
;