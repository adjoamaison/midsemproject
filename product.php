<?php
	include_once("adb.php");
	class product extends adb{

		function addProduct($pid, $pname, $price, $qty){
			$str_query = "insert into mwproduct set pid='$pid', pname='$pname', price='$price', qty='$qty'";
			return $this->query($str_query);
		}

		function deleteProduct($pid){
			$str_query = "delete from mwproduct where pid='$pid'";
			return $this->query($str_query);
		}

		function editProduct($pid, $pname, $price, $qty){
			$str_query = "update mwproduct set pname='$pname', price='$price', qty='$qty' where pid='$pid' ";
			return $this->query($str_query);
		}

		function decrementQty($pid, $q){
			$str_query = "update mwproduct set qty=qty-'$q' where pid='$pid'";
			return $this->query($str_query);
		}

		function searchProduct($pname){
			$str_query = "select * from mwproduct where pname='$pname' ";
			return $this->query($str_query);			
		}

		function displayProduct($pid){
			$str_query = "select * from mwproduct where pid='$pid' ";
			return $this->query($str_query);			
		}

		function displayAll(){
			$str_query = "select * from mwproduct";
			return $this->query($str_query);
		}

	}
?>