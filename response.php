<?php
// SESSION_START();
    // require './Smsgh/Api.php';
    
    if(!isset($_REQUEST['cmd'])){
        echo '{"result":0,message:"unknown command"}';
        exit();
    }

    $cmd=$_REQUEST['cmd'];
    switch($cmd)
    {
        case 1:
            add();  
        break;

        case 2:
            viewAll();
        break;
    
        case 3:
           update();
        break;

        case 4:
           getProduct();
        break;
    
        case 5:
            getStock();
        break;
        
        case 6:
            generate_random_password(5);
        break;
        case 7:
            addSale();
        break;
        case 8:
            addTransaction();
        break;
        case 9:
            displaySale();
        break;
        case 10:
            setTotal();
        break;
        case 11:
            allTransaction();
        break;
        default:
            echo '{"result":0,message:"unknown command"}';
        break;
    }

    
        function add(){
            $pid = $_REQUEST["pid"];
            $pname = $_REQUEST["pname"];
            $price = $_REQUEST["price"];
            $qty = $_REQUEST["qty"];

            include("product.php");
            $obj=new product();
            
            if($obj->addProduct($pid, $pname,$price,$qty)) {               
                echo '{"result":1}';        
            }
            else {
                echo "{'result':0}";        
            }
        }

        function update(){
            $pid = $_REQUEST["pid"];
            $pname = $_REQUEST["pname"];
            $price = $_REQUEST["price"];
            $qty = $_REQUEST["qty"];

            include("product.php");
            $obj=new product();
            
            if($obj->editProduct($pid, $pname,$price,$qty)) {             
                echo '{"result":1}';        
            }
            else {
                echo "{'result':0}";        
            }
        }

        function getProduct(){
            $pid = $_REQUEST["pid"];
            include("product.php");
            $obj=new product();
            
            if(!$obj->displayProduct($pid)) {               
                echo '{"result":0}';        
            }
            else {
                $row=$obj->fetch();
            echo '{"result":1,"product":[';
                echo json_encode($row);
            echo "]}";        
            }
        }

        function addSale(){
            $sid = $_REQUEST["sid"];
            $pname = $_REQUEST["pname"];
            $price = $_REQUEST["price"];
            $qty = $_REQUEST["qty"];

            include("sales.php");
            $obj=new sales();
            
            if($obj->addSales($sid, $pname,$price,$qty)) {               
                echo '{"result":1}';        
            }
            else {
                echo "{'result':0}";        
            }
        }

        function addTransaction(){
            // $s = $_REQUEST["sid"];
            $p = $_REQUEST["pnum"];
            $d = $_REQUEST["date"];
            $t = $_REQUEST["time"];            
            // $tt = $_REQUEST["tot"];

            include("trans.php");
            $obj=new trans();
            
            if($obj->addTrans($d,$t,$p)) {               
                echo '{"result":1}';        
            }
            else {
                echo "{'result':0}";        
            }
        }

        function displaySale(){
            $p = $_REQUEST["sid"];

            include("sales.php");
            $obj=new sales();
            
            if(!$obj->displaySale($p)) {               
                echo '{"result":0}';        
            }
            else {
                $row=$obj->fetch();
            echo '{"result":1,"sale":[';
            while($row){
                echo json_encode($row);         //convert the result array to json object
                $row=$obj->fetch();
                if($row){
                    echo ",";                   //if there are more rows, add comma 
                }
            }
            echo "]}";        
            }
        }

        function setTotal(){
            $p = $_REQUEST["sid"];
            $t = $_REQUEST["total"];

            include("trans.php");
            $obj=new trans();

            if(!$obj->setTotal($p, $t)) {               
                echo '{"result":0}';        
            }
            // $obj->setTotal($p, $t);
            $discount = random_password(8);
            if(!$obj->checkTotal($p, $t)){               
                //return error
                echo '{"result":0,"message": "did not work."}';
                return;
            }
            $row=$obj->fetch();
            // echo '{"result":1,"products":[';    //start of json object
                // echo json_encode($row);
                // echo '{"result":1,"code": "'.$discount.'", "number":"'.$row['pnumber'].'"}';
                 // echo $disount;              //if there are more rows, add comma 
            // }
            $msg = "Your Discount Code is: ".$discount;
            $pnum = $row['pnumber'];
            // echo $msg ." " .$pnum;
                    // sms($msg, $pnum);
                       echo '{"result":1}'; 
            
            // echo "]}";
        }
        //  function addSms(){
        //     $pnum = $_REQUEST["pnum"];
        //     $message = $_REQUEST["message"];

        //     $mess = explode(" ", $message);
        //     include("reg.php");
        //     $obj=new reg();
        //     $msg = "Registration Successful";
        //     $obj->addStud($mess[0], $mess[1], $mess[2], $mess[3],$mess[4],"+".$mess[5]);
        //        sms($msg,$pnum);
        //     echo '{"result":1}';
        
        // }

        function generate_random_password($length = 10) {
            $alphabets = range('A','Z');
            $numbers = range('0','9');
            $additional_characters = array('_','.');
            $final_array = array_merge($alphabets,$numbers,$additional_characters);
                
            $password = '';
         
            while($length--) {
              $key = array_rand($final_array);
              $password .= $final_array[$key];
            }
                echo '{"result":1,"pass":"' .$password . '"}';
            // return $password;
        }

         function random_password($length = 10) {
            $alphabets = range('A','Z');
            $numbers = range('0','9');
            $additional_characters = array('_','.');
            $final_array = array_merge($alphabets,$numbers,$additional_characters);
                
            $password = '';
         
            while($length--) {
              $key = array_rand($final_array);
              $password .= $final_array[$key];
            }
                // echo '{"result":1,"pass":"' .$password . '"}';
             return $password;
        }

        function sms($msg, $num){
            //Here we assume the user is using the combination of his clientId and clientSecret as credentials
            $auth = new BasicAuth("jokyhrvs", "volkzmqn");

            // instance of ApiHost
            $apiHost = new ApiHost($auth);
            $enableConsoleLog = FALSE;
            $messagingApi = new MessagingApi($apiHost, $enableConsoleLog);
            try {
                $messageResponse = $messagingApi->sendQuickMessage("MyStore", $num, $msg);

                if ($messageResponse instanceof MessageResponse) {
                    //echo 
                    $messageResponse->getStatus();
                } elseif ($messageResponse instanceof HttpResponse) {
                    //echo "\nServer Response Status : " . 
                    $messageResponse->getStatus();
                }
            } catch (Exception $ex) {
                    //echo 
                $ex->getTraceAsString();
            }
        }

        function viewAll(){
            include("product.php");
            $obj = new product();
            
            if(!$obj->displayAll()){               
                //return error
                echo '{"result":0,"message": "search did not work."}';
                return;
            }
            //at this point the search has been successful. 
            //generate the JSON message to echo to the browser
            $row=$obj->fetch();
            echo '{"result":1,"products":[';    //start of json object
            while($row){
                echo json_encode($row);         //convert the result array to json object
                $row=$obj->fetch();
                if($row){
                    echo ",";                   //if there are more rows, add comma 
                }
            }
            echo "]}";
        }

        function allTransaction(){
            $d = $_REQUEST["date"];            
            include("trans.php");
            $obj = new trans();
            
            if(!$obj->transDay($d)) {               
                //return error
                echo '{"result":0,"message": "search did not work."}';
                return;
            }
            //at this point the search has been successful. 
            //generate the JSON message to echo to the browser
            $row=$obj->fetch();
            echo '{"result":1,"trans":[';    //start of json object
            while($row){
                echo json_encode($row);         //convert the result array to json object
                $row=$obj->fetch();
                if($row){
                    echo ",";                   //if there are more rows, add comma 
                }
            }
            echo "]}";
        }

        function getStock(){
            $message = $_REQUEST["message"];
            $mess = explode(" ", $message);
            $pnum = $_REQUEST["pnum"];

            include("product.php");
            $obj = new product();
            
            if($obj->displayProduct($mess[0])){
                $row = $obj->fetch();
                $msg = $row['pname']+"<br>" + $row['price']+"<br>"+$row['qty'];
                echo $msg;
                // sms($msg,$pnum);
            }
            else{
                echo '{"result":0}';
            }
        }

        function setDiscount(){
            include("trans.php");
            $obj = new trans();

            if(!$obj->checkTotal($sid, $tot)){         
                echo '{"result":0,"message": "did not work."}';
                return;
            }
            $row=$obj->fetch();
            echo '{"result":1,"products":[';    //start of json object
            // while($row){
                echo json_encode($row);         //convert the result array to json object
                // $row=$obj->fetch();
                // if($row){
                    // echo ",";                   //if there are more rows, add comma 
                // }
            // }
            echo "]}";
        }
   
        // function otl(){
        //   SESSION_START();
        //     $num = $_REQUEST["pnum"];
        //     sms($_SESSION["PASS"],$num);
        //     echo '{"result":1,"pass":"'.$_SESSION["PASS"].'"}';
        //     // header("location:localhost/mwc/sms/otpass.html");
        // }

        // function otp(){
        //     SESSION_START();
        //     $pswd = $_REQUEST["pwd"];
        //     //echo "url";
        //     // echo $pswd;
        //     // echo "<br>";
        //     // echo $_SESSION["PASS"];
        //     if($_SESSION["PASS"] == $pswd){
        //         echo '{"result":1}';
        //     }else{
        //         echo '{"result":0}';
        //     }

        // }

    
?>