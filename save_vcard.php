<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    // Generate the VCard
    require_once('vcard-creator/VCard.php');
    $myVCard = new VCard();
    $myVCard->addName($lname, $fname, '', '', '');
    $myVCard->addCompany('MyProjectUSA');
    $myVCard->addJobtitle($role);
    $myVCard->addEmail($email);
    $myVCard->addPhoneNumber($phone, 'PREF:CELL');
    $myVCard->addPhoneNumber('6149050977', 'WORK');
    $myVCard->addAddress('', '', '3275 Sullivant Ave', 'Columbus', '', '43204', 'Ohio');
    $myVCard->addURL('https://www.myprojectusa.org/');
    $output = $myVCard->toString();

    // Save the VCard to a file
    $filename = $lname . '.vcf';
    $file = fopen('vcards/' . $filename, 'w');
    fwrite($file, $output);
    fclose($file);

    // Send a response
    $response = array(
        'success' => true,
        'url' => 'https://example.com/vcards/' . $filename
    );
    header('Content-Type: application/json');
    echo json_encode($response);

}
?>
