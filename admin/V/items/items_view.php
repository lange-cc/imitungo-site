<!-- 
NAME: TUMUSHIME Leonard
DATE: 13 MAY 2019
VERSION: 0.1
 -->

<div class="content-wrapper">
    <div class="client-widget">
        <div class="inventory-ribbon">
            <div class="inventory-section-title">
                <span class="mdi mdi-account"></span> <?= $this->item->name ?>
            </div>
            <div class="tool-bar">
                <a href="<?= LINK ?>items/view-category/category/<?= $this->item->category_id ?>"
                   class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="body-widget">
            <div class="row">
                <div class="item-container col-lg-6">
                    <img src="<?= ASSETS ?>default/files/<?= $this->item->image ?>" class="img-responsive">
                </div>
                <div class="item-info-container col-lg-6">
                    <div class="row">

                        <div class="col-12 <?= IsTrue($this->item->location, null, 'hide') ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>Location </p>
                                </div>
                                <div class="col-lg-7">
                                    <p><?= $this->item->location ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 <?= IsTrue($this->item->status, null, 'hide') ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>Status</p>
                                </div>
                                <div class="col-lg-7">
                                    <p><?= $this->item->status ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12  <?= IsTrue($this->item->price, null, 'hide') ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>Price </p>
                                </div>
                                <div class="col-lg-7">
                                    <p><?= $this->item->price ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12  <?= IsTrue($this->item->year, null, 'hide') ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p> Year</p>
                                </div>
                                <div class="col-lg-7">
                                    <p><?= $this->item->year ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12  <?= IsTrue($this->item->plate_number, null, 'hide') ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>Plate number</p>
                                </div>
                                <div class="col-lg-7">
                                    <p><?= $this->item->plate_number ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12  <?= IsTrue($this->item->description, null, 'hide') ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>Description</p>
                                </div>
                                <div class="col-lg-7">
                                    <p><?= $this->item->description ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12  <?= IsTrue($this->item->measurement, null, 'hide') ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>Measurement</p>
                                </div>
                                <div class="col-lg-7">
                                    <p><?= $this->item->measurement ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12  <?= IsTrue($this->item->phone, null, 'hide') ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>Phone</p>
                                </div>
                                <div class="col-lg-7">
                                    <p><?= $this->item->phone ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12  <?= IsTrue($this->item->email, null, 'hide') ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>Email</p>
                                </div>
                                <div class="col-lg-7">
                                    <p><?= $this->item->email ?></p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
