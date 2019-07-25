<div class="home-view">

    <div class="items-container-recent">

        <div class="slide-container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php
$data = $this->slider;
foreach ($data as $key => $item) {
    if ($item->image != '') {
        ?>
                    <div class="item <?=IsTrue($key, 0, 'active')?>">
                        <img src="<?=ASSETS?>default/files/<?=$item->image?>">
                        <div class="carousel-caption">
                            <h3><?=$item->title?></h3>
                            <p><?=$item->sub_title?></p>
                        </div>
                    </div>
                    <?php
} else {
        ?>

                    <div class="item <?=IsTrue($key, 0, 'active')?>">
                        <iframe width="100%" height="450" src="https://www.youtube.com/embed/<?=$item->video?>"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>

                    <?php
}
}
?>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


        <div class="main-widget">
            <fieldset>
                <legend>Recent added</legend>
                <?php
$data = $this->recently_items;
foreach ($data as $item) {
    ?>
                <a href="<?=LINK?>item/details/<?=$item->id?>">
                    <div class="recent-widget">
                        <div class="item-img">
                            <img src="<?=ASSETS?>default/files/<?=$item->image?>">
                        </div>
                        <div class="item-content">
                            <h6 class="item-header"><?=$item->name?></h6>
                            <p class="item-price"><b>FRW <?=number_format((string) $item->price)?></b></p>
                            <p class="item-location"><?=$item->location?></p>
                            <p class="item-date"><?=$item->updated_date?></p>
                        </div>
                    </div>
                </a>
                <?php
}
?>

            </fieldset>

            <div class="">

                <!--   <fieldset>
    <legend>Main Sections</legend>

<div class="section-list">

<?php
$category = $this->category;
foreach ($category as $item) {
    ?>
  <div class="section-widget">
    <a href="<?=LINK?>category/view-item/<?=$item->id?>">
    <div class="section-overlay">
      <span class="section-title"><?=$item->name?></span>
    </div>
    </a>
  </div>
<?php
}
?>



</div>

</fieldset> -->

                <fieldset>
                    <legend>Most Popular</legend>


                    <?php
$data = $this->popular;
foreach ($data as $item) {
    ?>
                    <a href="<?=LINK?>item/details/<?=$item->id?>">
                        <div class="recent-widget">
                            <div class="item-img">
                                <img src="<?=ASSETS?>default/files/<?=$item->image?>">
                            </div>
                            <div class="item-content">
                                <h6 class="item-header"><?=$item->name?></h6>
                                <p class="item-price"><b>FRW <?=number_format((string) $item->price)?></b></p>
                                <p class="item-location"><?=$item->location?></p>
                                <p class="item-date"><?=$item->updated_date?></p>
                            </div>
                        </div>
                    </a>
                    <?php
}
?>

                </fieldset>
            </div>
        </div>



    </div>





    <div class="items-container-offer">
        <fieldset>
            <legend style="background-color: #08773a;">Special Offers</legend>


            <?php
$data = $this->offers;
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
                    <div class="offer-price">FRW <?=number_format((string) $item->price)?></div>
                    <p class="item-date"><?=$item->updated_date?></p>
                </div>
            </a>
            <?php
}
?>


        </fieldset>


    </div>

</div>







<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <p id="send">Send Your Answer</p>
        </div>
        <div class="modal-body">

            <form align="center" action="insert_file.php" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><label>Email<up>* </up></label></td>
                        <td><input type="email" name="email" placeholder="Enter your email"></td>
                    </tr>
                    <tr>
                        <td><label>Subject<up>* </up></label></td>
                        <td><input type="text" name="email" placeholder="subject"></td>
                    </tr>
                    <tr>
                        <td><label>Message<up>* </up></label></td>
                        <td><textarea name="message" placeholder="Message..." cols="40" rows="8"></textarea></td>
                    </tr>
                </table>
                <center><input type="submit" name="submit" value="SEND" id="sendbtn" align="center"></center>
            </form>

        </div>

    </div>
</div>