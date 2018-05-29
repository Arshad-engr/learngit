<!DOCTYPE html>
<html lang="en">
  <head>
  <?php $this->load->view('includes_backend/head'); ?>
  </head>
  <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #map{
        height: 300px;
        width: 100%;
    }
</style>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
         <!-- sidebar menu -->
            <?php $this->load->view('includes_backend/side-bar'); ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php $this->load->view('includes_backend/footer-buttons'); ?>  
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php $this->load->view('includes_backend/top-navigation'); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><a type="button" class="btn btn-primary not-but" href="<?php echo base_url('ServiceAdmin/allrequests');?>"> All Service Requests</a>
               </h3>
              </div>
            </div>
           

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?= $heading?></h2>
                   
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li>
                        <a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                   
                  <div class="x_content">
                    <a type="button" class="btn btn-primary" href="<?php echo base_url('ServiceAdmin/allpendingrequests');?>"></i> View All Requests</a>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Seeker Name</th>
                          <th>DateTime</th>
                          <th>location</th>
                          <th>Status</th>
                          <th>Service</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                   <?php if(!empty($shownotification)): ?>
                            <?php foreach($shownotification as $row ): ?>
                                <?php

                                if($row['viewStatus'] == 'Pending')
                                {
                                    $color = 'style= "color: #ff0000"';

                                }
                                else
                                {
                                    $color = '';

                                }
                                ?>

                                <tr class="odd gradeX" >
                                    <td><a href="#" type="button" data-toggle="modal" data-target="#userDetailModal"
                                    onclick="getSeekerDetails(<?= $row['userId']?>)"><?= $row['userFirstname'] ?>
                                        </a></td>
                                    <td><?= $row['dateTime'] ?></td>
                                    <td><?php echo $row['location'];?></td>
                                    <td><i class="fa fa-ellipsis-h"></i> <?= $row['status'] ?></td>
                                    <td> <?= $row['title'] ?></td>
                                    <td>
                                        <?php  echo "<script>";
                                                echo 'function latLng(){var center ={lat: '.$row['lat'].', lng: '.$row['lng'].'}; return center;}';
                                                echo "</script>";
                                                ?>
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Actions
                                            <span class="caret"></span></button>
                                          <ul class="dropdown-menu">

                                            <li><a class="btn btn-danger" href="<?php echo base_url('ServiceAdmin/cancelpending/'.$row['requestId']);?>">Cancel</a></li>
                                            <li><button data-toggle="modal" data-target="#sentRequest" onclick="sentRequests('<?= $row['requestId']?>')" class="btn btn-success">Sent</button></li>
                                              <li><a href="<?php echo base_url('ServiceAdmin/requestdetail/'.$row['requestId'])?>" class="btn btn-success">Detail</a></li>
                                          </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="6"> No records found.</td>
                           
                        </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  </div>
                    <!-- -// design code start for, on the way  -->
                    <div class="x_panel">
                     <div class="x_title">
                    <h2>On the Way</h2>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                 <!-- // -->
                 <div class="x_content">
                   <a type="button" class="btn btn-primary" href="<?php echo base_url('ServiceAdmin/allOnTheWayRequests');?>"></i> View All Requests</a>
                   
                  <table class="table table-striped">
                      <thead>
                        <tr>
                                <th>Seeker Name</th>
                                <th>DateTime</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Provider</th>
                                <th>Service</th>
                                <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                  <?php if(!empty($ontheway)): ?>
                        <?php foreach($ontheway as $row ): ?>


                            <tr class="odd gradeX" >
                                <td><a href="#" type="button" data-toggle="modal" data-target="#userDetailModal" onclick="getSeekerDetails(<?= $row['userId']?>)"><?= $row['userFirstname'] ?>
                                    </a></td>
                                <td><?= $row['dateTime'] ?></td>
                                <td><?php echo $row['location'];?></td>
                                <td><i class="fa fa-ellipsis-h"></i> <?= $row['status'] ?></td>
                                <td><?php
                                    if($row['pid'] != null)
                                    {
                                        ?>
                                        <a href="#" type="button" data-toggle="modal" data-target="#userDetailModal"
                                        onclick="getProviderDetails(<?= $row['pid']?>)"><?= $row['providername'] ?>
                                        </a>
                                        <?php
                                    }


                                    ?>
                                    </td>
                                <td> <?= $row['title'] ?></td>
                                <td><?php  echo "<script>";
                                    echo 'function latLng(){var center ={lat: '.$row['lat'].', lng: '.$row['lng'].'}; return center;}';
                                    echo "</script>";


                                    ?>

                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Actions
                                          <span class="caret"></span></button>
                                          <ul class="dropdown-menu">

                                            <li><a class="btn btn-danger" href="<?php echo base_url('ServiceAdmin/cancelservice/'.$row['requestId']);?>">Cancel</a></li>
                                            <li><button data-toggle="modal" data-target="#sentRequest" onclick="sentRequests('<?= $row['requestId']?>')" class="btn btn-success">Sent</button></li>
                                              <li><a href="<?php echo base_url('ServiceAdmin/requestdetail/'.$row['requestId'])?>" class="btn btn-success">Detail</a></li>
                                          </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7"> No records found.</td>
                            
                        </tr>
                    <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  </div>
                  <!-- // design code start for, Arrived -->
                    <div class="x_panel">
                     <div class="x_title">
                    <h2>Arrived</h2>
                    
                  
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                 <!-- // -->
                 <div class="x_content">
                   <a type="button" class="btn btn-primary" href="<?php echo base_url('ServiceAdmin/allArrivedRequests');?>"></i> View All Requests</a>
                  <table class="table table-striped">
                      <thead>
                        <tr>
                                 <th>Seeker Name</th>
                                <th>DateTime</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Provider</th>
                                <th>Service</th>
                                <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(!empty($arrived)): ?>
                          <?php foreach($arrived as $row ): ?>


                              <tr class="odd gradeX" >
                                  <td><a href="#" type="button"
                                      data-toggle="modal" data-target="#userDetailModal"
                                      onclick="getSeekerDetails(<?= $row['userId']?>)"><?= $row['userFirstname'] ?>
                                      </a></td>
                                  <td><?= $row['dateTime'] ?></td>
                                  <td><?php echo $row['location'];?></td>
                                  <td><i class="fa fa-ellipsis-h"></i> <?= $row['status'] ?></td>
                                  <td><a href="#" type="button" data-toggle="modal" data-target="#userDetailModal"
                                              class="btn btn-success" onclick="getProviderDetails(<?= $row['pid']?>)"><?= $row['providername'] ?>
                                      </a></td>
                                  <td> <?= $row['title'] ?></td>
                                  <td><?php  echo "<script>";
                                      echo 'function latLng(){var center ={lat: '.$row['lat'].', lng: '.$row['lng'].'}; return center;}';
                                      echo "</script>"; ?>
                                      <div class="dropdown">
                                          <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Action
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                              <li><a class="btn btn-danger" href="<?php echo base_url('ServiceAdmin/cancelservice/'.$row['requestId']);?>">Cancel</a></li>
                                              <li><button data-toggle="modal" data-target="#sentRequest" onclick="sentRequests('<?= $row['requestId']?>')" class="btn btn-success">Sent</button></li>
                                                <li><a href="<?php echo base_url('ServiceAdmin/requestdetail/'.$row['requestId'])?>" class="btn btn-success">Detail</a></li>
                                            </ul>
                                      </div>
                                  </td>
                              </tr>
                          <?php endforeach; ?>
                      <?php else: ?>
                          <tr>
                              <td colspan="7"> No records found.</td>
                          </tr>
                      <?php endif; ?>
                      </tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- // design code start for, In Progress Requests -->
                    <div class="x_panel">
                     <div class="x_title">
                    <h2>In Progress Requests</h2>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                 <!-- // -->
                 <div class="x_content">
                   
                 <a type="button" class="btn btn-primary"  href="<?php echo base_url('ServiceAdmin/allinprogressrequests');?>"></i> View All Requests</a>

                  <table class="table table-striped">
                      <thead>
                        <tr>
                               <th>Seeker Name</th>
                                <th>DateTime</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Start Time</th>
                                <th>Provider</th>
                                <th>Service</th>
                                <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                     <?php if(!empty($inprogress)): ?>
                          <?php foreach($inprogress as $row ): ?>

                              <tr class="odd gradeX" >
                                  <td>
                                      <a href="#" type="button" data-toggle="modal" data-target="#userDetailModal"
                                      onclick="getSeekerDetails(<?= $row['userId']?>)"><?= $row['userFirstname'] ?>
                                      </a>
                                  </td>
                                  <td><?= $row['dateTime'] ?></td>
                                  <td><?php echo $row['location'] ?></td>
                                  <td><i class="fa fa-hourglass-half"></i> <?= $row['status'] ?></td>
                                  <td><?= $row['startTime'] ?></td>
                                  <td>
                                      <a href="#" type="button" data-toggle="modal" data-target="#userDetailModal"
                                      onclick="getProviderDetails(<?= $row['pid']?>)"><?= $row['providername'] ?>
                                      </a>
                                  </td>
                                  <td> <?= $row['title'] ?></td>
                                  <td>
                                      <?php  echo "<script>";
                                      echo 'function latLng(){var center ={lat: '.$row['lat'].', lng: '.$row['lng'].'}; return center;}';
                                      echo "</script>";


                                      ?>

                                      <div class="dropdown">
                                          <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Actions
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">

                                              <li><a class="btn btn-danger" href="<?php echo base_url('ServiceAdmin/cancelservice/'.$row['requestId']);?>">Cancel</a></li>
                                              <li><button data-toggle="modal" data-target="#sentRequest" onclick="sentRequests('<?= $row['requestId']?>')" class="btn btn-success">Sent</button></li>
                                                <li><a href="<?php echo base_url('ServiceAdmin/requestdetail/'.$row['requestId'])?>" class="btn btn-success">Detail</a></li>
                                            </ul>
                                      </div>
                                  </td>
                              </tr>
                          <?php endforeach; ?>
                      <?php else: ?>
                          <tr>
                              <td colspan="8"> No records found.</td>
                             
                          </tr>
                      <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- // design code start for, Completed Requests -->
                    <div class="x_panel">
                     <div class="x_title">
                    <h2>Completed Requests</h2>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                 <!-- // -->
                 <div class="x_content">
                  <a type="button" class="btn btn-primary"  href="<?php echo base_url('ServiceAdmin/allcompletedrequests');?>"></i> View All Requests</a>
                   
                  <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Seeker Name</th>
                          <th>DateTime</th>
                          <th>Status</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                          <th>Provider</th>
                          <th>Service</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                     <?php if(!empty($completed)): ?>
                          <?php foreach($completed as $row ): ?>

                              <tr class="odd gradeX" >
                                  <td><a href="#" type="button" data-toggle="modal" data-target="#userDetailModal"
                                  onclick="getSeekerDetails(<?= $row['userId']?>)"><?= $row['userFirstname'] ?>
                                      </a></td>
                                  <td><?= $row['dateTime'] ?></td>
                                  <td><i class="fa fa-calendar-check-o"></i> <?= $row['status'] ?></td>
                                  <td><?= $row['startTime'] ?></td>
                                  <td><?= $row['endTime'] ?></td>
                                  <td><a href="#" type="button" data-toggle="modal" data-target="#userDetailModal"
                                  onclick="getProviderDetails(<?= $row['pid']?>)"><?= $row['providername'] ?>
                                      </a></td>
                                  <td> <?= $row['title'] ?></td>
                                  <td>
                                      <?php  echo "<script>";
                                      echo 'function latLng(){var center ={lat: '.$row['lat'].', lng: '.$row['lng'].'}; return center;}';
                                      echo "</script>";


                                      ?>
                                      <div class="dropdown">
                                          <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Actions
                                          <span class="caret"></span></button>
                                          <ul class="dropdown-menu">

                                              <li><button data-toggle="modal" data-target="#sentRequest" onclick="sentRequests('<?= $row['requestId']?>')" class="btn btn-success">Sent</button></li>
                                              <li><button data-toggle="modal" data-target="#invoiceDetailModal" onclick="getRequestInvoiceByInvoiceId('<?= $row['requestId']?>')" class="btn btn-info">Invoice</button>
                                              </li>
                                              <li><a href="<?php echo base_url('ServiceAdmin/requestdetail/'.$row['requestId'])?>" class="btn btn-success">Detail</a></li>
                                          </ul>
                                      </div>
                                  </td>
                              </tr>
                          <?php endforeach; ?>
                      <?php else: ?>
                          <tr>
                              <td colspan="8"> No records found.</td>
                              
                          </tr>
                      <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!--// design cod start for , Cancelled Requests -->
                    <div class="x_panel">
                     <div class="x_title">
                    <h2>Cancelled Requests</h2>
                    
                 
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                 <!-- // -->
                 <div class="x_content">
                  <a type="button" class="btn btn-primary" href="<?php echo base_url('ServiceAdmin/allcancelledrequests');?>">View All Requests</a>
                  <table class="table table-striped">
                      <thead>
                        <tr>
                                <th>Seeker Name</th>
                                <th>DateTime</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Provider</th>
                                <th>Service</th>
                                <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                     <?php if(!empty($cancelled)): ?>
                            <?php foreach($cancelled as $row ): ?>

                                <tr class="odd gradeX" >
                                    <td><a href="#" type="button" data-toggle="modal" data-target="#userDetailModal"
                                    onclick="getSeekerDetails(<?= $row['userId']?>)"><?= $row['userFirstname'] ?>
                                        </a></td>
                                    <td><?= $row['dateTime'] ?></td>
                                    <td><?php echo $row['location'];?></td>
                                    <td><i class="fa fa-ellipsis-h"></i> <?= $row['status'] ?></td>
                                    <td><?php
                                        if($row['pid'] != null)
                                        {
                                            ?>
                                            <a href="#" type="button" data-toggle="modal" data-target="#userDetailModal" onclick="getProviderDetails(<?= $row['pid']?>)"><?= $row['providername'] ?>
                                            </a>
                                        <?php
                                        }


                                        ?></td>
                                    <td> <?= $row['title'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                            <ul class="dropdown-menu">

                                                <li><a data-toggle="modal" data-target="#sentRequest" onclick="sentRequests('<?= $row['requestId']?>')" class="btn btn-success">Sent</a></li>
                                                <li><a href="<?php echo base_url('ServiceAdmin/requestdetail/'.$row['requestId'])?>" class="btn btn-success">Detail</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9"> No records found.</td>
                            </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>



                  <!--// design cod start for , Cancelled Requests -->
                  <div class="x_panel">
                      <div class="x_title">
                          <h2>No Work</h2>
                          
                          <ul class="nav navbar-right panel_toolbox">
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>
                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                              </li>
                          </ul>
                          <div class="clearfix"></div>
                      </div>
                      <!-- // -->
                      <div class="x_content">
                          <a type="button" class="btn btn-primary" href="<?php echo base_url('ServiceAdmin/allnoworkrequests');?>">View All Requests</a>

                          <table class="table table-striped">
                              <thead>
                              <tr>
                                  <th>Seeker Name</th>
                                  <th>DateTime</th>
                                  <th>Location</th>
                                  <th>Status</th>
                                  <th>Provider</th>
                                  <th>Service</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php if(!empty($nowork)): ?>
                                  <?php foreach($nowork as $row ): ?>

                                      <tr class="odd gradeX" >
                                          <td><a href="#" type="button" data-toggle="modal" data-target="#userDetailModal"
                                                 onclick="getSeekerDetails(<?= $row['userId']?>)"><?= $row['userFirstname'] ?>
                                              </a></td>
                                          <td><?= $row['dateTime'] ?></td>
                                          <td><?php echo $row['location'];?></td>
                                          <td><i class="fa fa-ellipsis-h"></i> <?= $row['status'] ?></td>
                                          <td><?php
                                              if($row['pid'] != null)
                                              {
                                                  ?>
                                                  <a href="#" type="button" data-toggle="modal" data-target="#userDetailModal" onclick="getProviderDetails(<?= $row['pid']?>)"><?= $row['providername'] ?>
                                                  </a>
                                              <?php
                                              }


                                              ?></td>
                                          <td> <?= $row['title'] ?></td>
                                          <td>
                                              <div class="dropdown">
                                                  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                                  <ul class="dropdown-menu">

                                                      <li><a data-toggle="modal" data-target="#sentRequest" onclick="sentRequests('<?= $row['requestId']?>')" class="btn btn-success">Sent</a></li>
                                                      <li><a href="<?php echo base_url('ServiceAdmin/requestdetail/'.$row['requestId'])?>" class="btn btn-success">Detail</a></li>
                                                  </ul>
                                              </div>
                                          </td>
                                      </tr>
                                  <?php endforeach; ?>
                              <?php else: ?>
                                  <tr>
                                      <td colspan="9"> No records found.</td>
                                  </tr>
                              <?php endif; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>





                  <div class="x_panel">
                      <div class="x_title">
                          <h2>No Provider Requests</h2>
                          
                          <ul class="nav navbar-right panel_toolbox">
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>
                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                              </li>
                          </ul>
                          <div class="clearfix"></div>
                      </div>
                      <!-- // -->
                      <div class="x_content">
                        <a type="button" class="btn btn-primary" href="<?php echo base_url('ServiceAdmin/allnoproviderrequests');?>">View All Requests</a>
                          <table class="table table-striped">
                              <thead>
                              <tr>
                                  <th>Seeker Name</th>
                                  <th>DateTime</th>
                                  <th>Location</th>
                                  <th>Status</th>

                                  <th>Service</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php if(!empty($noprovider)): ?>
                                  <?php foreach($noprovider as $row ): ?>

                                      <tr class="odd gradeX" >
                                          <td><a href="#" type="button" data-toggle="modal" data-target="#userDetailModal"
                                                 onclick="getSeekerDetails(<?= $row['userId']?>)"><?= $row['userFirstname'] ?>
                                              </a></td>
                                          <td><?= $row['dateTime'] ?></td>
                                          <td><?php echo $row['location'];?></td>
                                          <td><i class="fa fa-ellipsis-h"></i> <?= $row['status'] ?></td>

                                          <td> <?= $row['title'] ?></td>
                                          <td>
                                              <div class="dropdown">
                                                  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                                  <ul class="dropdown-menu">

                                                      <li><a data-toggle="modal" data-target="#sentRequest" onclick="sentRequests('<?= $row['requestId']?>')" class="btn btn-success">Sent</a></li>
                                                      <li><a href="<?php echo base_url('ServiceAdmin/requestdetail/'.$row['requestId'])?>" class="btn btn-success">Detail</a></li>
                                                  </ul>
                                              </div>
                                          </td>
                                      </tr>
                                  <?php endforeach; ?>
                              <?php else: ?>
                                  <tr>
                                      <td colspan="9"> No records found.</td>
                                  </tr>
                              <?php endif; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>




              </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
       <?php $this->load->view('includes_backend/footer'); ?>
        <!-- /footer content -->
      </div>
    </div>
    <?php $this->load->view('includes_backend/footer-scripts'); ?> 
    <!-- addtional script -->

 <?php $this->load->view('includes_backend/additionalscript'); ?>
    <!-- / additional script -->

    <div class="modal fade" id="contact" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="back" >
            
                <h4>Seeker Location<h4>
            
            <div class="modal-body">
                <div id="map"></div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary" data-dismiss="modal"  role="button">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDc_jGfNYJfQSGLC7sa_K6VdVnxHgf6eZM&callback=initialize"></script>
<script>

    function initialize() {
        var center = latLng();

        var mapOptions = {
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: center
        };

        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var marker = new google.maps.Marker({
            map: map,
            position: center
        });
        marker;
    }

    $('.launch-map').on('click', function () {
        var center = latLng();

        $('#contact').modal({
            backdrop: 'static',
            keyboard: false
        }).on('shown.bs.modal', function () {
            google.maps.event.trigger(map, 'resize');
            map.setCenter(center);
        });
    });

    initialize();
</script>

  </body>
</html>


<!-- line modal -->
<div class="modal fade" id="invoiceDetailModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <div class="modal-body">
            <div id="requestInvoiceRecordDetail"></div>
          </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"  role="button">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- line modal -->
<div class="modal fade" id="sentRequest" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
           
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                
            
            <div class="modal-body">

                <div id="sentRequestProviders"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"  role="button">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- line modal -->
<div class="modal fade" id="userDetailModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
           
            <div class="modal-body" id="user">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
            </div>
        </div>
    </div>
</div>
