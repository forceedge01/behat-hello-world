<html>
<title>Behat form interactions</title>
<body>
<h3>Story</h3>
In order to try out some basic tactics of behavioural testing<br />
As a developer<br />
I want to create a hello world example with SQL data manipulation<br />

<h4>Acceptance criteria:</h4>
<ol>
    <li>A page is created that prints the data we have on a phone booking record.</li>
</ol>

Note: This page accepts a GET param: BookingId.

<hr>

<?php

if (! array_key_exists('BookingId', $_GET)) {
    throw new Exception('Key "BookingId" not found.');
}

$bookingId = $_GET['BookingId'];

require __DIR__ . '/config/dbconfig.php';

if (! $username) {
    echo 'Setup config before running this test.';
    exit;
}

$pdo = new PDO("dblib:host=$host:$port;dbname=$dbname", $username, $password);

$sql = "SELECT TOP 1 * FROM PhoneBookings WHERE PhoneBookingId = $bookingId";
$statement = $pdo->query($sql);
$bookingData = $statement->fetchAll();

if (! $bookingData) {
    throw new Exception("Booking with Id '$bookingId' not found.");
}

print_r($bookingData);

?>

</body>
</html>
