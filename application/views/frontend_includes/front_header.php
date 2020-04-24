<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo SITE_TITLE;?></title>
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet"> 
        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url().FRONT_CSS;?>bootstrap.min.css"/>
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="<?php echo base_url().FRONT_CSS;?>font-awesome.min.css">
        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url().FRONT_CSS;?>style.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url().FRONT_CSS_CUSTOM;?>"/>
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>

        <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
        <script src="<?php echo base_url().FRONT_JS;?>jquery.min.js"></script>
        <script src="<?php echo base_url().FRONT_JS;?>bootstrap.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    </head>
    <body>
     <?php if(!empty($_SESSION[USER_SESS_KEY])){?>   
     <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Test</a>
        </div>
        <?php if($_SESSION[USER_SESS_KEY]['user_type'] != 1){?>
          <ul class="nav navbar-nav">
            <li class="<?php if($title == 'Add'){echo "active";}?>"><a href="<?php echo base_url().'reffers/add_refferer';?>">Add Reference</a></li>
          </ul>

          <ul class="nav navbar-nav">
            <li class="<?php if($title == 'Add'){echo "active";}?>"><a href="<?php echo base_url().'reffers/refferes';?>">Your References</a></li>
          </ul><?php 
        }?>
        <?php if($_SESSION[USER_SESS_KEY]['user_type'] == 1){?>
          <ul class="nav navbar-nav">
              <li class="<?php if($title == 'Users'){echo "active";}?>"><a href="<?php echo base_url();?>">Users</a></li>
          </ul>
        <?php }?>
        <ul class="nav navbar-nav">
            <li class=""><a href="<?php echo base_url().'users/logout';?>">Logout</a></li>
        </ul>
      </div>
    </nav>
    <?php }?>