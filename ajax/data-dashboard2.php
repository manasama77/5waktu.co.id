<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "secret";
$dbname = "h50505_lwldb";

$con = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
    0 => 'do_num', 
    1 => 'nama_gudang',
    2 => 'do_print_date',
    3 => 'exit_date'
);

// getting total number records without any search
$sql = "SELECT id_pengiriman, do_num, nama_gudang, do_print_date, exit_date ";
$sql.=" FROM tbl_pengiriman";
$query=mysqli_query($con, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT id_pengiriman, do_num, nama_gudang, do_print_date, exit_date ";
    $sql.=" FROM tbl_pengiriman";
    $sql.=" WHERE do_num LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR nama_gudang LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR do_print_date LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR exit_date LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($con, $sql) or die("ajax-grid-data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($con, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
    
} else {    

    $sql = "SELECT id_pengiriman, do_num, nama_gudang, do_print_date, exit_date ";
    $sql.=" FROM tbl_pengiriman";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($con, $sql) or die("ajax-grid-data.php: get PO");
    
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    $nestedData=array(); 

    $nestedData[] = $row["id_pengiriman"];
    $nestedData[] = $row["do_num"];
    $nestedData[] = $row["nama_gudang"];
    $nestedData[] = $row["do_print_date"];
    $nestedData[] = $row["exit_date"];
    
    $data[] = $nestedData;
    
}



$json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalData ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );

echo json_encode($json_data);  // send data as json format

?>