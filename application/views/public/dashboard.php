<!-- <section> begin ============================-->
<div style="height: 30px;"></div>
<section class="py-0" id="outlet">

  <div class="container">

    <div class="row h-100 g-0">
      <div class="col-md-6">
        <div class="card card-span h-600 text-white">


          <div class="owl-carousel" style="height:600px">
            <?php
            foreach ($dashboard as $key => $value) { ?>
              <div><img class="" src="<?php echo base_url('uploads/') . $value['img'] ?>" alt="Photo" width="100%"></div>
            <?php } ?>
          </div>

          <div class="card-img-overlay bg-dark-gradient rounded-0">
            <div class="p-5 p-md-2 p-xl-5 d-flex flex-column flex-end-center align-items-baseline h-100">
              <h1 class="fs-md-4 fs-lg-7 text-light">List Of House Property</h1>
            </div>
          </div><a class="stretched-link" href="#!"></a>
        </div>
      </div>


      <div class="col-md-6 h-100">
        <div class="row h-100 g-0">
          <?php
          foreach ($list as $key => $value) { ?>
            <div class="col-md-6">
              <div class="card card-span h-100 text-white"><img class="card-img h-100" src="<?php echo base_url('uploads/') . $value['img'] ?>" alt=Photo />
                <div class="card-img-overlay bg-dark-gradient rounded-0">
                  <div class="p-5 p-xl-5 p-md-0">
                    <h3><a href="<?php echo base_url('Content/base/') . $value['name']; ?>"><?php echo $value['title'] ?></a></h3>
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