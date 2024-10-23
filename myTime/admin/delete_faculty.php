<?php
// delete_faculty.php
include '../database/functions.php';
$facultyId = $_GET['id'];

// Delete logic
$deleteResult = deleteData('faculty', ['id' => $facultyId]);

if ($deleteResult) {
    $_SESSION['successMessage'] = "Faculty deleted successfully!";
} else {
    $_SESSION['errorMessage'] = "Error deleting faculty.";
}

header("Location: add_faculty.php");
exit();
?>
