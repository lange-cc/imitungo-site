var web_url = document.getElementById('LINK').value;
var main = new Vue({
    el: '#profile-widget',
    data: {
        url: web_url,
        isProfile_widget: 'none',
        edit_profile: false,
        isWait: true,
        isSuccess: false,
        isDanger: false,
        loader: true,
        message: "Please wait..",
        title: null,
        name: null,
    },
    mounted() {

    },
    methods: {
       UpdateUser(el) {
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
                                window.location.reload();
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
        FormData(obj) {
            var formData = new FormData();
            for (var key in obj) {
                formData.append(key, obj[key]);
            }
            return formData;
        }, OpenUpload(el, preview_el, obj) {
                uploads.upload_widget = "block";
                uploads.reciever_element = el;
                uploads.obj = obj.main;
                uploads.preview = preview_el;
       },
   }


});


var alert = new Vue({
    el: '.alert-template',
    data: {
        OnError: false,
        OnSuccess: true,
        OnWait: true,
        message_data: null,
        loading: true,
        show: 'none'
    },
    mounted() {

    },
    methods: {
        message(msg) {
            alert.message_data = msg;
        },
        close(time = 1000) {
            setTimeout(function () {
                alert.show = 'none';
            }, time);
        }

    }
});
var dialog = new Vue({
    el: '.ask-dialog',
    data: {
        message_data: null,
        show: 'none',
        callback:null
    },
    mounted() {
    },
    methods: {
        Confirmation(message,callback){
            dialog.callback = callback;
            dialog.message_data = message;
            dialog.show = 'flex';
        },
        Confirmed() {
            dialog.callback(true);
        },
        Canceled() {
            dialog.show = 'none';
        }
    }
});



