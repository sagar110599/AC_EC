<?php
include_once('../../verify.php');
include_once('../../../config.php');
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
if(isset($_POST['order'])){
   $columnIndex = $_POST['order'][0]['column']; // Column index
   $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
   $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
   $orderQuery=" order by $columnName $columnSortOrder ";
}else{
   // $columnName='sem';
   // $columnSortOrder='asc';
   $orderQuery=' order by faculty_code asc ';
}
$searchValue = $_POST['search']['value']; // Search value

## Search 
$searchQuery = "1";
if($searchValue != ''){
   $searchQuery = "(employee_id like '%".$searchValue."%' or 
        faculty_code like '%".$searchValue."%' or 
        email_id like '%".$searchValue."%' or dept_name like '%".$searchValue."%'
        or post like '%.".$searchValue.".%' or fname like '%".$searchValue."%' or mname like '%".$searchValue."%' or lname like '%".$searchValue."%' or post like '%".$searchValue."%') ";
}

## Total number of records without filtering
$sel = mysqli_query($conn,"select count(*) as totalcount from faculty");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['totalcount'];

## Total number of record with filtering
$sel = mysqli_query($conn,"select count(*) as totalcountfilters from faculty f INNER JOIN department d ON f.dept_id=d.dept_id WHERE ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['totalcountfilters'];

## Fetch records
// $sql = "select cname,cid,sem,dept_name,max,min,no_of_allocated from audit_course a INNER JOIN department d ON a.dept_id=d.dept_id WHERE currently_active=1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
// $sql="select cname,cid,sem,dept_name,max,min,no_of_allocated,
//      (SELECT GROUP_CONCAT(aad.dept_id SEPARATOR ',') FROM audit_course_applicable_dept aad 
//      WHERE a.cid=aad.cid AND a.sem=aad.sem AND a.year=aad.year GROUP BY 'all') as app 
//      from audit_course a INNER JOIN department d ON a.dept_id=d.dept_id WHERE currently_active=1 "
//      .$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
// $sql="select cname,cid,sem,dept_name,max,min,no_of_allocated, 
//       (SELECT GROUP_CONCAT(dept_name SEPARATOR ', ') FROM audit_course_applicable_dept aad 
//        INNER JOIN department ad ON aad.dept_id=ad.dept_id WHERE a.cid=aad.cid AND a.sem=aad.sem AND a.year=aad.year
//        GROUP BY 'all') as app 
//        from audit_course a INNER JOIN department d ON a.dept_id=d.dept_id WHERE currently_active=1 "
//        .$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$sql="select faculty_code,email_id,employee_id,dept_name,fname,mname,lname,post from faculty f INNER JOIN department d ON f.dept_id=d.dept_id WHERE "
       .$searchQuery. $orderQuery ." limit ".$row.",".$rowperpage;
$facultyRecords = mysqli_query($conn, $sql);
$data = array();
$count=0;
$fullname="";
while ($row = mysqli_fetch_assoc($facultyRecords)) {
  if($row['mname']!=''){
  $fullname=$row['fname']." ".$row['mname']." ".$row['lname'];}
  else{
    $fullname=$row['fname']." ".$row['lname'];
  }
   $data[] = array( 

      // "select-cbox"=>'<input type="checkbox">',
      "select-cbox"=>'<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input selectrow" id="selectrow'.$count.'">
                        <label class="custom-control-label" for="selectrow'.$count.'"></label>
                     </div>',
      "faculty_code"=>$row['faculty_code'],
      "employee_id"=>$row['employee_id'],
      "name"=>$fullname,
      "email_id"=>$row['email_id'],
      "dept_name"=>$row['dept_name'],
      "post"=>$row['post'],
      "action"=>'<!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary icon-btn action-btn" >
                    <i class="fas fa-tools"></i>
                  </button>',
   );
   $count++;
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);
// select cname,cid,sem,dept_name,max,min,no_of_allocated,(SELECT aad.dept_id as app FROM audit_course_applicable_dept aad WHERE a.cid=aad.cid AND a.sem=aad.sem AND a.year=aad.year) from audit_course a INNER JOIN department d ON a.dept_id=d.dept_id WHERE currently_active=1

?>
