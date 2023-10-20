<?php
$this->extend('layout/default') 
?>

<?php
$this->section('content')
?>
<div class="container-fluid mt-3">
  


<div class="container mt-3">
 
  <h2>Audit Log Using Datatable</h2>
                  <?php 
                   // Display Response
                   if(session()->has('success')){
                   ?>

                  <div class="alert alert-success">
                    <strong>Success !</strong> <?php session()->getFlashdata('success') ?>
                  </div>
                         
                   <?php
                   }
                   ?>  
 

  <table id="example" class="table table-bordered">
    <thead>
      <tr>
        
        <th>Name</th>
        <th>Action</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($auditlogs as $auditlog){ ?>
        
      <tr>
       
        <td><?php echo $auditlog['name']; ?></td>
        <td><?php echo $auditlog['action_made']; ?></td>
        <td><?php echo $auditlog['created_at']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

    
    
    

      


</div>



</div> 

<?php
$this->endSection() 
?>

