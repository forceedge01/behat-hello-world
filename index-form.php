<html>
<title>Behat form interactions</title>
<body>

<?php require __DIR__ . '/partials/nav.php'; ?>

<h3>Story</h3>
In order to try out some basic behavioural testing tactics<br />
As a developer<br />
I want to create a hello world example with form submission<br />

<h4>Acceptance criteria:</h4>
<ol>
    <li>A page is created which greets the user.</li>
    <li>A name is optionally provided that prints out the greeting along with the name.</li>
        <ul>
            <li>The name defaults to 'John'.</li>
            <li>In case a name is not provided, default to word 'World'.</li>
            <li>The name field retains the submitted value.</li>
        </ul>
    <li>A date of birth is optionally provided. If provided the page displays the age of the user.</li>
    <!-- <li>A name should only include alphanumeric characters.</li> -->
</ol>

<hr>

<?php

// Incorrect solution.
// if (preg_match('/[\$!@^&]/', $_GET['name'])) {
//     echo 'You have entered an invalid name. <br />';
//     echo '<a href="index-form.php">Reset</a>';
//     exit;
// }

// Correct solution.
// if (preg_match('/[^A-Za-z0-9]/', $_GET['name'])) {
//     echo 'You have entered an invalid name. <br />';
//     echo '<a href="index-form.php">Reset</a>';
//     exit;
// }

?>

<b>Hello <?php echo empty($_GET['name']) ? 'World' : $_GET['name'] ?>!

<?php

date_default_timezone_set('UTC');
$age = false;

if (array_key_exists('dob', $_GET)) {
    $tz = new DateTimeZone('Europe/Brussels');
    $ageDate = DateTime::createFromFormat('Y-m-d', $_GET['dob'], $tz);
    $age = $ageDate->diff(new DateTime())->y;
}

// BUG, remote first check of if statement.
if ($_GET['name'] !== 'World') {
    if (array_key_exists('dob', $_GET)) {
        if ($ageDate->getTimestamp() > time()) {
            echo "Invalid age, you are not from the future.";
        } else {
            $age = $ageDate->diff(new DateTime())->y;
        }
    }
}
?>
</b>
<br /><br />

Tell me a bit about yourself: <br /><br />

<form method="GET" action="<?php $_SERVER['PHP_SELF']?>">
<label for="name">Enter you name: </label> <input type="text" value="<?php echo empty($_GET['name']) ? 'John' : $_GET['name']?>" name="name" id="name">
<br />
<label for="dob">Enter you date of birth (YYYY-MM-DD): </label> <input type="text" name="dob" id="dob" placeholder="YYYY-MM-DD" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
<br /><br />
<button type="submit">Submit</button>
<button type="reset">Reset</button>
</form>
</body>
</html>

<?php
/**
 * 1) If the name is 'World' or left empty, the age is not shown if filled in.
 * 2) If the name is left empty, post submission it resets its value as opposed to staying empty.
 * 3) The age can be in the future!!
 */
?>