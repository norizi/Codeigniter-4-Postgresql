<?php
$this->extend('layout/default') 
?>

<?php
$this->section('content')
?>
<div class="container-fluid mt-3">
  


<div class="container mt-3">
<a href="<?php echo base_url() ?>user-create" class="btn btn-primary">Create</a>

  <h2>List User</h2>
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
<form action="<?php echo base_url() ?>user-index" method='get'>
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search" name='search'>
  <button class="btn btn-success" type="submit">Search</button>
</div>
</form>

  <table class="table table-bordered">
    <thead>
      <tr>
         
        <th>Name</th>
        <th>Email</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user){ ?>
        
      <tr>
       
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td>
        <div class="btn-group">
        <a href="<?php  echo base_url("user-edit/". $user['id']); ?>" class="btn btn-warning">Edit</a>
        <a href="<?php  echo base_url("user-delete/". $user['id']); ?>" class="btn btn-danger">Delete</a> 
        
        </div>

        <form action="<?php echo base_url() ?>user-delete-form" method='post' class="d-inline">  
        <input type="hidden"  name="id" value="<?php echo $user['id'] ?? ''; ?>">
        <?= csrf_field() ?>
        <button class="btn btn-danger" type="submit">Delete</button> 
        </form>
        

        

        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

   <!-- Pagination -->
   <?php echo $pager->links();?>
   <?php //echo $pager->simpleLinks() ?>
   <?php //echo $pager->links('users', 'bootstrap_pagination'); ?>
    
    

      


</div>



</div> 

<?php
$this->endSection() 
?>

