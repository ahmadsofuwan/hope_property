<h1 class="fs-3 fs-lg-5 lh-sm mb-3 text-center">Unit Terbaru</h2>
    <section class="py-0">
        <div class="container">
            <div class="row h-100">
                <div class="col-12">
                    <div class="carousel slide" id="carouselNewArrivals" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <div class="row h-100 align-items-center g-2">
                                    <?php foreach ($newUnit as $key => $value) { ?>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white">
                                                <img class="card-img h-100" src="<?php echo base_url('uploads/') . $value['img'] ?>" />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h3 class="text-primary"><?php echo $value['titleads'] ?></h3>
                                                    <a href="<?php echo base_url('Content/base/') . $value['cityname']; ?>">
                                                        <h4 class="text-light"><?php echo $value['title'] ?></h4>
                                                        <p class="text-400 fs-1">Rumah KPR Bebas Riba</p>
                                                </div><a class="stretched-link" href="<?php echo base_url('Content/base/') . $value['cityname']; ?>"></a>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </section>