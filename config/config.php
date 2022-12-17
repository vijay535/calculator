<?php
	
	class Database 
	{
		public $server = 'localhost';
		public $user = 'root';
		public $pass = '';
		public $db_name = 'calculator';
		public $con;
		public $table ='calc_info';
		public function __construct()
		{
			try {
				$this->con = new mysqli($this->server, $this->user, $this->pass, $this->db_name);	
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}
		// Insert data into table
		public function insertRecond($numInserted, $result)
		{
			$sql = "INSERT INTO $this->table (input_rec, result) VALUES('$numInserted','$result')";
			$query = $this->con->query($sql);
			if ($query) {
				return true;
			}else{
				return false;
			}
		}
		// Fetch records for show listing
		public function displayRecord()
		{
			$sql = "SELECT * FROM $this->table ORDER BY id DESC Limit 5 ";
			$query = $this->con->query($sql);
			$data = array();
			if ($query->num_rows > 0) {
				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			}else{
				return false;
			}
		}
		// Delete records from table
		public function delRecordById($id)
		{
			$query = "DELETE FROM $this->table WHERE id = '$id'";
			$result = $this->con->query($query);
			if ($result > 0) {
				return true;
			}else{
				return false;
			}
		}
		public function totalRowCount(){
			$sql = "SELECT * FROM $this->table";
			$query = $this->con->query($sql);
			$rowCount = $query->num_rows;
			return $rowCount;
		}
	}
?>