<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>Page not found</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
		<style>
			/* Styles for Page not found */	
			body{
				font-family: 'Capriola', sans-serif;
			}
			body{
				background:#DAD6CC;
			}	
			.wrap{
				margin:0 auto;
				width:1000px;
			}
			.logo h1{
				font-size:200px;
				color:#FF7A00;
				text-align:center;
				margin-bottom:1px;
				text-shadow:4px 4px 1px white;
			}	
			.logo p{
				color:#B1A18D;;
				font-size:20px;
				margin-top:1px;
				text-align:center;
			}	
			.logo p span{
				color:lightgreen;
			}	
			.sub a{
				color:#ff7a00;
				text-decoration:none;
				padding:5px;
				font-size:13px;
				font-family: arial, serif;
				font-weight:bold;
			}			
			/* End */
		</style>
	</head>
	<body>
		<div class="wrap">
			<div class="logo">
				<h1>404</h1>
				<p> Oops! The page you requested was not found!</p>
				<div class="sub">
				   <p><a href="javascript:void(0);" onclick="history.go(-1);"> Back to Home</a></p>
				</div>
			</div>
		</div>
	</body>
    </html>