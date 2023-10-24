<?php
$this->extend('layout/default') 
?>

<?php
$this->section('content')
?>
<div class="container-fluid mt-3">
<div class="container mt-3">
 

<table class="table table-bordered">
    <thead>
      <tr>
         
        <th>PID</th>
        <th>QUERY</th> 
        <th>DURATION</th> 
      </tr>
    </thead>
    <tbody>
    <?php foreach ($querys->getResult() as $data){ ?>
        
      <tr>
       
        <td><?php echo $data->pid; ?></td>
        <td><?php echo $data->query; ?></td>
        <td><?php echo $data->duration; ?></td> 
         
      </tr>
      <?php } ?>
    </tbody>
  </table>


</div>
</div> 

<?php
$this->endSection() 
?>

