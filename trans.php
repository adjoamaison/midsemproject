<?php
	include("adb.php");
	class trans extends adb{

		function addTrans($date, $time, $pnum){
			$str_query = "insert into transaction set date='$date',
			 time='$time', pnumber='$pnum'";
			return $this->query($str_query);
		}

		function deleteTrans($pid){
			$str_query = "delete from transaction where pid='$pid'";
			return $this->query($str_query);
		}

		function setPnum($pid, $pnum){
			$str_query = "update transaction set pnumber='$pnum' where transid='$pid' ";
			return $this->query($str_query);
		}

		function setTotal($pid, $tot){
			 $str_query = "update transaction set total='$tot' where transid='$pid' ";
			 // echo $str_query;
			return $this->query($str_query);
		}

		// function decrementQty($pid, $q){
		// 	$str_query = "update mwproduct set qty=qty-'$q' where pid='$pid'";
		// 	return $this->query($str_query);
		// }

		function checkTotal($sid, $tot){
			$str_query = "select pnumber from transaction where transid='$sid' and total>='$tot' ";
			return $this->query($str_query);			
		}

		function displayTransaction($pid){
			$str_query = "select * from transaction where pid='$pid' ";
			return $this->query($str_query);			
		}

		function transDay($d){
			$str_query = "select * from transaction where date='$d' ";
			return $this->query($str_query);			
		}

		function displayAll(){
			$str_query = "select * from transaction";
			return $this->query($str_query);
		}

	}
?>