<html>
<title>Behat form interactions</title>
<body>

<?php require __DIR__ . '/partials/nav.php'; ?>

<h3>Story</h3>
In order to try out some basic tactics of behavioural testing<br />
As a developer<br />
I want to create a hello world example with SQL data manipulation<br />

<h4>Acceptance criteria:</h4>
<ol>
    <li>A page is created that prints the data we have on a phone booking record.</li>
</ol>

Note: This page accepts a GET param: bookingId.

<hr>

<?php

if (! array_key_exists('bookingId', $_GET)) {
    echo ('Error: Key "bookingId" not found.');
    exit;
}

$bookingId = $_GET['bookingId'];

require __DIR__ . '/config/dbconfig.php';

if (! $username) {
    echo 'Error: Setup config before running this test.';
    exit;
}

$pdo = new PDO("dblib:host=$host:$port;dbname=$dbname", $username, $password);

$sql = "SELECT TOP 1 * FROM PhoneBookings WHERE PhoneBookingId = $bookingId";
$statement = $pdo->query($sql);
$bookingData = $statement->fetchAll();

if (! $bookingData) {
    throw new Exception("Booking with Id '$bookingId' not found.");
}

echo "<h3>Booking Id $bookingId Details: </h3>";
print_r($bookingData);

?>

</body>
</html>
