<?php
$this->extend('layout/default') 
?>

<?php
$this->section('content')
?>
<div class="container-fluid mt-3">
  


<div class="container mt-3">
 
  <h2>Batch Processing</h2>
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
 
  <?php foreach ($batchedStaffs as $batch): ?>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Bil</th>
        <th>Name</th>
        <th>Email</th> 
        <th>Age</th> 
        <th>Gender</th> 
        <th>Address</th>
        <th>State</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
      $bil=1;
      foreach ($batch as $staff): ?>
        
      <tr>
        <td><?php echo $bil++; ?></td>
        <td><?php echo $staff->name; ?></td>
        <td><?php echo $staff->email; ?></td>
        <td><?php echo $staff->age; ?></td>
        <td><?php echo $staff->gender; ?></td>
        <td><?php echo $staff->address; ?></td>
        <td><?php echo $staff->state; ?></td>
         
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endforeach; ?>
 
    

      


</div>



</div> 

<?php
$this->endSection() 
?>

