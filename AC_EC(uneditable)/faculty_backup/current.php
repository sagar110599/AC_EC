<?php 
include('../config.php');
include_once('verify.php');
include('../includes/header.php');
?>

<?php include('sidebar.php'); ?>

<?php include('../includes/topbar.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="row align-items-center">
        <div class="col">
          <h4 class="font-weight-bold text-primary mb-0">Student Records</h4>
          <div class="col text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter1">
              <i class="fas fa-filter"></i>
            </button>
          </div>
          <br>
        </div>
      </div>
      <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form class="forms-sample" method="POST" action="">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="disp1()" name="cname_cbox">
                  <label class="form-check-label" for="exampleFormControlSelect1">Course Name</label>
                  <select class="form-control" style="display: none" id="exampleFormControlSelect1" name="cname">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck2" onclick="disp2()" name="cid_box">
                  <label class="form-check-label" for="exampleFormControlSelect2">Course ID</label>
                  <select class="form-control" style="display: none" id="exampleFormControlSelect2" name="cid">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck3" onclick="disp3()" name="sem_cbox">
                  <label class="form-check-label" for="exampleFormControlSelect3">Semester</label>
                  <select class="form-control" style="display: none" id="exampleFormControlSelect3" name="sem">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck4" onclick="disp4()" name="dos_cbox">
                  <label class="form-check-label" for="exampleFormControlSelect4">Department of Study</label>
                  <select class="form-control" style="display: none" id="exampleFormControlSelect4" name="dept">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <!-- <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck5" onclick="disp5()">
                  <label class="form-check-label" for="exampleFormControlSelect5">Department</label>
                  <select class="form-control" style="display: none" id="exampleFormControlSelect5" name="cname">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div> -->

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" name="close">Close</button>
                  <button type="submit" class="btn btn-outline-primary" name="filter">Filter</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>Year</th>
                  <th>Email Address</th>
                  <th>Semester</th>
                  <th>Department</th>
                  <th>Course Name</th>
                  <th>Attendance</th>
                  <th>Marks</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>Year</th>
                  <th>Email Address</th>
                  <th>Semester</th>
                  <th>Department</th>
                  <th>Course Name</th>
                  <th>Attendance</th>
                  <th>Marks</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
                  <td>Tiger </td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>2011/04/25</td>
                  <td>2011/04/25</td>
                  <td>2011/04/25</td>
                  <td>61</td>
                  <td>61</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
  <?php include('../includes/footer.php');
  include('../includes/scripts.php');
  ?>