<?php
	
	define( 'ROOT', dirname(__FILE__));
	require  ROOT . "\Sorter.php";
		

	// Input data
	$unsorted = array(
	[
		'source' => 'mardrid',
		'destination' => 'barcelona',
		'mode_of_transport' => 'train',
		'transport_details' => [
			'seat_no'	=> '122',
			'train' => 'MD2',
			'platform' => '5'
		]
	],
	[
		'source' => 'gerona',
		'destination' =>  'stockholm',
		'mode_of_transport' => 'flight',
		'transport_details' => [
			'seat_no' => '12E',
			'gate' => '45A',
			'flight' => 'AI123'
		]
	],
	[
		'source' => 'barcelona',
		'destination' => 'gerona',
		'mode_of_transport' => 'bus',
		'transport_details' => [
			'seat_no' => '3',
			'bus'	=> 'BARCA11'
		]

	],	
	[
		'source' => 'stockholm',
		'destination' => 'newyork',
		'mode_of_transport' => 'flight',
		'transport_details' => [
			'seat_no' => '3A',
			'gate' => '12',
			'flight' => 'STO788'
		]
	],
	[
		'source' => 'dubai',
		'destination' => 'mumbai',
		'mode_of_transport' => 'flight',
		'transport_details' => [
			'seat_no' => '3A',
			'gate' => '12',
			'flight' => 'EK211'

		]
	],
	[
		'source' => 'newyork',
		'destination' => 'singapore',
		'mode_of_transport' => 'flight',
		'transport_details' => [
			'seat_no' => '45A',
			'gate' => '1',
			'flight' => 'PN123'
		]
	],
	[
		'source' => 'singapore',
		'destination' => 'qatar',
		'mode_of_transport' => 'flight',
		'transport_details' => [
			'seat_no' => '37A',
			'gate' => '6',
			'flight' => 'SP111'
		]
	],
	[
		'source' => 'qatar',
		'destination' => 'dubai',
		'mode_of_transport' => 'train',
		'transport_details' => [
			'seat_no' => '3A',
			'train' => 'QT123',
			'platform' => '5'
		]
	]
);

error_reporting(0);

// Create Instance & run the application
try {

	$obj = new Sorter();
	$obj->setData($unsorted);
	$obj->qsort();
	print_r($obj->getIternary());

} catch (Exception $e) {
	echo $e->getMessage();
}