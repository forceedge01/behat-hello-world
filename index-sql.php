<html>
<title>Behat form interactions</title>
<body>

<?php require __DIR__ . '/partials/nav.php'; ?>

<h3>Story</h3>
In order to try out some data manipulation tactics that aid behavioural testing<br />
As a developer<br />
I want to create a hello world example with SQL data manipulation<br />

<h4>Acceptance criteria:</h4>
<ol>
    <li>A page is created that prints the data we have on a phone booking record.</li>
    <li>If the booking due date is in the future, the screen displays "Your booking due date is in the future."</li>
    <li>If the booking due date is in the past, the screen displays "Your booking due date is in the past."</li>
    <li>The name and email address of the consultant assigned to the booking is printed out as well</li>
</ol>

Note: This page accepts a GET param: bookingId.

<hr>

<?php

require __DIR__ . '/config/dbconfig.php';

if (! $username) {
    echo 'Error: Setup config before running this test.';
    exit;
}

if (! array_key_exists('bookingId', $_GET)) {
    echo('Error: Key \'bookingId\' not found.');
    exit;
}

$bookingId = $_GET['bookingId'];
try {
    $dns = "dblib:host=$host:$port;dbname=$dbname";
    $pdo = new PDO($dns, $username, $password);

    $sql = "SELECT TOP 1 * FROM PhoneBookings WHERE PhoneBookingId = $bookingId";
    $statement = $pdo->query($sql);
    $bookingData = $statement->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
    echo 'DNS used: ' . $dns;
    exit;
}

if (! $bookingData) {
    echo "Booking with Id '$bookingId' not found.";
    exit;
}

$sql = "select top 1 * from Consultants where ConsultantId = " . $bookingData[0]['ConsultantId'];
$statement = $pdo->query($sql);
$consultantData = $statement->fetchAll();

echo $sql;

?>

<div id="fortuneTeller">
    <!-- Bug: Message purposefully inversed. -->
    <?php if (strtotime($bookingData['InvoiceDue']) < time()) : ?>
        <h3>Your booking due date is in the future.</h3>
    <?php else : ?>
        <h3>Your booking due date is in the past.</h3>
    <?php endif; ?>
</div>

<h3>Booking Id <?php echo $bookingId ?> Details: </h3>
The consultant looking after this booking is <b><?php echo $consultantData[0]['FirstName'] ?> <?php echo $consultantData[0]['LastName'] ?></b> <br />
<b><?php echo $consultantData[0]['Title'] ?></b> <br />
Email: <?php echo $consultantData[0]['EmailAddress'] ?><br />
<pre>

<?php print_r($bookingData); ?>

</body>
</html>
