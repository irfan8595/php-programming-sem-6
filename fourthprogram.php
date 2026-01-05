<?php
//class definition
class greeting{
//properties
public $str="hello world!";
//methods
function show_greeting(){
return $this->str;
}
}
//create object from the class
$message=new greeting;
var_dump($message);
?>