<?php
	include_once("adb.php");
	class sales extends adb{

		function addSales($tid, $pname, $price, $qty){
			$str_query = "insert into purchases set transid='$tid',
			 pname='$pname', price='$price', qty='$qty'";
			return $this->query($str_query);
		}

		// function deleteTrans($pid){
		// 	$str_query = "delete from purchases where pid='$pid'";
		// 	return $this->query($str_query);
		// }

		function editQuantity($pid, $qty){
			$str_query = "update purchases set qty='$qty' where sid='$pid' ";
			return $this->query($str_query);
		}

		// function setTotal($pid, $tot){
		// 	 $str_query = "update purchases set total='&tot' where transid='$pid' ";
		// 	return $this->query($str_query);
		// }

		function computeTotal($pid){
			$str_query = "select price, qty from purchases where pid='$pid'";
			return $this->query($str_query);
		}

		// function searchProduct($pname){
		// 	$str_query = "select * from mwproduct where pname='$pname' ";
		// 	return $this->query($str_query);			
		// }

		function displaySale($pid){
			$str_query = "select * from purchases where transid='$pid' ";
			return $this->query($str_query);			
		}

		function displayAll(){
			$str_query = "select * from purchases";
			return $this->query($str_query);
		}

	}
?>