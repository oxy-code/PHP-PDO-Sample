<?php
	class Database {
		protected $db_name = null;
		protected $db_host = null;
		protected $db_user = null;
		protected $db_pass = null;
		protected $db_conn = null;
		// DB Conncection Initialized
		function __construct($config){
			$this->db_conn = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
		}
		/*
		 * Function query()
		 * Used to execute the query string
		 * and return the results in
		 * mentioned format (json,object,array)
		 * by default it will return as array format.
		 * @param query_string, format
		 * @return data
		 * @author Code-Croppers 
		 */
		function query($query_string = null, $format = 'array') {
			$data = array();
			$resultset = mysqli_query($this->db_conn, $query_string);
			if ($resultset->num_rows) {
				$i = 0;
				while ($result = mysqli_fetch_assoc($resultset)) {
					foreach ($result as $key => $value) {
						$data[$i][$key] = $value;
					}
					$i++;
				}
			}
			switch ($format) {
				case 'json':
					$data = json_encode($data);
				break;
				case 'object':
					$data = (object) $data;
				break;
			}
			return $data;
		}
		/*
		 * Function find()
		 * Used to retrieve records by using the conditions and return the results in mentioned format (json,object,array)
		 * by default it will return as array format.
		 * @param conditions, model, format
		 * @return datasss
		 * @author Code-Croppers 
		 */
		function find($query = null , $format = 'array') {
			$query = $this->_buildQuery($query);
			return $this->query($query, $format);
		}
		
		/**
		 * Function _buildQuery()
		 * Used to build the queries
		 * @param query
		 * @return resultant_query
		 **/
		function _buildQuery() {
			$i = 1;
			$query = "SELECT * FROM ".$requested['table_name']." WHERE ";
			foreach ($requested['conditions'] as $column_name => $cond_value) {
				switch (gettype($cond_value)) {
					case 'string':
						$cond_value = "'$cond_value'";
					break;
				}
				if (count($requested['conditions'])-1 >= $i) {
					$query .= "$column_name = $cond_value AND ";
				}
				else {
					$query .= "$column_name = $cond_value;";
				}
				$i++;
			}
		}
	}
?>
