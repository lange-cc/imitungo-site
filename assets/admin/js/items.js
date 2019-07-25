var web_url = document.getElementById("LINK").value;

var items = new Vue({
        el: ".items-widget",
        data: {
            url: web_url,
            isDataAvailable: false,
            profile: true,
            credentials: {
                auth: null
            },
            categories: null,
            category: {
                name: null,
                id: null
            },
            items: null,
            item: null,
            items_show: 'none',
            start_page: null,
            end_page: null,
            next_page: null,
            prev_page: null,
            curr_page: null,
            other_images: []
        },
        mounted() {
            if ($('#page-type').val() == 'main') {
                this.GetAllCategory(null);
            }

            if ($('#page-type').val() == 'items') {
                this.GetAllitems(null);
            }


        },
        methods: {
            GetAllCategory: function (page) {
                alert.OnSuccess = false;
                alert.OnError = false;
                alert.OnWait = true;
                alert.loading = true;
                alert.message("Please wait...");
                alert.show = 'block';
                let formData = new FormData();
                formData.append("page", page);
                axios.post(this.url + "items/get-all-category", formData).then(function (response) {
                    if (response.data != null) {
                        items.categories = response.data.data;
                        items.start_page = response.data.CurrentlyPage;
                        items.end_page = response.data.TotalPage;
                        items.next_page = response.data.NextPage;
                        items.prev_page = response.data.PreviewsPage;
                        items.curr_page = response.data.CurrentlyPage;
                        items.items_show = 'block';
                        setTimeout(function () {
                            $('.page-item').removeClass('active');
                            $('.page_' + items.curr_page).addClass('active');
                        }, 500);

                    } else {
                        items.items_show = 'none';
                    }
                });
                alert.close();
            },
            OpenUpload(el, preview_el, obj) {
                uploads.upload_widget = "block";
                uploads.reciever_element = el;
                uploads.obj = obj.items;
                uploads.preview = preview_el;
            },
            OpenMiltUpload(input, obj) {
                uploads.upload_widget = "block";
                uploads.reciever_element = input;
                uploads.obj = obj.items;
                uploads.preview = null;
            },
            FileNameTaker(filename) {
                items.other_images.push(filename);
                var data = JSON.stringify(items.other_images);
                $(uploads.reciever_element).val(data);
            },
            CanceProfile(el) {
                $(el).hide();
                $('#profile-input').val('');
                items.profile = true;
            }
            ,
            RemoveImages(index) {
                if (index > -1) {
                    items.other_images.splice(index, 1);
                    var data = JSON.stringify(items.other_images);
                    $('.images-input').val(data);
                }
            },
            FormData(obj) {
                var formData = new FormData();
                for (var key in obj) {
                    formData.append(key, obj[key]);
                }
                return formData;
            }
            ,
            AddCategory(el) {
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
                                window.location = web_url + 'items/';
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
            }
            ,
            DeleteCategory(id, index) {
                dialog.Confirmation("Are you sure to move this category to trash?", function (response) {
                    if (response) {
                        let url = web_url + 'items/delete-category';
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
                                    if (index > -1) {
                                        items.categories.splice(index, 1);
                                    }
                                    dialog.Canceled();
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
            }
            ,
            GetSingleCategory(id) {
                let url = web_url + 'items/get-single-category';
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
                        items.category = response.data[0];
                    }
                });
                alert.close();
            }
            ,
            UpdateCategory(el) {
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
                            window.location = web_url + 'items';
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
            ,
            AddItems(el) {
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
            }
            ,
            GetAllitems: function (page) {
                alert.OnSuccess = false;
                alert.OnError = false;
                alert.OnWait = true;
                alert.loading = true;
                alert.message("Please wait...");
                alert.show = 'block';
                let formData = new FormData();
                let id = $('#category_id').val();
                formData.append("page", page);
                formData.append("id", id);
                axios.post(this.url + "items/get-all-items", formData).then(function (response) {
                    if (response.data != null) {
                        items.items = response.data.data;
                        items.start_page = response.data.CurrentlyPage;
                        items.end_page = response.data.TotalPage;
                        items.next_page = response.data.NextPage;
                        items.prev_page = response.data.PreviewsPage;
                        items.curr_page = response.data.CurrentlyPage;
                        items.items_show = 'block';
                        setTimeout(function () {
                            $('.page-item').removeClass('active');
                            $('.page_' + items.curr_page).addClass('active');
                        }, 500);

                    } else {
                        items.items_show = 'none';
                    }
                });
                alert.close();
            }
            ,
            DeleteItem(id, index) {
                dialog.Confirmation("Are you sure to move this item to trash?", function (response) {
                    if (response) {
                        let url = web_url + 'items/delete-item';
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
                                    if (index > -1) {
                                        items.items.splice(index, 1);
                                    }
                                    dialog.Canceled();
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
            }
            ,
            GetSingleItem(id) {
                let url = web_url + 'items/get-single-item';
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
                        items.item = response.data[0];
                        items.other_images = [];
                        setTimeout(function () {
                            $('#profile-input-update').val(response.data[0].image);
                            $('#update-images-input').val('');

                            if (response.data[0].other_image != "") {
                                items.other_images = JSON.parse(response.data[0].other_image);
                                $('#update-images-input').val(response.data[0].other_image);
                            }
                        },500);

                    }
                });
                alert.close();
            },
            UpdateItem(el) {
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
            }
            ,
        }

    })
;