<?php
$this->extend('layout/default') 
?>

<?php
$this->section('content')
?>
<div class="container-fluid mt-3">
  


<div class="container mt-3">
 
  <h2>List User Cache</h2>
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
 

  <table class="table table-bordered">
    <thead>
      <tr>
         
        <th>Name</th>
        <th>Email</th>
        
      </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user){ ?>
        
      <tr>
       
        <td><?php echo $user->name; ?></td>
        <td><?php echo $user->email; ?></td>
         
      </tr>
      <?php } ?>
    </tbody>
  </table>

    
      


</div>



</div> 

<?php
$this->endSection() 
?>

