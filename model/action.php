<?php
	include_once('../config/config.php');
	include_once ('../core/calc.inc.php');

	if (empty($_POST["numInserted"])) {
       	//$error = "Input field is required";
    }else {
        $num1 = $_POST['numInserted'];
		$Cal = new Calc();
		$res = $Cal->calcMethod($num1);
    }

	$dbObj = new Database();


	// Insert Record	
	if (isset($_POST['action']) && $_POST['action'] == "insert") {
		$ress = $dbObj->insertRecond(json_encode($num1), $res);
		if ($ress) {
			echo $res;
		}else{
			return false;
		}
		
	}

	// View record
	if (isset($_POST['action']) && $_POST['action'] == "view") {
		$output = "";
		$row = $dbObj->displayRecord();
		if ($dbObj->totalRowCount() > 0) {
			$output .="<table class='table table-striped table-hover' id='tbrec'>
			<thead>
				<tr>
					<th>Sr</th>
					<th>Input Value</th>
					<th>Result</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>";
			$sr=1;
			foreach ($row as $rows) {
				$output.="<tr>
				<td>".$sr."</td>
				<td>".$rows['input_rec']."</td>
				<td>".$rows['result']."</td>
				<td><a href='' style='color:red' class='deleteBtn' id='".$rows['id']."'>Delete</a></td>
				</tr>";
			$sr++;
			}
			$output .= "</tbody>
			</table>";
			echo $output;	
		}else{
			echo '<h3 class="text-center mt-5">No records found</h3>';
		}
	}
	// Delete Record	
	if (isset($_POST['deleteId'])) {
	$delId = $_POST['deleteId'];
	$row = $dbObj->delRecordById($delId);
	echo json_encode($row);
	}

?>