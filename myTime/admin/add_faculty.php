<?php
session_start();
include '../database/functions.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $facultyName = $_POST['faculty'];
    $facultyCode = $_POST['facultyCode'];

    // Validate faculty name
    if (empty($facultyName) || !preg_match('/^[A-Za-z -]+$/', $facultyName)) {
        $_SESSION['errorMessage'] = "Faculty name is required and can only contain letters, spaces, and dashes.";
        header("Location: add_faculty.php");
        exit();
    }

    if (empty($facultyCode)) {
      $_SESSION['errorMessage'] = "Faculty Code is required.";
      header("Location: add_faculty.php");
      exit();
    }

    // Check if a faculty with the same name already exists
    $existingFaculty = selectData('faculty', '*', ['faculty_name' => $facultyName]);
    if ($existingFaculty) {
        $_SESSION['errorMessage'] = "Faculty with the same name already exists.";
        header("Location: add_faculty.php");
        exit();
    }

    // Insert new faculty data into the database
    $tableName = "faculty";
    $columns = ['faculty_name', 'faculty_code'];
    $values = [$facultyName, $facultyCode];

    $insertResult = insertData($tableName, $columns, $values);

    // Check if insertion was successful
    if ($insertResult) {
        $_SESSION['successMessage'] = "Faculty added successfully!";
    } else {
        $_SESSION['errorMessage'] = "There was an error adding the faculty.";
    }

    // Redirect to the faculty page
    header("Location: add_faculty.php");
    exit();
}
?>

<?php include('../includes/header.php') ?>

<body>
    
<?php include('../includes/navBar.php') ?>
<?php include('../includes/sidebar.php') ?>

<div class="container-fluid">
  <div class="row">
    <!-- Main content section -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
          <i class="fas fa-user-tie"></i> Faculty
        </h1>        
      </div>

      <!-- Form section -->
      <h4 class="customer_head text-center">Add Faculty</h4>
      <div class="card p-4 shadow mb-4">
        <?php
          if (isset($_SESSION['errorMessage'])) {
              echo "<div class='alert alert-danger'>{$_SESSION['errorMessage']}</div>";
              unset($_SESSION['errorMessage']);
          }
          if (isset($_SESSION['successMessage'])) {
              echo "<div class='alert alert-success'>{$_SESSION['successMessage']}</div>";
              unset($_SESSION['successMessage']);
          }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="fw-bold p-2" for="faculty">Faculty Name</label>
              <input type="text" id="faculty" name="faculty" placeholder="Enter faculty name" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
              <label class="fw-bold p-2" for="facultyCode">Faculty Code</label>
              <input type="text" id="facultyCode" name="facultyCode" placeholder="Enter faculty code e.g. ABC" class="form-control">
            </div>
          </div>

          <div class="text-end">
            <button type="submit" name="btnSubmit" class="btn btn-primary mb-3">Add Faculty</button>
            <button type="reset" class="btn btn-secondary mb-3">Clear</button>
          </div>
        </form>
      </div>

      <!-- Table Section -->
      <h4 class="text-center mt-5">Faculty List</h4>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Faculty Name</th>
              <th>Faculty Code</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <tbody>
  <?php
    // Fetch all faculties from the database
    $faculties = selectData('faculty', '*'); // No conditions
    if (!empty($faculties)) {
        foreach ($faculties as $faculty) {
            if (isset($faculty['id'])) {  // Check if 'id' is present
                echo "<tr>
                        <td>{$faculty['faculty_name']}</td>
                        <td>{$faculty['faculty_code']}</td>
                        <td>
                          <a href='edit_faculty.php?id={$faculty['id']}' class='btn btn-warning btn-sm'>Edit</a>
                          <a href='delete_faculty.php?id={$faculty['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                      </tr>";
            } else {
                echo "<tr><td colspan='3' class='text-center'>Faculty ID missing</td></tr>";
            }
        }
    } else {
        echo "<tr><td colspan='3' class='text-center'>No faculties added yet.</td></tr>";
    }
  ?>
</tbody>

          </tbody>
        </table>
      </div>

    </main>
  </div>
</div>

<?php include('../includes/footer.php') ?>
</body>
</html>
