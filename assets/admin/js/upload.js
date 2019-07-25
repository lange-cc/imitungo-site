var web_url = document.getElementById('LINK').value;
var uploads = new Vue({
        el: '.upload-widget',
        data: {
            url: web_url,
            upload_widget:'none',
            reciever_element:null,
            upload_file: true,
            upload_list:true,
            uploaded_file: false,
            filesData: [],
            isUploading:false,
            isComplete:false,
            dragging:true,
            backcolor:null,
            upload_search_panel:false,
            files:null,
            isFileInfo:false,
            filedetails:null,
            fileKeyword:null,
            obj:null,
            preview:null
        },
        mounted() {
            if(this.upload_widget != 'none'){
                this.onDrag();
                this.GetFileOnDrag();
            }
        this.GetAllFiles();
        },
        methods: {
            AddFiles: function () {
                this.$refs.files.click();
            },
            handleFilesUpload() {
                this.dragging = false;
                let uploadedFiles = this.$refs.files.files;
                for (var i = 0; i < uploadedFiles.length; i++) {
                    var file = {
                        'file': uploadedFiles[i],
                        'name': uploadedFiles[i].name,
                        'ext': this.GetExt(uploadedFiles[i].type),
                        'parc': 0,
                        'uploadsize': this.BytesToSize(0),
                        'filesize': this.BytesToSize(uploadedFiles[i].size),
                        'status':'wait'
                    };
                    this.filesData.push(file);
                }
            },
            BytesToSize(bytes) {
                var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes == 0) return '0 Byte';
                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
            },
            GetExt(name) {
                return name.substr(name.lastIndexOf('\\') + 1).split('/')[1];
            },
            removeFile(key) {
                this.filesData.splice(key, 1);
            },
            uploadFile( key ){
                this. isUploading = true;
                this.isComplete = false;
               let formData = new FormData();
               let file = this.filesData[key].file;
               formData.append('file', file);
                axios.post( this.url+'uploader/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },onUploadProgress: function( progressEvent ) {
                            this.filesData[key].parc = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) );
                            this.filesData[key].uploadsize = this.BytesToSize(parseInt(progressEvent.loaded));
                        }.bind(this)
                    }
                ).then(function(){
                    this.filesData[key].status = 'done';
                    this. isUploading = false;
                    this.isComplete = true;
                }.bind(this)).catch(function(){
                    this.filesData[key].status = 'wait';
                    this. isUploading = false;
                    this.isComplete = true;
                    }.bind(this));
            },
            UploadAllFiles(){
                var length = this.filesData.length;
                var index = 0;
                var time = 500;
                var task = null;
                task = setInterval(() => {
                    //====================
                    if( index < length) {
                        if(this.isUploading == false){
                            if (this.filesData[index].status == 'wait') {
                                this.uploadFile(index);
                            }
                            if( this.isComplete == true){
                                    index = index +1;
                                }
                            }
                        }else{
                        clearInterval(task);
                    }
                    //=====================
                }, time);

            },
            onDrag(){
                ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach( function( evt ) {
                this.$refs.drager.addEventListener(evt, function(e) {
                e.stopPropagation();
                e.preventDefault();
                e.dataTransfer.dropEffect = 'copy';
                    this.dragging = true;
                    this.upload_list = false;
                    this.uploaded_file = false;
                     }.bind(this), false);
                }.bind(this));
            },
            GetFileOnDrag(){
                this.$refs.drager.addEventListener('drop', function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    this.dragging = false;
                    this.upload_list = true;
                    this.uploaded_file = false;
                    let uploadedFiles = e.dataTransfer.files; // Array of all files
                    for (var i = 0; i < uploadedFiles.length; i++) {
                        var file = {
                            'file': uploadedFiles[i],
                            'name': uploadedFiles[i].name,
                            'ext': this.GetExt(uploadedFiles[i].type),
                            'parc': 0,
                            'uploadsize': this.BytesToSize(0),
                            'filesize': this.BytesToSize(uploadedFiles[i].size),
                            'status': 'wait'
                        };
                        this.filesData.push(file);
                    }
                }.bind(this), false);
            },
            GetAllFiles(){
                axios.get(web_url+"uploader/AllFiles")
                    .then(function(response){
                        if(response.data != null){
                            uploads.files = response.data;
                        }else{

                        }
                    });
            },
            SelectFile(key){
                uploads.filedetails =  uploads.files[key];
                uploads.filedetails.key = key;
                uploads.isFileInfo = true;
            },
            DeleteFile(id,key){
                var formData = this.FormData({id:id});
                axios.post(web_url+"uploader/Delete",formData)
                    .then(function(response){
                        if(response.data != null){
                            uploads.files.splice(key, 1);
                            uploads.isFileInfo = false;
                            uploads.filedetails = null;
                        }else{

                        }
                    })

            },
            FormData(obj) {
                var formData = new FormData();
                for (var key in obj) {
                    formData.append(key, obj[key]);
                }
                return formData;
            },
            SeachFile(){
                var keyword = this.fileKeyword;
                var formData = this.FormData({keyworld:keyword});
                axios.post(web_url+"uploader/Search",formData)
                    .then(function(response){
                        if(response.data != null){
                            uploads.files = response.data;
                        }else{

                        }
                    })
            },
            SeachFileByType(){
                var keyword = this.fileKeyword;
                if(keyword != '') {
                    var formData = this.FormData({keyworld: keyword});
                    axios.post(web_url + "uploader/SearchByType", formData)
                        .then(function (response) {
                            if (response.data != null) {
                                uploads.files = response.data;
                                uploads.isFileInfo = false;
                            } else {

                            }
                        })
                }
            },
           EnterFile(filename,url){
                uploads.upload_widget = 'none';
                if(uploads.preview != null){
                    $(uploads.reciever_element).val(filename);
                    $(uploads.preview).hide();
                    uploads.obj.profile = false;
                    $(uploads.preview+' img').attr("src",url);
                    $(uploads.preview).show();
                }else{
                    uploads.obj.FileNameTaker(filename);
                }
            }

        }

    })
;