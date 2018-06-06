<?php

use DataMod\PhoneBooking;
use Genesis\TestRouting\Routing;

Routing::addRoute('Hello JS', '/behat-hello-world/index-form-js.php');
Routing::addRoute('Hello World', '/behat-hello-world/index-form.php');
Routing::addRoute('Hello SQL', '/behat-hello-world/index-sql.php?bookingId=' . PhoneBooking::getKeyword('PhoneBookingId'));
