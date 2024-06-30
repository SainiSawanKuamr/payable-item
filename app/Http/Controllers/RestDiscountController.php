<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestDiscountController extends Controller
{
	
	public function printResult(Request $request)
	{

	$data = $request->json()->all();
	
	//sort prices in descending order
	rsort($data);

	//Initialize array for discounted and payable items
	 $discountedItems = [];
	 $payableItems = [];

	 //process the items in group of 4
	 $group = [];
	 foreach ($data as $price) {
	 	# code...
	 	$group[] = $price;
	 	if(count($group) == 4){

	 		//sort prices in descending order
	 		rsort($group);
	 		//First two items are payable
	 		$payableItems[] = $group[0];
	 		$payableItems[] = $group[1];

	 		//Next two items are free if they are less than first item
	 		if ($group[2] < $group[0]) {
	 			# code...
	 			$discountedItems[] = $group[2];
	 		}else {
	 			$payableItems[] = $group[2];
	 		}

	 		if ($group[3] < $group[0]) {
	 			# code...
	 			$discountedItems[] = $group[3];
	 		}else {
	 			$payableItems[] = $group[3];
	 		}

	 		//Reset the group for next set of 4 items
	 		$group = [];
        }else{
        	echo "Please check Method name Count did not match";
        	exit;
        }
	 }

	 //Add any remaining items to payable items(if the number of prices isn't a multiple of 4)
	 foreach ($group as $remaining) {
	 	# code...
	 	$payableItems[] = $remaining;
	 }
	 	# code...


	 return [
	 		'Discounted Items' => $discountedItems,
   		    'Payable Items' => $payableItems,
   		     ];
   
    }


    public function printOneDiscount(Request $request)
	{

	$data = $request->json()->all();
	
	//sort prices in descending order
	rsort($data);

	//Initialize array for discounted and payable items
	 $discountedItems = [];
	 $payableItems = [];

	 //process the items in group of 3
	 $group = [];
	 foreach ($data as $price) {
	 	# code...
	 	$group[] = $price;
	 	if(count($group) == 3){

	 		//sort prices in descending order
	 		rsort($group);
	 		//First two items are payable
	 		$payableItems[] = $group[0];
	 		$payableItems[] = $group[1];

	 		//Next one items are free if they are less than first item
	 		if ($group[1] < $group[0]) {
	 			# code...
	 			$discountedItems[] = $group[1];
	 		}else {
	 			$payableItems[] = $group[1];
	 		}

	 		if ($group[2] < $group[0]) {
	 			# code...
	 			$discountedItems[] = $group[2];
	 		}else {
	 			$payableItems[] = $group[2];
	 		}

	 		//Reset the group for next set of 4 items
	 		$group = [];
        }else{
        	echo "Please check Method name Count did not match";
        	exit;
        }
	 }

	 //Add any remaining items to payable items(if the number of prices isn't a multiple of 3)
	 foreach ($group as $remaining) {
	 	# code...
	 	$payableItems[] = $remaining;
	 }
	 	# code...


	 return [
	 		'Discounted Items' => $discountedItems,
   		    'Payable Items' => $payableItems,
   		     ];
   
    }
 
}
