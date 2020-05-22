<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon ">
      <i class="far fa-user"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Institute Coordinator</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-chalkboard-teacher"></i>
      <span>Add User</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="addstudent.php">Student</a>
        <a class="collapse-item" href="addfaculty_internal.php">Internal faculty</a>
        <a class="collapse-item" href="addfaculty_external.php">External faculty</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- Nav Item - Utilities Collapse Menu -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages4" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Course Records</span>
    </a>
    <div id="collapsePages4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <!-- <a class="collapse-item" href="addcourse_ac.php">Audit Course</a> -->
        <a class="collapse-item" href="audit_course.php">Audit Course</a>
        <a class="collapse-item" href="addcourse_idc.php">Interdisciplinary Course</a>
        <a class="collapse-item" href="addcourse_cec.php">Close Elective Course</a>
        <a class="collapse-item" href="addcourse_oec.php">Open Elective Course</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="studentallocation.php">
      <i class="fas fa-user-graduate"></i>
      <span>Student Allocation</span></a>
  </li>

  <hr class="sidebar-divider">
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Prepare Form</span>
    </a>
    <div id="collapsePages1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="prepare_form_ac.php">Audit Course</a>
        <a class="collapse-item" href="prepare_form_idc.php">Interdisciplinary Course</a>
        <a class="collapse-item" href="prepare_form_cec.php">Close Elective Course</a>
        <a class="collapse-item" href="prepare_form_oec.php">Open Elective Course</a>

      </div>
    </div>
  </li>

  <hr class="sidebar-divider">
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="upload.php">
      <i class="fa fa-upload" aria-hidden="true"></i>
      <span>Upload Responses</span></a>
  </li>

  <hr class="sidebar-divider">
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fa fa-eye" aria-hidden="true"></i>
      <span>View Responses</span>
    </a>
    <div id="collapsePages2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="audit_view.php">Audit Course</a>
        <a class="collapse-item" href="idc_view.php">Interdisciplinary Course</a>
        <a class="collapse-item" href="cec_view.php">Close Elective Course</a>
        <a class="collapse-item" href="oce_view.php">Open Elective Course</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>


</ul>
<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">