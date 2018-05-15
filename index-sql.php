<?php

if (! array_key_exists('BookingId', $_GET)) {
    throw new Exception('Key "BookingId" not found.');
}

$bookingId = $_GET['BookingId'];

require __DIR__ . 'config/dbconfig.php';

$pdo = new PDO("dblib:host=$host:$port;dbname=$dbname", $username, $password);

$sql = "SELECT TOP 1 * FROM PhoneBookings WHERE PhoneBookingId = $bookingId";
$statement = $pdo->query($sql);
$bookingData = $statement->fetchAll();

if (! $bookingData) {
    throw new Exception("Booking with Id '$bookingId' not found.");
}

print_r($bookingData);
