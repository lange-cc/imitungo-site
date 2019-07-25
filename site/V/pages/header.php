<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=1464">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="shortcut icon" href="<?= ASSETS ?>website/tmp/img/logo.jpg"/>
    <title><?=IsDefined($this->title)?></title>
<?php
if(TURBOLINK_JS) {
    ?>
    <style>
        .turbolinks-progress-bar
        {
            background: #40e0d0; /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #40e0d0, #ff8c00, #ff0080); /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #40e0d0, #ff8c00, #ff0080); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    </style>
    <script src="<?=ASSETS ?>default/js_plugin/turbolinks.js"></script>
    <script>
        document.addEventListener("turbolinks:load", function() {
            Turbolinks.clearCache()
        }
    </script>
    <?php
}
?>

<?php
if(BOOTSTRAP) {
    ?>
    <link rel="stylesheet" href="<?=ASSETS ?>default/css/bootstrap/bootstrap.css" data-turbolinks-track="reload">
    <?php
}?>
<?php
if(ANIMATION) {
    ?>
    <link rel="stylesheet" href="<?=ASSETS ?>default/css/animate.css" data-turbolinks-track="reload">
    <?php
}?>



  <link rel="stylesheet" href="<?= ASSETS ?>admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= ASSETS ?>admin/vendors/iconfonts/font-awesome/css/font-awesome.css">
  <link rel="stylesheet"  type="text/css" href="<?= ASSETS ?>website/tmp/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>website/css/main.css">
  


<?php
if (isset($this->css)) {
foreach ($this->css as $css) {
if(file_exists("assets/". $css)){
?>
<link rel="stylesheet" href="<?php echo ASSETS . $css; ?>" >
    <?php
}else{
    $error = array(
        'Type' => 'File missing',
        'Message' =>  "CSS file not found on ".ASSETS . $css,
        'Dir' => "assets/". $css,
        'Code' => '0001'
    );
    SYSTEM_ERROR::render_error($error);
}
}
}
?>


 </head>
<body>

<input value="<?= LINK ?>" id="LINK" type="hidden">

  
<div id="navbar">
 <div class="img-logo">
   <img src="<?=ASSETS?>img/logo.jpg" id="logo">
 </div>

  <nav class="main-menu">
    <div class="" id="myNavbar">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav">
        <li><a class="" href="<?=LINK?>" id="home">HOME</a></li>
        <?php
  $category = $this->category_menu;
  foreach ($category as $item) {
?>
        <li><a href="<?=LINK?>category/view-item/<?=$item->id?>" style="text-transform: uppercase;"><?=$item->name?></a></li>
  <?php
  }
  ?>
      </ul>
    </div>

<form action="#" method="POST" id='search-form'>
  <div class="input-group" style="position: relative;">
    <input type="text" class="form-control" name="email" placeholder="Search" required autocomplete="off" style="border-radius: 0px;border: 1px black solid;" v-on:keyup="SearchItems" v-model="keyworld">
    <div class="input-group-btn">
      <button class="btn btn-default search_btn" type="submit"><i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
    <div class="search-item-wiget" v-if="keyworld != ''">

<a v-for="item in search_items" :href="'<?=LINK?>item/details/'+item.id">
  <div class="recent-widget">
  <div class="item-img">
     <img :src="'<?=ASSETS?>default/files/'+item.image">
   </div>
  <div class="item-content">
    <h6 class="item-header" v-html='item.name'></h6>
    <p class="item-price"><b v-html='"FRW "+item.price'></b></p>
    <p class="item-location" v-html='item.location'></p>
   </div>
  </div>
</a>


    </div>
  </div>
</form>

<a href="#"  data-toggle="modal" data-target="#offer-modal" class="btn btn-success offer-btn">Offer your property</a>

</nav>  

</div>



<div class="modal fade" id="offer-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Offer your property</h4>
      </div>
      <div class="modal-body">

<div class="modal-section-title">Your Information</div>


 <form method="POST" id="user-details">
                        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="text" name="name" placeholder="Your Full Name" class="form-control" required>
                                    </div>
                                </div>
                         
                              

                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                                    </div>
                                </div>

                                  <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                 <input type="hidden" class="form-control" name="type" value="dealer">


                                 <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <textarea name="message" class="form-control" placeholder="Message"></textarea>
                                    </div>
                                </div>
                              </div>
  </form>


<div class="modal-section-title">Property Details</div>

  <p> 
<i>Jump field if does not match to your property</i>
</p>




       <form action="<?=LINK?>home/submit-offer"  @submit.prevent="SubmitOffer($event)" method="POST">
                          
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="text" name="name" placeholder="Property Title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <div class="single-upload-widget">
                                            <div class="single-upload fadeInDown" v-if='upload == true' @click="AddFiles()">
                                                <h5>Select Image</h5>
                                                <p class="site-text-color"> For product</p>
                                                <p v-html='parc+"%"'></p>
                                            </div>
                                            <div class="single-upload fadeInDown" v-if='filename != null && upload == false'>
                                                <img :src="'<?=ASSETS?>default/files/'+filename" class="img-responsive" style="width: 100%;">
                                                <a class="btn profile-cancel-btn" @click="upload = true">  &times; </a>
                                            </div>
                                        </div>
                                         <input type="file" id="files" ref="files" class="hide" v-on:change="handleFilesUpload()"/>
                                        <input name="image" id="profile-input" :value="filename" type='hidden'>
                                    </div>
                                </div>
                        

                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="text" name="location" class="form-control" placeholder="Location" required>
                                    </div>
                                </div>

                              

                                <div class="col-lg-12">
                                    <h5>Category</h5>
                                    <div class="site-form-control">
                                        <select class="form-control" name="category_id">
                                          <?php
  $category = $this->category;
  foreach ($category as $item) {
?>
                                            <option value="<?=$item->id?>"><?=$item->name?></option>
                                            <?php
  }
  ?>
                                            
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="creator" value="client">
                                <input type="hidden" class="form-control" name="status" value="pending">


                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="text" name="model" class="form-control" placeholder="Model">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="number" name="price" class="form-control" placeholder="Price EX:200000" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="numbers" name="year" class="form-control" placeholder="Year">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="text" name="plate_number" class="form-control" placeholder="Plate Number">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <textarea name="measurement" style="height: 150px;" class="form-control" placeholder="Measurement"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <textarea name="description" style="height: 200px;" class="form-control" placeholder="Description" required></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 v-spacer">
                                    <div class="site-form-control">
                                         <button type="submit" class="btn btn-primary">Submit</button>

                                         <div class="alert alert-success" v-if='notification != null' v-html='notification'></div>
                                    </div>
                                </div>
                            </div>
                        </form>


      </div>
      <div class="modal-footer">
       
        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>