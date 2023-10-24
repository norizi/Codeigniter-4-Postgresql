 


<!DOCTYPE html>
<html lang="en">
<head>
  <title>CI 4 PostgreSQL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  
<style>
  footer {
            background-color: rgba(221, 72, 20, .8);
            text-align: center;
        }
        footer .environment {
            color: rgba(255, 255, 255, 1);
            padding: 2rem 1.75rem;
        }
        footer .copyrights {
            background-color: rgba(62, 62, 62, 1);
            color: rgba(200, 200, 200, 1);
            padding: .25rem 1.75rem;
        }
</style>

<?php
$this->renderSection('css')
?>

</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CI4</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <?php
        if (!session()->get('isLoggedIn'))
        {
        ?>
         <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url() ?>login">Login</a>
        </li>
        <?php
        }else{
        ?>
        
        
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url() ?>user-index">User</a>
        </li>
        <li class="nav-item">
        <a class="nav-link " href="<?php echo base_url() ?>user-datatable">Datatable</a>
        </li>

        <li class="nav-item">
        <a class="nav-link " href="<?php echo base_url() ?>staff">Staff</a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>mylibrary">MyLibrary</a>
        </li>

        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Sample</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo base_url() ?>mpdf">Mpdf</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url() ?>spreadsheet">Spreadsheet</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url() ?>faker">Faker</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url() ?>cache_staff">Cache User</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>delete_cache">Delete Cache User</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>uuid">Uuid</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>timedate">Time & Date</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>batch_processing">Batch Processing</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>nobatch_processing">Not Batch Processing</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>show_processlist">Show Query Processing</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>traits">Traits</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>segment">Segment</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>sendemail">Send Email</a></li>
            <!--
            <li><a class="dropdown-item" href="<?php echo base_url() ?>myservice">My Service</a></li>
            -->
          </ul>
        </li>


        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Reporting</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo base_url() ?>bar">Bar</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url() ?>line">Stacked</a></li> 
            <li><a class="dropdown-item" href="<?php echo base_url() ?>pie">Pie</a></li> 
          </ul>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>profile"><?php echo "Welcome : ".session('name'); ?></a>
        </li>

         
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url() ?>logout">Logout</a>
        </li>


        <?php
        } 
        ?>
        
      </ul>
    </div>
  </div>
</nav>
<?php
$this->renderSection('content')
?>

<footer class="mt-5">
    <div class="environment">

        <p>Page rendered in {elapsed_time} seconds</p>

        <p>Environment: <?= ENVIRONMENT ?></p>

    </div>

    <div class="copyrights">

        <p>&copy; <?= date('Y') ?> CodeIgniter 4 With PostgreSQL.</p>

    </div>

</footer>


</body>
</html>
<script>
  new DataTable('#example');
</script>

<?php
$this->renderSection('js')
?>

