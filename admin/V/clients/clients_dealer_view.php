<!-- 
NAME: TUMUSHIME Leonard
DATE: 13 MAY 2019
VERSION: 0.1
 -->

<div class="content-wrapper">
<div class="client-widget">
    <div class="inventory-ribbon">
          <div class="inventory-section-title">
                <span class="mdi mdi-account"></span> <?=$this->name?>
          </div>
        <div class="tool-bar">
            <a href="<?=LINK?>clients/" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="body-widget">
    	<div class="row">

	    	<div class="client-info-container col-lg-6">
	    				<h4>Client Details</h4>
	    				<hr>
	    		<div class="row">

	    			<div class="col-12">
	    				<div class="row">
	    					<div class="col-lg-4">
	    				      <p>Name</p>
	    			        </div>
	    			        <div class="col-lg-7">
	    				      <p><?=$this->data->name?></p>
	    			        </div>
	    				</div>
	    			</div>

	    		
	    		  <div class="col-12">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				    <p>Phone</p>
	    			    </div>
	    			    <div class="col-lg-7">
	    				    <p><?=$this->data->phone?></p>
	    			    </div>
	    			  </div>
	    		  </div>

	    		  <div class="col-12">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Email</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    				  <p><?=$this->data->email?></p>
	    			  </div>
	    			</div>
	    		  </div>

	    		  <div class="col-12">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Message</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    				  <p><?=$this->data->message?></p>
	    			  </div>
	    			</div>
	    		  </div>


	    		</div>
	    	</div>


<div class="client-info-container col-lg-6">
			<h4>Product Details</h4>
			<hr>
     <div class="row">

	    		<div class="col-12 <?=IsTrue($this->item->name, null, 'hide')?>" style="margin-bottom: 30px">
	    				<div class="row">
	    					<div class="col-lg-4">
	    				      <p>Product Name</p>
	    			        </div>
	    			        <div class="col-lg-7">
	    				      <p><?=$this->item->name?></p>
	    			        </div>
	    				</div>
	    		</div>

	    		
	    		<div class="col-12 <?= IsTrue($this->item->image, null, 'hide') ?>" style="margin-bottom: 30px">
	    			<div class="row">
	    			  <div class="col-lg-4">
	    				 <p>Product image</p>
	    			  </div>
	    			  <div class="col-lg-7">
	    			   <img src="<?=ASSETS?>default/files/<?=$this->item->image?>" class="img-responsive">
	    			  </div>
	    			</div>
	    		</div>

	    		  <div class="col-12 <?= IsTrue($this->item->location, null, 'hide') ?>" style="margin-bottom: 30px">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Location</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    				  <p><?=$this->item->location?></p>
	    			  </div>
	    			</div>
	    		  </div>

	    		  <div class="col-12 <?= IsTrue($this->item->price, null, 'hide') ?>" style="margin-bottom: 30px">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Price</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    				  <p><?=$this->item->price?></p>
	    			  </div>
	    			</div>
	    		  </div>

	    		<div class="col-12 <?= IsTrue($this->item->year, null, 'hide') ?>" style="margin-bottom: 30px">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Year</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    				  <p><?=$this->item->year?></p>
	    			  </div>
	    			</div>
	    		  </div>


	    		<div class="col-12 <?= IsTrue($this->item->plate_number, null, 'hide') ?>" style="margin-bottom: 30px">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Plate number</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    				  <p><?=$this->item->plate_number?></p>
	    			  </div>
	    			</div>
	    		  </div>

	    		  <div class="col-12 <?= IsTrue($this->item->description, null, 'hide') ?>" style="margin-bottom: 30px">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Description</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    				  <p><?=$this->item->description?></p>
	    			  </div>
	    			</div>
	    		  </div>

	    		  <div class="col-12 <?= IsTrue($this->item->measurement, null, 'hide') ?>" style="margin-bottom: 30px">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Measurement</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    				  <p><?=$this->item->measurement?></p>
	    			  </div>
	    			</div>
	    		  </div>

	    		 <div class="col-12 <?= IsTrue($this->item->phone, null, 'hide') ?>" style="margin-bottom: 30px">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Phone</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    				  <p><?=$this->item->phone?></p>
	    			  </div>
	    			</div>
	    		  </div>

	    		   <div class="col-12 <?= IsTrue($this->item->email, null, 'hide') ?>" style="margin-bottom: 30px">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Email</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    				  <p><?=$this->item->email?></p>
	    			  </div>
	    			</div>
	    		  </div>

	    		   <div class="col-12 <?= IsTrue($this->item->status, null, 'hide') ?>" style="margin-bottom: 30px">
	    			  <div class="row">
	    			    <div class="col-lg-4">
	    				  <p>Status</p>
	    			    </div>
	    			  <div class="col-lg-7">
	    			  	 <input type="hidden" value="<?=$this->item->id?>" id="id">
	    			  	<form action="<?=LINK?>clients/change-status/" method="POST" @submit.prevent="ChangeStatus($event)">
	    			  	<select name="status" class="form-control">
	    			  		<option value="pending" <?=IsTrue($this->item->status,'pending','selected')?> >
	    			  		  Pending
	    			  		</option>
	    			  		<option value="published" <?=IsTrue($this->item->status,'published','selected')?>>Published
	    			  		</option>
	    			  		<option value="canceled" <?=IsTrue($this->item->status,'canceled','selected')?>>
	    			  		  Canceled
	    			  		</option>
	    			  	</select>

	    			  	<button type="submit" class="btn btn-primary">Change</button>

	    			  	</form>
	    			  </div>
	    			</div>
	    		  </div>







	    		</div>
</div>





    	</div>
    </div>
</div>
</div>
