    <?php
      $data = $this->item;
    ?>
<div class="home-view">
<div class="item-widget">
  <fieldset>
  <legend style="padding: 10px;font-size: 22px;">RWF <?=$data->price?></legend>
  <p id="sale"><?=$data->name?></p>
  <div>


    <div class="plot-image">


      <div class="tab-content">

        <div id="main-image" class="tab-pane fade in active">
             <img src="<?=ASSETS?>default/files/<?=$data->image?>" class="slick-image">
        </div>

<?php
if(!empty($data->other_image)){
  $images = json_decode($data->other_image);
  foreach ($images as $index => $image) {
?>
        <div id="image_<?=$index?>" class="tab-pane fade">
             <img src="<?=ASSETS?>default/files/<?=$image?>" class="slick-image">
        </div>
<?php
  }}
?>

      </div>

  <section class="regular slider">
    <div>
      <img src="<?=ASSETS?>default/files/<?=$data->image?>" data-toggle="pill" href="#main-image">
    </div>

<?php
if(!empty($data->other_image)){
  $images = json_decode($data->other_image);
  foreach ($images as $index => $image) {
?>
    <div>
      <img src="<?=ASSETS?>default/files/<?=$image?>" data-toggle="pill" href="#image_<?=$index?>">
    </div>
<?php
  }}
?>
   
  </section>

    </div>
    <div class="plot-image-right">
      <div id="plots">
        <div id="divheader">Announce Location</div>
        <div id="divbody" class="<?= IsTrue($data->location, null, 'hide') ?>">
          <p><?=$data->location?></p>
        </div>
      </div>
      <div id="plots">
        <div id="divheader">Contact The Owner</div>
        <div id="divbody">
          <p class="<?= IsTrue($data->phone, null, 'hide') ?>"><span class="fa fa-phone"></span> <?=$data->phone?></p>
          <p class="<?= IsTrue($data->email, null, 'hide') ?>"><span class="fa fa-envelope"></span><?=$data->email?></p>
        </div>
      </div>
      <div id="plots">
        <div id="divheader">Status</div>
        <div id="divbody">
          <p id="Status"><span class="glyphicon glyphicon-ok" style="color: green;font-size: 35sspx;"></span> Available</p>
        </div>
      </div>
      <div id="plots">
        <div id="divheader">Other information</div>
         <ul class="other-information">
          <li class="<?= IsTrue($data->model, null, 'hide') ?>"><b>Model:</b>
              <span><?=$data->model?></span>
          </li>
          <li  class="<?= IsTrue($data->year, 0, 'hide') ?>"><b>Year:</b>
              <span><?=$data->year?></span>
          </li>
           <li  class="<?= IsTrue($data->plate_number, null, 'hide') ?>"><b>Plate Number:</b>
              <span><?=$data->plate_number?></span>
          </li>
         
           <li class="<?= IsTrue($data->measurement, null, 'hide') ?>"><b>Measurement:</b>
              <span><?=$data->measurement?></span>
          </li>
         </ul>
      </div>


<button class="btn btn-primary" data-toggle="modal" data-target="#contact-modal">Contact Us</button>


<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Contact us</h4>
      </div>
      <div class="modal-body">



 <form method="POST" action="<?=LINK?>item/contact" @submit.prevent="ContactUs($event)">
                        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <input type="text" name="name" placeholder="Your Full Name" class="form-control" required>
                                    </div>
                                </div>
                         
                              <input type="hidden" name="product_id" value="<?=$data->id?>">
                              <input type="hidden" name="type" value="customer">

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

                               

                                 <div class="col-lg-12">
                                    <div class="site-form-control">
                                        <textarea name="message" class="form-control" placeholder="Message"></textarea>
                                    </div>
                                </div>

    <div class="col-lg-12">
                                    <div class="site-form-control">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                 <div class="alert alert-success" v-if='notification != null' v-html='notification'></div>
                              </div>
                            </div>
                              </div>
  </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


    </div>
  </div>
 
</fieldset>



 <div class="product-more-content">
    <p>
      <?=$data->description?>
    </p>
</div>


  

<fieldset>
  <legend>Related items</legend>
    <div class="Announcements-container">
         <?php
$data =  $this->related_items;
foreach ($data as $item) {
?>
<a href="<?=LINK?>item/details/<?=$item->id?>">
  <div class="recent-widget">
  <div class="item-img">
     <img src="<?=ASSETS?>default/files/<?=$item->image?>">
   </div>
  <div class="item-content">
    <h6 class="item-header"><?=$item->name?></h6>
    <p  class="item-price"><b>FRW <?=number_format((string)$item->price)?></b></p>
    <p  class="item-location"><?=$item->location?></p>
   </div>
  </div>
</a>
<?php
}
?>
    </div>
</fieldset>
</div>




<div class="items-container">
  <fieldset>
  <legend style="background-color: #08773a;">Special Offers</legend>
  
<?php
$data =  $this->offers;
foreach ($data as $item) {
?>
<a href="<?=LINK?>item/details/<?=$item->id?>">
  <div class="offer-widget">
      <div class="offer-img">
        <img src="<?=ASSETS?>default/files/<?=$item->image?>">
      </div>
      <div class="offer-content">
        <p class="offer-title"><?=$item->name?></p>
        <p class="offer-location"><?=$item->location?></p>
      </div>
       <div class="offer-price">FRW <?=number_format((string)$item->price)?></div>
  </div>
</a>
<?php
}
?>


</fieldset>



</div>
</div>

