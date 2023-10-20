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
    if($act=='add'){
    ?>
<form action="<?php echo base_url() ?>user-store" method="post">
<?php
    }else{
    ?>
<form action="<?php echo base_url() ?>user-update" method="post">
<?php
    } 
    ?>
<?php echo csrf_field(); ?> 
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
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?? ''; ?>" required>
    </div>
    <?php
    if($act=='add'){
    ?>
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="password" value="<?php echo $user['password'] ?? ''; ?>" required>
    </div>
    <?php
    }
    ?>
    <input type="hidden"  name="id" value="<?php echo $user['id'] ?? ''; ?>" required> 
    <button type="submit" class="btn btn-primary">Save</button>
  </form>


  
</div>



</div> 

<?php
$this->endSection() 
?>

