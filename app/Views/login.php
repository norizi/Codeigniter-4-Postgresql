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
                   
<form action="<?php echo base_url() ?>login-auth" method="post">
 
     
    

    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?? ''; ?>" required>
    </div>
    
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="password" value="<?php echo $user['password'] ?? ''; ?>" required>
    </div>
     
    <?= csrf_field() ?>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>


  
</div>



</div> 

<?php
$this->endSection() 
?>

