<div class="upload-widget"  style="display: none" v-bind:style="{ display: upload_widget}">
      <div class="upload-overlay"></div>
    <div class="upload-wrapper">
      <div class="upload-window fadeInUp">
          <div class="upload-header">
          <div class="upload-ribbon">
            <span class="text-white"><i class="mdi mdi-file-document"></i> Files</span>
              <a href="javascript:void(0)" @click="upload_widget = 'none' " class="upload-close-btn"><span class="mdi mdi-circle"></span></a>
          </div>
          <div class="upload-tabs">
               <button class="btn  outline-success"  v-bind:class="{ ' btn-success' :  upload_file}" @click=" upload_file = true,uploaded_file = false, upload_search_panel = false">UPLOAD</button>
               <button class="btn outline-success" v-bind:class="{ ' btn-success' :  uploaded_file}" @click=" uploaded_file = true, upload_file = false, upload_search_panel = true,GetAllFiles()">FILES</button>
          </div>
          </div>
          <div class="upload-body"  ref="drager"  v-if="upload_file">
          <div class="row fadeInLeft" v-if="upload_list">
              <div class="col-lg-4 upload-column" v-for="(fileData, key) in  filesData">
                  <div class="pending-uploads-card">
                 <div class="upload-preview">
                     <img src="<?=ASSETS?>admin/images/ext/audio.png" v-if="fileData.ext == 'mp3'  || fileData.ext == 'mpeg'">
                     <img src="<?=ASSETS?>admin/images/ext/pdf.png" v-if="fileData.ext == 'pdf' ">
                     <img src="<?=ASSETS?>admin/images/ext/excel.png" v-if="fileData.ext == 'xlsx' ">
                     <img src="<?=ASSETS?>admin/images/ext/word.png" v-if="fileData.ext == 'docs' ">
                     <img src="<?=ASSETS?>admin/images/ext/video.png" v-if="fileData.ext == 'mp4' ">
                     <img src="<?=ASSETS?>admin/images/ext/photo.png" v-if="fileData.ext == 'png' ">
                     <img src="<?=ASSETS?>admin/images/ext/photo.png" v-if="fileData.ext == 'jpg' ">
                     <img src="<?=ASSETS?>admin/images/ext/photo.png" v-if="fileData.ext == 'gif' ">
                 </div>
                  <div class="upload-info">
                      <span class="upload-file-name">{{ fileData.name }}</span>
                      <div class="progress">
                          <div class="progress-bar" v-bind:style="{ width: fileData.parc+'%'}"></div>
                      </div>
                      <div class="upload-processed"><span class="parcentage">{{fileData.parc}}/100%</span>   <span class="upload-size">{{fileData.uploadsize}} / {{fileData.filesize}}</span> </div>
                  </div>
                  <div class="upload-option">
                      <a href="javascript:void(0)" v-if=" fileData.status == 'wait' "  v-on:click="removeFile( key )" class="upload-cancel-btn"><span class="mdi mdi-circle"></span></a>
                      <a href="javascript:void(0)"  v-if=" fileData.status == 'wait' " v-on:click="uploadFile( key )" class="upload-item-btn"><span class="mdi mdi-upload"></span></a>
                  </div>
                  </div>
              </div>
          </div>

              <div class="row" v-if="dragging">
                  <div class="col-12 item-center">
                       <div class="drag-file-widget">
                           <span class="mdi mdi-drag"></span>
                           <h4>Drad file hire to upload</h4>
                       </div>
                  </div>
              </div>
      </div>


        <div class="uploaded-body" v-if="uploaded_file">
          <div class="row fadeInRight" >
              <div class="col-9">
                <div class="file-items">
                <div class="row">

                    <div class="col-4 " style="padding: 4px" v-for="(file, key) in  files" >
                        <div class="item-card fadeInLeft" @click="SelectFile(key)">
                            <div class="item-preview item-center">

                                <div class="image-preview"  v-if="file.ext == 'jpg' || file.ext == 'png' || file.ext == 'JPG' || file.ext == 'gif' "  v-bind:style="{ background: 'url(<?=ASSETS?>default/files/'+file.virtual_name+')', 'background-position': 'center' , 'background-size': 'contain' , 'background-repeat': 'no-repeat' } "  ></div>
                                <audio controls v-if="file.ext == 'mp3' " style="background: #fff url('<?= ASSETS ?>admin/images/ext/audio.png');    background-position: center;  background-size: contain; background-repeat: no-repeat;">
                                    <source :src="'<?=ASSETS?>default/files/'+file.virtual_name" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <video  controls v-if="file.ext == 'mp4'  || file.ext == 'MP4' ">
                                    <source :src="'<?=ASSETS?>default/files/'+file.virtual_name" type="video/mp4">
                                    Your browser does not support HTML5 video.
                                </video>


                            </div>
                            <div class="item-options">
                                <p class="file-name">{{file.file_name}}</p>
                                <div class="btn-group dropdown">
                                    <a  href="javascript:void(0)" class="menu" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                        <span class="fa fa-ellipsis-v"></span>
                                    </a>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform;top: -96px !important;left: -142px !important; ">
                                        <a class="dropdown-item"  href="javascript:void(0)" @click="DeleteFile(file.id,key)">
                                            <i class="fa fa-trash fa-fw"></i>Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                </div>
              </div>
              <div class="col-3">
                  <div class="file-info-widget item-center" v-if="!isFileInfo">
                       <h3 class="text-gray">No file selected</h3>
                  </div>
                  <div class="file-info-widget-data" v-if="isFileInfo">
                      <div class="">
                          <div class="item-preview item-center">

                              <div class="image-preview  fadeInLeft"  v-if="filedetails.ext == 'jpg' || filedetails.ext == 'png' || filedetails.ext == 'JPG' || filedetails.ext == 'gif' "  v-bind:style="{ background: 'url(<?=ASSETS?>default/files/'+filedetails.virtual_name+')', 'background-position': 'center' , 'background-size': 'contain' , 'background-repeat': 'no-repeat' } "  ></div>

                              <audio class=" fadeInLeft" controls v-if="filedetails.ext == 'mp3' " style="background: #fff url('<?= ASSETS ?>admin/images/ext/audio.png');    background-position: center;  background-size: contain; background-repeat: no-repeat;">
                                  <source :src="'<?=ASSETS?>default/files/'+filedetails.virtual_name" type="audio/mpeg">
                                  Your browser does not support the audio element.
                              </audio>

                              <video class=" fadeInLeft"  controls v-if="filedetails.ext == 'mp4'  || filedetails.ext == 'MP4' ">
                                  <source :src="'<?=ASSETS?>default/files/'+filedetails.virtual_name" type="video/mp4">
                                  Your browser does not support HTML5 video.
                              </video>

                          </div>
                          <div class="item-options">
                              <p class="file-name">{{filedetails.file_name}}</p>
                          </div>
                      </div>
                      <div class="item-options">
                          <button type="button" @click="EnterFile(filedetails.virtual_name,'<?=ASSETS?>default/files/'+filedetails.virtual_name)" class="btn btn-outline-success  btn-sm">Select</button>
                          <button type="button" @click="DeleteFile(filedetails.id,filedetails.key)" class="btn btn-outline-danger  btn-sm">Trash</button>
                      </div>

                  </div>
              </div>
          </div>
        </div>

          <div class="upload-footer">
              <div class="row" v-if="upload_search_panel">
                  <div class="col-12">
                      <div class="search-widget">
                         <input class="form-control" placeholder="Search file" v-model="fileKeyword"  v-on:keyup="SeachFile()" type="text">
                          <select class="form-control" v-on:change="SeachFileByType()" v-model="fileKeyword">
                              <option selected value="">Select file type</option>
                              <option value="mp3,ogg,acc">Audio</option>
                              <option value="mp4,avi,vob,mov">Video</option>
                              <option value="png,gif,jpg">Images</option>
                              <option value="doc,docs,xlsx,pdf">Document</option>
                          </select>
                          <button type="button" class="btn btn-info btn-fw"  v-on:click="GetAllFiles()">Reflesh</button>
                      </div>
                  </div>
              </div>

                  <button v-if="upload_file" @click="AddFiles()" class="btn btn-icons btn-rounded btn-success text-white btn-add-files fadeIn"><span class="mdi mdi-plus"></span></button>
                  <button v-if="upload_file"    @click="UploadAllFiles()" class="btn btn-icons btn-rounded btn-dark text-white  upload-upload-all-btn fadeIn"><span class="mdi mdi-upload"></span></button>
                   <input type="file" id="files" ref="files" class="hide" multiple v-on:change="handleFilesUpload()"/>
          </div>
      </div>
    </div>
</div>