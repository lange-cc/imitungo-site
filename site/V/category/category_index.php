<div class="home-view">
	<div class="all-item-widget">
		<div class="all-items">

<?php
$data =  $this->items;
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
	</div>
</div>