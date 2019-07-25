var web_url = document.getElementById("LINK").value;
var  settings  = new Vue({
        el: ".settings-widget",
        data: {
            url: web_url,
            categories: null,
            start_page: null,
            end_page: null,
            next_page: null,
            prev_page: null,
            curr_page: null,
            profile:true,
            user:null
        },
        mounted() {
                 // Codes .............
        },
        methods: {
           OpenUpload(el, preview_el, obj) {
                uploads.upload_widget = "block";
                uploads.reciever_element = el;
                uploads.obj = obj.settings;
                uploads.preview = preview_el;
            },
           AddUser:function (el) {
               let data = JSON.stringify($(el.target).serializeArray());
                let url = el.target.action;
                let formData = new FormData();
                formData.append("data", data);
                alert.OnSuccess = false;
                alert.OnError   = false;
                alert.OnWait    = true;
                alert.loading   = true;
                alert.message("Please wait...");
                alert.show = 'block';
                axios.post(url, formData).then(function (response) {
                    if (response.data != null) {
                        if (response.data.status == "success") {
                            alert.OnSuccess = true;
                            alert.OnError   = false;
                            alert.OnWait    = false;
                            alert.loading   = false;
                            alert.message(response.data.msg);
                            alert.close();
                            setTimeout(function () {
                                window.location.reload();
                            }, 300);
                        } else {
                            alert.OnSuccess = false;
                            alert.OnError   = true;
                            alert.OnWait    = false;
                            alert.loading   = false;
                            alert.message(response.data.msg);
                        }
                    }
                });
                alert.close();
           },
           GetSingleUser(id){
                let url = web_url + 'profile/get-single-user';
                let formData = new FormData();
                formData.append("id", id);
                alert.OnSuccess = false;
                alert.OnError = false;
                alert.OnWait = true;
                alert.loading = true;
                alert.message("Please wait...");
                alert.show = 'block';
                axios.post(url, formData).then(function (response) {
                    if (response.data != null) {
                        settings.user = response.data;
                    }
                });
                alert.close();
           },
           UpdateUser(el){
             let data = JSON.stringify($(el.target).serializeArray());
                let url = el.target.action;
                let id = $('#id').val();
                let formData = new FormData();
                formData.append("data", data);
                formData.append("id", id);
                alert.OnSuccess = false;
                alert.OnError   = false;
                alert.OnWait    = true;
                alert.loading   = true;
                alert.message("Please wait...");
                alert.show = 'block';
                axios.post(url, formData).then(function (response) {
                    if (response.data != null) {
                        if (response.data.status == "success") {
                            alert.OnSuccess = true;
                            alert.OnError   = false;
                            alert.OnWait    = false;
                            alert.loading   = false;
                            alert.message(response.data.msg);
                            alert.close();
                            setTimeout(function () {
                                window.location.reload();
                            }, 300);
                        } else {
                            alert.OnSuccess = false;
                            alert.OnError   = true;
                            alert.OnWait    = false;
                            alert.loading   = false;
                            alert.message(response.data.msg);
                        }
                    }
                });
                alert.close();
           }
        }

    });
     