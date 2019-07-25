var web_url = document.getElementById("LINK").value;
var  search  = new Vue({
        el: "#search-form",
        data: {
            url: web_url,
            keyworld:'',
            search_items:null
        },
        mounted() {
                 
        },
        methods: {
            SearchItems : function(){
                let formData = new FormData();
                formData.append("keyword",search.keyworld);
                if(search.keyworld != ''){
                axios.post(this.url+"home/search-items",formData).then(function(response){
                    if (response.data != null) {
                       search.search_items = response.data;
                    }
                });
              }
            },
        }

    });

var offer = new Vue({
        el: "#offer-modal",
        data: {
            url: web_url,
            parc:0,
            filename:null,
            upload:true,
            notification:null,
        },
        mounted() {
                 
        },
        methods: {
          
           AddFiles: function () {
                this.$refs.files.click();
            },
            handleFilesUpload() {
                let file_tmp = this.$refs.files.files[0];
                let formData = new FormData();
                let file = file_tmp;
                formData.append('file', file);
                axios.post( this.url+'admin/uploader/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },onUploadProgress: function( progressEvent ) {
                            offer.parc = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) );
                        }.bind(this)
                    }
                ).then(function(e){
                  offer.upload = false;
                  offer.filename = e.data.data.file[0].name;
                }.bind(this)).catch(function(){
              
                    }.bind(this));
            },
            SubmitOffer: function (el) {
                let product = JSON.stringify($(el.target).serializeArray());
                let user = JSON.stringify($('#user-details').serializeArray());
                let url = el.target.action;
                let formData = new FormData();
                formData.append("product", product);
                formData.append("user", user);
                offer.notification = "Please wait...";
                axios.post(url, formData).then(function (response) {
                    if (response.data != null) {
                        if (response.data.status == "success") {
                           offer.notification = response.data.msg;
                           setTimeout(function () {
                             window.location.reload();
                           },2000);
                           
                        } else {
                            offer.notification = response.data.msg;
                        }
                    }
                });
               
            }


        }

    });