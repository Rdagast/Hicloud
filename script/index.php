<?php 

$temp = null;
$battery = null; 
$time = null;
$vibration = null;
$humidity = null;

/* create random values to simulate sensor */
$temp = rand(-20,60); 
$battery = rand(0,100);
$vibration =  rand(10,50);
$humidity = rand(0,50);

/* include values in array */
$file = array(
	      'temperature'=> $temp,
	      'battery'=> $battery,
	      'vibration'=> $vibration,
	      'humidity'=> $humidity
	   );
// check if file exist 
if(file_exists('result.json')){
	 $myFile = "result.json";
   
	 $arr_data = array();

  try
  {	  // add new values into the primary file json
  	  $data = file_get_contents($myFile);
  	  $arr_data = json_decode($data, true);
  	  var_dump($arr_data);
	  array_push($arr_data, $file);
	  $data = json_encode($arr_data, JSON_PRETTY_PRINT);
	  file_put_contents($myFile, $data);


   }
   catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
   }

}else{
	/* if file does not exist add a new file in the folder */
	$arr_data = array();

	array_push($arr_data, $file);
	$jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
	$fp = fopen("result.json", 'w');
	fwrite($fp, json_encode($arr_data));
	fclose($fp);
	
}
