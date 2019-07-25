var web_url = document.getElementById("LINK").value;
var clients = new Vue({
    el: ".client-widget",
    data: {
        url: web_url,
        isDataAvailable: false,
        dealers:null,
        customers:null,
        start_page:null,
        end_page:null,
        next_page:null,
        prev_page:null,
        curr_page:null
    },
    mounted() {
        if($('#page-type').val() == 'dealer'){
            this.GetAllDealerClients(null);
        }
        if($('#page-type').val() == 'customer'){
            this.GetAllCustomerClients(null);
        }

    },
    methods: {
        GetAllDealerClients: function (page) {
            alert.OnSuccess = false;
            alert.OnError = false;
            alert.OnWait = true;
            alert.loading = true;
            alert.message("Please wait...");
            alert.show = 'block';
            let formData = new FormData();
            formData.append("page",  page);
            axios.post(this.url + "clients/get-all-dealer-clients",formData).then(function (response) {
                if (response.data != null) {
                    clients.dealers    = response.data.data;
                    clients.start_page = response.data.CurrentlyPage;
                    clients.end_page   = response.data.TotalPage;
                    clients.next_page  = response.data.NextPage;
                    clients.prev_page  = response.data.PreviewsPage;
                    clients.curr_page  =  response.data.CurrentlyPage;
                    setTimeout(function () {
                        $('.page-item').removeClass('active');
                        $('.page_'+clients.curr_page).addClass('active');
                    },500);

                }
            });
            alert.close();
        },
        GetAllCustomerClients: function (page) {
            alert.OnSuccess = false;
            alert.OnError = false;
            alert.OnWait = true;
            alert.loading = true;
            alert.message("Please wait...");
            alert.show = 'block';
            let formData = new FormData();
            formData.append("page",  page);
            axios.post(this.url + "clients/get-all-customer-clients",formData).then(function (response) {
                if (response.data != null) {
                    clients.customers  = response.data.data;
                    clients.start_page = response.data.CurrentlyPage;
                    clients.end_page   = response.data.TotalPage;
                    clients.next_page  = response.data.NextPage;
                    clients.prev_page  = response.data.PreviewsPage;
                    clients.curr_page  =  response.data.CurrentlyPage;
                    setTimeout(function () {
                        $('.page-item').removeClass('active');
                        $('.page_'+clients.curr_page).addClass('active');
                    },500);

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
        },
        DeleteClient(id,index){
            dialog.Confirmation("Are you sure to move this client to trash?",function (response) {
                          if(response){
                              let url = web_url+'clients/delete-client';
                              let formData = new FormData();
                              formData.append("id",  id);
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
                                          window.location.reload();
                                          dialog. Canceled();
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
            });
        },
         ChangeStatus(el) {
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
     