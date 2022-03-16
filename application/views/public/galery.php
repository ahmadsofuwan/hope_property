<h2 class="section-title">Galery</h2>

<section class="py-0" id="outlet">
    <div class="container">

        <div class="row h-100 g-0">
            <div class="col-md-6">
                <div class="card card-span h-100 text-white"><img class="card-img h-100" src="<?php echo base_url('uploads/' . $galery[0]['img']) ?>" alt="..." />
                    <div class="card-img-overlay bg-dark-gradient rounded-0">
                        <div class="p-5 p-md-2 p-xl-5 d-flex flex-column flex-end-center align-items-baseline h-100">
                            <h1 class="fs-md-4 fs-lg-7 text-light"><?php echo $galery[0]['title'] ?> </h1>
                        </div>
                    </div><a class="stretched-link" href="#!"></a>
                </div>
            </div>

            <div class="col-md-6 h-100">
                <div class="row h-100 g-0">
                    <?php
                    for ($i = 1; $i < count($galery); $i++) { ?>
                        <div class="col-md-6 h-100">
                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="<?php echo base_url('uploads/' . $galery[$i]['img']) ?>" alt="..." />
                                <div class="card-img-overlay bg-dark-gradient rounded-0">
                                    <div class="p-5 p-xl-5 p-md-0">
                                        <h3 class="text-light"><?php echo $galery[$i]['title'] ?></h3>
                                    </div>
                                </div><a class="stretched-link" href="#!"></a>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <!-- end of .container-->

</section>