<?php
/** BUGS
 * 1) If the name is 'World' the age is not shown.
 * 2) If the name is left empty, post submission it resets its value as opposed to staying empty.
 * 3) The age is shown in negative values.
 */
?>
<html>
<title>Behat form interactions</title>
<body>
<h3>Story</h3>
In order to try out some basic tactics of behavioural testing<br />
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
if (!empty($_GET['dob'])) {
    // explode the date to get month, day and year
    // Format: 2016-12-08
    $birthDate = explode("-", $_GET['dob']);
    // get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
        ? ((date("Y") - $birthDate[0]) - 1)
        : (date("Y") - $birthDate[0]));
}

// BUG, remote first check of if statement.
if ($_GET['name'] !== 'World') {
    if ($age !== false) {
        echo "You are $age year(s) old!";
    }
}
?>
</b>
<br /><br />

Tell me a bit about yourself: <br /><br />

<form method="GET" action="<?php $_SERVER['PHP_SELF']?>">
<label for="name">Enter you name: </label> <input type="text" value="<?php echo empty($_GET['name']) ? 'John' : $_GET['name']?>" name="name" id="name">
<br />
<label for="dob">Enter you date of birth: </label> <input type="date" name="dob" id="dob">
<br /><br />
<button type="submit">Submit</button>
<button type="reset">Reset</button>
</form>
</body>
</html>