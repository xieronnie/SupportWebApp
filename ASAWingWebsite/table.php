<?php
session_start();
?>
<!DOCTYPE html>

<head>

	<!--vv Security Check vv-->
	<?php
	$username = check_input($_POST['username']);
	$password = check_input($_POST['password']);

	if ($username == 'asawing' and $password == 'asawing') {
		echo 'Welcome to the secret website, you are in!';
	} else {
		echo 'Wrong username or password. Go back and try again.';
        
	}
	?>
	<!--^^ Security Check ^^-->

	<meta charset="UTF-8"/>
	<title>Open Support Tickets</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {

			$('#table_id').DataTable({
				"bPaginate" : false
			});

			$("[data-toggle=tooltip]").tooltip();

		});

	</script>

</head>

<body>

	<!-- Table
	<table id="table_id1" class="display">
	<thead>
	<tr>
	<th>dsadsa</th>
	<th>Column 2</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td>Row 1 Data 1</td>
	<td>Row 1 Data 2</td>
	</tr>
	<tr>
	<td>Row 2 Data 1</td>
	<td>Row 2 Data 2</td>
	</tr>
	</tbody>
	</table>
	-->

	<h2 class='sub-header'>Open Tickets</h2>
	<div class='table-responsive'>
		<table id=table_id class="display compact" >
			<thead>
				<tr>
					<th>ID</th>
					<th>Date</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Organization</th>
					<th>Support Type</th>
					<th>PBX</th>
					<th>UC Topic</th>
					<th>CC Topic</th>
					<th>Description</th>
					<th>Button</th>

				</tr>
			</thead>
			<tbody>

				<?php
				
				$accounts = mysql_connect("localhost", "root", "password") or die(mysql_error());

				mysql_select_db('support services', $accounts);

				$query = mysql_query("select * from support where complete=0");

				WHILE ($rows = mysql_fetch_array($query)) :

					$id = $rows['ID'];
					$thedate = $rows['Date'];
					$first = $rows['First'];
					$last = $rows['Last'];
					$email = $rows['Email'];
					$phone = $rows['Phone'];
					$organization = $rows['Organization'];
					$servicing = $rows['ServiceCategory'];
					$pbx = $rows['PBX'];
					$ucTopic = $rows['UC'];
					$ccTopic = $rows['CC'];
					$description = $rows['Description'];
					$subDescription = substr($description, 0, 8);
					if ($subDescription != '') {
						$subDescription = substr($description, 0, 29) . "....";
					}
					
					$_SESSION["ID"] = "$id";
	
					echo "

<tr>
<td>$id</td>
<td>$thedate</td>
<td>$first</td>
<td >$last</td>
<td>$email</td>
<td >$phone</td>
<td >$organization</td>
<td >$servicing</td>
<td >$pbx</td>
<td >$ucTopic</td>
<td >$ccTopic</td>
<td >
<a data-original-title='$description' data-toggle='tooltip' data-placement='left' title=''>$subDescription</a>
</td>
<td >


<!-- ##ANSWER FORM BELOW #### -->
<button class='btn btn-small btn-success' data-toggle='modal' data-target='#$id' onclick=getID()>
  Answer  
</button>

<!-- Modal -->
<div class='modal fade' id='$id' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
        <h4 class='modal-title' id='myModalLabel'>Submission Form</h4>
         
      </div>
      <div class='modal-body'>
        
		<div margin-left:auto; margin-right:auto '>
        <table  class='table table-condensed table-bordered' >
        
        <tr> 
        <td><b> ID:</b> $id </td>
        <td><b> Submitted:</b> $thedate</td>
		<td><b> Name:</b> $first $last </td>
		</tr>
		
		<tr> 
        <td><b> Organization:</b> $organization </td>
        <td><b> Email:</b> $email  </td>
		<td><b> Service Type:</b> $servicing </td>
		</tr>  
		
		<tr> 
		<td><b> Topic:</b> $ccTopic $ucTopic </td>
		</tr>
		  		
       </table>
       </div>				
		
		<div class='panel panel-default'>

    <div class='panel-heading'>

        <h3 class='panel-title'>Question</h3>

    </div>

    <div class='panel-body'>$description</div>

 </div>

       
       
        <form role='form' id='answerform' method='post' action='answerlog.php'>
  <div >
  
  
  	
	<label for='name'>Full Name</label>
    <input  class='form-control' id='name' placeholder='Enter your name'>
    
   <label for='exampleInputEmail1'>Email address</label>
    <input type='email' class='form-control' id='exampleInputEmail1' placeholder='Enter your email'>
   
    <label for='textarea'>Response:</label>	
	<textarea id='textarea' class='form-control' rows='10'> </textarea>
  

  </div>
  

	  </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
          <button type='submit' class='btn btn-success'>Submit</button>
</form>
      </div>
    </div>
  </div>
</div>

<!-- ##ANSWER FORM ABOVE ### -->

</td>
</tr>

";

				endwhile;
				?>
				
			</tbody>
		</table>

		<!-- DataTables CSS -->
		<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.css">

		<!-- jQuery -->
		<script type="text/javascript" charset="utf8" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

		<!-- DataTables -->
		<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>

		<script src="js/bootstrap.js"></script>

</body>

</html>

<script>
	function getID(this){
	"var sessID = this.getAttribute('data-target');
	  return sessID;"
}
</script>

<?php
function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
