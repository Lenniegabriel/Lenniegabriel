



<?php include ('../includes/header.php')?>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

<body>
    
<?php include('../includes/navBar.php')?>
<?php include('../includes/sidebar.php')?>


<div class="container-fluid">
  <div class="row">
    <!-- Main content section -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">
        <i class="fas fa-building"></i> Department
      </h1>       
      <div class="btn-toolbar mb-2 mb-md-0"></div>
      </div>

      <!-- Form section -->
      <h4 class="customer_head text-center">Add Department</h4>
      <div class="card p-4 shadow mb-4">
        <form method="POST" action="" enctype="multipart/form-data">
          <div class="row">
            <!-- Department Name Input -->
            <div class="col-md-6 mb-3">
              <label class="fw-bold p-2" for="department">Department Name</label>
              <input type="text" id="department" name="department" placeholder="Enter department name" class="form-control">
            </div>

            <!-- Faculty Selection Dropdown -->
            <div class="col-md-6 mb-3">
              <label class="fw-bold p-2" for="faculty">Faculty</label>
              <select id="faculty" name="faculty" class="form-control">
                <option value="" disabled selected>Choose faculty</option>
                <option value="Science">Science</option>
                <option value="Arts">Arts</option>
                <option value="Engineering">Engineering</option>
                <option value="Business">Business</option>
              </select>
            </div>
          </div>

          <!-- Form Buttons -->
          <div class="text-end">
            <button type="submit" name="btnSubmit" class="btn btn-primary mb-3">Add Department</button>
            <button type="reset" class="btn btn-secondary mb-3">Clear</button>
          </div>
        </form>
      </div>

      <!-- Chart section -->
      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    </main>
  </div>
</div>



<?php include('../includes/footer.php')?>

  </body>
</html>
