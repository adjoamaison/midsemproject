var transid, tdate, timeT, prodId;

function sendRequest(u){
	var obj=$.ajax({url:u,async:false});
	var result=$.parseJSON(obj.responseText);
	return result;	//return object
}

function viewDailyTransaction(){
	var d = date.value;
	var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/agatha-maison/MWC/response.php?cmd=11&date="+d;
	//var strUrl = "response.php?cmd=11&date="+d;
	var objResult=sendRequest(strUrl);
	if(objResult.result==1){
		var list = "";
		for(var i = 0; i < objResult.trans.length; i++){
			list += "<li class='ui-listview ui-listview-inset ui-corner-all ui-shadow' data-theme='b'>";
			list += "<p><b>Transaction ID: </b>"+objResult.trans[i].transid+"</p>";
			list += "<p><b>Time: </b>"+objResult.trans[i]['time']+"</p>";
			list += "<p><b>Customer's Contact: </b>"+objResult.trans[i].pnumber+"</p>";
			list += "<p><b>Total Transaction: GHC </b>"+objResult.trans[i].total+"</p></li>";						
		}
			$("#transactionList").html(list);
	}
}

function setDate(){
 	"use strict";
 	var d, tdate, timeT;
	d = new Date();
	tdate = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
	timeT = d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
	$("#date").html(tdate);
	$("#time").html(timeT +" GMT");
}

function addSale(){
	var s=transid;
	var n=$("#pname").html();
	var pr=$("#price").html();
	var q=$("#qty").val();
	//alert(q);
	var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/agatha-maison/MWC/response.php?cmd=7&sid="+s+
		"&pname="+n+"&price="+pr+"&qty="+q+"&pid="+prodId;
	// var strUrl = "response.php?cmd=7&sid="+s+"&pname="+n+"&price="+pr+"&qty="+q+"&pid="+prodId;
	var objResult=sendRequest(strUrl);
	if(objResult.result==1){
		alert("successfully saved.");
	}
	receipt();
	
}

function addTrans(){
	var s = transid;			
	var p=pnum.value;
	var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/agatha-maison/MWC/response.php?cmd=8&sid="+s+"&pnum="+p+"&date="+tdate+"&time="+timeT;
	// var strUrl = "response.php?cmd=8&sid="+s+"&pnum="+p+"&date="+tdate+"&time="+timeT;
	var objResult=sendRequest(strUrl);
	if(objResult.result==1){
		alert("successfully saved.");
	}
}

function genId(){
	var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/agatha-maison/MWC/response.php?cmd=6";
	// var strUrl = "response.php?cmd=6";
	var objResult=sendRequest(strUrl);
	if(objResult.result==1){
		transid = objResult.pass;
	}
		setDate();
}

		function scan(){
			
			cordova.plugins.barcodeScanner.scan(
	      		function (result) {
	      			prodId = result.text;	                
	                var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/agatha-maison/MWC/response.php?cmd=4&pid="+prodId;
	                var objResult=sendRequest(strUrl);
					if(objResult.result==1){
						// alert("successful.");
						$("#pname").val(objResult.product[0]['pname']);
						$("#price").val(objResult.product[0]['price']);						
					}
	      		}, 
	      		function (error) {
	          		alert("Scanning failed: " + error);
	      		}
   			);
		}

function receipt(){
	var id=transid;
	var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/agatha-maison/MWC/response.php?cmd=9&sid="+id;
	// var strUrl = "response.php?cmd=9&sid=0STPF";
	var objResult=sendRequest(strUrl);
	if(objResult.result==1){
		var list = "";
		// var popupWindow = "";
		var total=0;
		for(var i = 0; i < objResult.sale.length; i++){
			list += "<li class='ui-listview ui-listview-inset ui-corner-all ui-shadow' data-theme='b'>";
			list += "<h2>"+objResult.sale[i].pname+"</h2>";
			list += "<p>"+objResult.sale[i].price+"</p>";
			list += "<p>"+objResult.sale[i].qty+"</p>";
			list += "<div onclick='getProductId("+objResult.sale[i].sid+")' data-rel='popup' class='ui-shadow ui-btn-right ui-corner-all ui-btn-inline ui-icon-bars ui-btn-icon-notext ui-btn-b ui-mini'>icon only button</div>";
			//list += "<a href='#purchase' data-role='button' onclick='edit("+objResult.sale[i].pname+")' class='ui-shadow ui-btn-right ui-corner-all ui-btn-inline ui-icon-delete ui-btn-icon-notext ui-btn-b ui-mini'>icon only button</a>";
			// list += "<a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop' aria-haspopup='true' aria-owns='purchase' aria-expanded='false' class='ui-btn ui-btn-icon-notext ui-icon-gear ui-btn-a' title='Purchase album'></a>";
			total += (objResult.sale[i]['price'] * objResult.sale[i]['qty']);
		}
		$("#rec").html(list);
		//var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/agatha-maison/MWC/response.php?cmd=10&sid="+id+"&total="+total;
		var strUrl = "response.php?cmd=10&sid="+id+"&total="+total;
		var objResult=sendRequest(strUrl);
		if(objResult.result==1){
			$("#total").html("<b>TOTAL: </b>GHC "+total);
		}

// reduce qty



	}
	var dis="";
	dis += "<a href='#' class='ui-shadow ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-star' onclick='addTrans()'>Done</a>";
	$("#btn").html(dis);
}

function getProductId(id){
	var text="";
	// text += "<h4>Permanently Delete Sale?</h4>";
	text += "<a href='#' onclick='deleteSale("+id+")' data-role='button' data-rel='back' class='ui-shadow ui-btn ui-corner-all ui-icon-delete ui-btn-icon-left ui-btn-inline ui-mini'>Delete</a>";
	// text += "<a href='#' onclick='editSale("+id+")' data-role='button' data-rel='back' class='ui-shadow ui-btn ui-corner-all ui-btn-inline ui-icon-edit ui-btn-icon-left ui-mini'>Edit</a>";
	text += "<a href='#' data-role='button' data-rel='back' class='ui-shadow ui-btn ui-corner-all ui-btn-inline ui-mini'>Cancel</a>";
	$('#purchase').html(text);
	$('#purchase').popup("open", { theme: "b" } );
	//$('#purchase').show();

}

function deleteSale(id){
	// var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/agatha-maison/MWC/response.php?cmd=6";
	var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/agatha-maison/MWC/response.php?cmd=12&sid="+id;
	var objResult=sendRequest(strUrl);
	if(objResult.result==1){
		alert("deletion successful.");
		receipt();
	}
}

		 function scan(){
		// 	// var strUrl = "response.php?cmd=4&pid=1234";

	 //  //               var objResult=sendRequest(strUrl);

		// 	// 		if(objResult.result==1){
		// 	// 			alert(objResult.product[0]['pname']);
		// 	// 			$("#pname").val(objResult.product[0]['pname']);
		// 	// 			$("#price").val(objResult.product[0]['price']);
		// 	// 		}
			cordova.plugins.barcodeScanner.scan(
	      		function (result) {
	      			prodId = result.text;	                
	                var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/agatha-maison/MWC/response.php?cmd=4&pid="+prodId;
	                var objResult=sendRequest(strUrl);
					if(objResult.result==1){
						// alert("successful.");
						$("#pname").val(objResult.product[0]['pname']);
						$("#price").val(objResult.product[0]['price']);						
					}
	      		}, 
	      		function (error) {
	          		alert("Scanning failed: " + error);
	      		}
   			);
		}
