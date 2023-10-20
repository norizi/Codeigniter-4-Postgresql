<?php
$this->extend('layout/default') 
?>

<?php
$this->section('content')
?>
<div class="container-fluid mt-3">
  


<div class="container mt-3">
<?php $validation = \Config\Services::validation(); ?>

<?php if ($validation->hasError('name')) : ?>
    <div class="alert alert-danger"><?= $validation->getError('name') ?></div>
<?php endif; ?>
                  <?php 
                   // Display Response
                   if(session()->has('error')){
                   ?>

                  <div class="alert alert-danger">
                    <strong>Error !</strong> <?= session()->getFlashdata('error') ?>
                  </div>
                         
                   <?php
                   }
                   ?>

<?php 
                   // Display Response
                   if(session()->has('success')){
                   ?>

                  <div class="alert alert-success">
                    <strong>Success !</strong> <?php echo session()->getFlashdata('success') ?>
                  </div>
                         
                   <?php
                   }
                   ?>  
                   
<form action="<?php echo base_url() ?>profile-update" method="post" enctype="multipart/form-data">
 
<?php echo csrf_field(); ?> 

<?php if(!empty($user['photo'])){ 
      $imageURL = base_url().'public/uploads/' . $user['photo'];
    ?>
    <div class="mb-3 mt-3">

    <img id="imgPreview" src="<?= $imageURL ?>" alt="pic" class="img-thumbnail" width="304" height="236"> 
    </div>
    <?php }else{ ?>

      <div class="mb-3 mt-3">
         
         <img id="imgPreview" src="#" alt="pic" class="img-thumbnail" width="304" height="236"> 
       </div>
      <?php } ?>

    
    <div class="mb-3 mt-3">
      <label for="email">Photo:</label>
      <input class="form-control" type="file" id="photo" name="file">
    </div>
     

    <div class="mb-3 mt-3">
      <label for="email">Name:</label>
      <input type="text" class="form-control" id="email" name="name" value="<?php echo $user['name'] ?? ''; ?>">
    </div>
    <?php if( $validation->getError('name') ) {?>

    <div class='text-danger mt-2'>
          <?php $validation->getError('name'); ?>
    </div>

    <?php }?>

    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?? ''; ?>" readonly>
    </div>

    
     
    <input type="hidden"  name="id" value="<?php echo $user['id'] ?? ''; ?>" required> 
    <button type="submit" class="btn btn-primary">Save</button>
  </form>


  
</div>



</div> 

<script>
            $(document).ready(() => {
                $("#photo").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $("#imgPreview")
                              .attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>


<?php
$this->endSection() 
?>

