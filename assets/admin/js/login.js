var web_url = document.getElementById('LINK').value;
var Login = new Vue({
    el: '#Login',
    data: {
        url:web_url,
        isLogin:false,
        isWait:true,
        isSuccess:false,
        isDanger:false,
        loader:true,
        message:"Please wait..",
        credentials: {
            username: '',
            password: '',
            auth:document.getElementById('auth').value,
            keep:true
        }
    },
    mounted() {

    },
    methods: {
        LoginUser() {
            this.isLogin = true;
            Login.isWait = true;
            Login.isSuccess = false;
            Login.isDanger = false;
            Login.loader = true;
            Login.message = "Please wait...";
            var formData = this.FormData(Login.credentials);
            axios.post(this.url + "login/user", formData).then(function (response) {
                if (response.data.status == 'success') {
                    Login.isWait = false;
                    Login.isSuccess = true;
                    Login.isDanger = false;
                    Login.loader = false;
                    Login.message = response.data.message;
                    window.location.href = web_url;
                } else {
                    Login.isWait = false;
                    Login.isSuccess = false;
                    Login.isDanger = true;
                    Login.loader = false;
                    Login.message = response.data.message;
                }
            });
        },
        FormData(obj) {
            var formData = new FormData();
            for (var key in obj) {
                formData.append(key, obj[key]);
            }
            return formData;
        }
    }

});