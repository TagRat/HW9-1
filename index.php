<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        //  make sure the user enters a name
	if (empty($name)) {
           $message = 'Name is missing!';
           break;
        }

        //  display the name with only the first letter capitalized
        $name = strtolower($name);
        $name = ucwords($name);

	
	$n = strpos($name, ' ');
        if ($n === false) {
            $first_name = $name;
        } else {
	      $first_name = substr($name, 0, $n);
        }

        // make sure the user enters a valid email

	if (empty($email)) {
	   $message = 'Email cannot be blank.';
           break;
        } else if(strpos($email, '@') === false) {
           $message = 'Email must include an @ sign.';
           break;
        } else if(strpos($email, '.') === false) {
           $message = 'The email must contain a period.';
           break;
        }

        // Check phone number
        $phone = str_replace('-', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace(' ', '', $phone);

        // validate the phone number
        if (strlen($phone) < 7) {
            $message = 'The phone number must contain at least seven digits.';
            break;
        }

        // format the phone number
        if (strlen($phone) == 7) {
            $part1 = substr($phone, 0, 3);
            $part2 = substr($phone, 3);
            $phone = $part1 . '-' . $part2;
        } else {
            $part1 = substr($phone, 0, 3);
            $part2 = substr($phone, 3, 3);
            $part3 = substr($phone, 6);
            $phone = $part1 . '-' . $part2 . '-' . $part3;
        }

	

        $message =
            "Hello $first_name,\n\n" .
            "Thank you for entering this data:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $phone\n";

	break;

}
include 'string_tester.php';
?>
