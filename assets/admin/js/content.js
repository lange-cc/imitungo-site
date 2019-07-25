var web_url = document.getElementById("LINK").value;
var  content  = new Vue({
        el: ".content-widget",
        data: {
            url: web_url,
            media_switch: true,
            profile: true,
            content_item:null
        },
        mounted() {
                 // Codes .............
        },
        methods: {
            AddContent : function(el){
                let data = JSON.stringify($(el.target).serializeArray());
                let url = el.target.action;
                let formData = new FormData();
                formData.append("data", data);
                alert.OnSuccess = false;
                alert.OnError = false;
                alert.OnWait = true;
                alert.loading = true;
                alert.message("Please wait...");
                alert.show = 'block';
                axios.post(url, formData).then(function (response) {
                    if (response.data != null) {
                        if (response.data.status == "success") {
                            alert.OnSuccess = true;
                            alert.OnError = false;
                            alert.OnWait = false;
                            alert.loading = false;
                            alert.message(response.data.msg);
                            alert.close();
                            setTimeout(function () {
                                window.location = web_url + 'content/';
                            }, 300);
                        } else {
                            alert.OnSuccess = false;
                            alert.OnError = true;
                            alert.OnWait = false;
                            alert.loading = false;
                            alert.message(response.data.msg);
                        }
                    }
                });
                alert.close();
            },
            OpenUpload(el, preview_el, obj) {
                uploads.upload_widget = "block";
                uploads.reciever_element = el;
                uploads.obj = obj.content;
                uploads.preview = preview_el;
            },
            DeleteContent(id){
                dialog.Confirmation("Are you sure to move this content to trash?", function (response) {
                    if (response) {
                        let url = web_url + 'content/delete-content';
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
                                if (response.data.status == "success") {
                                    alert.OnSuccess = true;
                                    alert.OnError = false;
                                    alert.OnWait = false;
                                    alert.loading = false;
                                    alert.message(response.data.msg);
                                    alert.close();
                                     window.location.reload()
                                } else {
                                    alert.OnSuccess = false;
                                    alert.OnError = true;
                                    alert.OnWait = false;
                                    alert.loading = false;
                                    alert.message(response.data.msg);
                                }
                            }
                        });
                        alert.close();
                    }
                });

            },
            GetSingleContent(id){
                let url = web_url + 'content/get-single-content';
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
                        content.content_item = response.data;
                        if(content.content_item.image == ''){
                            content.media_switch  = false;
                        }else{
                            content.media_switch  = true;
                        }
                            
                       
                    }
                });
                alert.close();

            },
            UpdateContent(el){
                let client_data = JSON.stringify($(el.target).serializeArray());
                let url = el.target.action;
                let id = $('#id').val();
                let formData = new FormData();
                formData.append("data", client_data);
                formData.append("id", id);
                alert.OnSuccess = false;
                alert.OnError = false;
                alert.OnWait = true;
                alert.loading = true;
                alert.message("Please wait...");
                alert.show = 'block';
                axios.post(url, formData).then(function (response) {
                    if (response.data != null) {
                        if (response.data.status == "success") {
                            alert.OnSuccess = true;
                            alert.OnError = false;
                            alert.OnWait = false;
                            alert.loading = false;
                            alert.message(response.data.msg);
                            alert.close();
                            window.location.reload();
                        } else {
                            alert.OnSuccess = false;
                            alert.OnError = true;
                            alert.OnWait = false;
                            alert.loading = false;
                            alert.message(response.data.msg);
                        }
                    }
                });
                alert.close();
            }
        }

    });
     