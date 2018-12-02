<?php
/**
 *  This is a common helper page, auto loaded from composer.json.
 *  This will contain several helper functions
 */

/**
 * this will print an array
 *
 * @author Anirban Saha
 * @param  array $array array that need to be print
 *
 * @return void        print array
 */
function a($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	die;
}
/**
 * this will return a label from a code like string
 * eg : user_name => User Name
 *
 * @author Anirban Saha
 *
 * @return string
 */
function labelCase($string){
	return $string = ucfirst(str_ireplace(['_','-', 'id'],' ',$string));
}
/**
 * to prevent sqlinjection and script scriptinjection
 *
 * @author Anirban Saha
 * @param  string $data need to be cleand
 *
 * @return string       sanitized data
 */
function cleanData($data)
{
	return addslashes(e($data));
}
/**
 * Url from where data should fetch
 *
 * @author Anirban Saha
 * @param  string $url feed url
 *
 *  @return ArrayObject array from xml
 */

function getObjectFromJSON($url, $param = [])
{
	$json	=	callCURL($url, $param);
	$obj 	= 	json_decode($json);
	return $obj;
}
/**
 * call cUrl
 *
 * @author Anirban Saha
 * @param  string $url calling url
 *
 * @return mixed      xml/json string
 */
function callCURL($url, $params = [])
{
	$curl = curl_init($url);

	curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);

	if(count($params)) {
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
	}
	$data = curl_exec($curl);
	curl_close($curl);
	if ($data === false) {
		die('Can\'t get data');
	}
	return $data;
}

/**
 *  this will return small loader. you need to show and hide by id
 *
 *  @author Anirban Saha
 * 	@param  string 	$display block|none. It is value of display style. default is none
 * 	@param  string 	$id      id of current loader. By default small_loader
 *
 *   @return  string  html element of loader
 */
function smallLoader($display = null, $id = 'small_loader')
{
	$class = $display ? "show" : "";
	return '<div id="'.$id.'" class="loder_cover '.$class.'"><img src="'.asset('frontend/images/loader.gif').'" ></div>';
}


/**
 *  this will return a nice html for status coloum in table view
 *
 * 	@author Anirban Saha
 *
 *  @param  string  $value  status value
 *  @return	string	html
 */
function setStatus($value)
{
		$status_type = ['1'=>'Active','0'=>'Inactive'];
		$status	= isset($status_type[$value]) ? $status_type[$value] : $value;
		$type = ['active'=> 'bg-green', 'inactive' => 'bg-red','1'=>'bg-green','0'=>'bg-red'];
		$value = isset($type[$value]) ? $type[$value] : 'bg-grey';
		return '<span class="badge '.$value.'"> '.$status.' </span>';
}

/**
 *  this will return a nice html for image coloum in table view
 *
 * 	@author Anirban Saha
 *
 *  @param  string  $value  status value
 *  @return	string	html
 */
function setImage($value)
{
	$file_path = File::exists(getcwd().'/storage/'.$value) && !empty($value) ? asset('storage/'.$value) : 'http://via.placeholder.com/750x550';
	return '<a href="'.$file_path.'" data-lightbox="image-1"><img width="150" class="small-image" src="'.$file_path.'" alt="image-thumb"/></a>';
}
/**
 * it will return validation exception for form
 *
 * @param string $field_name error field name
 * @param string $error_message error message
 *
 * @return \Illuminate\Validation\ValidationException
 */
function throwValidationError($field_name, $error_message)
{
	$error = \Illuminate\Validation\ValidationException::withMessages([
	  $field_name => [$error_message]
	]);
	throw $error;
}
/**
 * move array element to desirable position
 * @param  array $array main array
 * @param  int $from     from position
 * @param  int $to     to position
 */
function moveElement(&$array, $from, $to) {
    $p1 = array_splice($array, $from, 1);
    $p2 = array_splice($array, 0, $to);
    $array = array_merge($p2,$p1,$array);
}
