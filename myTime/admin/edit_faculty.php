<?php
// edit_faculty.php
include '../database/functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $facultyId = $_POST['id'];
    $facultyName = $_POST['faculty_name'];
    $facultyCode = $_POST['faculty_code'];
    
    // Perform validation...

    $updateData = ['faculty_name' => $facultyName, 'faculty_code' => $facultyCode];
    $conditions = ['id' => $facultyId];

    $result = updateData('faculty', $updateData, $conditions);
    if ($result) {
        $_SESSION['successMessage'] = "Faculty updated successfully!";
    } else {
        $_SESSION['errorMessage'] = "Failed to update faculty.";
    }

    header("Location: add_faculty.php");
    exit();
}
