<?php
if(!isset($_SESSION)){
session_start();
}
if (isset($_SESSION['username'])){
	if ($_SESSION['username']==''){
		header("Location: login.php");
}
}else{
	header("Location: login.php");
} 
?>