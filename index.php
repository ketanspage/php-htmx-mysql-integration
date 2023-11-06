<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Customer Table</title>
    <script src="https://unpkg.com/htmx.org@1.6.0/dist/htmx.min.js"></script>
  
</head>
  <body>
<nav class="navbar navbar-light bg-dark">
  <a class="navbar-brand text-light" href="#">
    Customers
  </a>

  <button type="button" class="btn btn-light" data-toggle="modal" data-target="#addCustomerModal">
  Add Customer
</button>

<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCustomerModalTitle">Add New Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <form id="addCustomerForm" hx-post="add_customer.php" hx-target="this">
          <div class="form-group">
            <label for="customerName">Customer Name</label>
            <input type="text" class="form-control" id="customerName" name="customerName" required>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address">
          </div>
          <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes"></textarea>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="isdCode">ISD Code</label>
            <input type="text" class="form-control" id="isdCode" name="isdCode">
          </div>
          <div class="form-group">
            <label for="mobileNumber">Mobile Number</label>
            <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" required>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>


</nav>
<div class="d-flex flex-row ">
  <label for="recordLimit" class="mr-2 ml-2 mt-2">Records per Page</label>
  <select class="form-control" id="recordLimit" style="width: 100px;" onchange="changeRecordLimit()">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="15">15</option>
  </select>
</div>


  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customer_management";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$limit = 5; // Default limit
if (isset($_GET['recordLimit'])) {
  $limit = intval($_GET['recordLimit']);
}

$page = 1; // Default page
if (isset($_GET['page'])) {
  $page = intval($_GET['page']);
}

$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM `customers` LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo '<table class="table table-striped"><thead><tr>
        <th>Customer Name</th>
        <th>Address</th>
        <th>Notes</th>
        <th>Email</th>
        <th>ISD Code</th>
        <th>Mobile Number</th>
      </tr></thead><tbody>';
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['CustomerName'] . "</td>";
    echo "<td>" . $row['Address'] . "</td>";
    echo "<td>" . $row['Notes'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td>" . $row['ISDCode'] . "</td>";
    echo "<td>" . $row['MobileNumber'] . "</td>";
    echo "</tr>";
  }
  echo '</tbody></table>';
} else {
  echo "No data found";
}

$conn->close();
?>

  <!-- Pagination links -->
  <div class="d-flex justify-content-end mr-2">
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item"><a class="page-link text-dark" href="?page=<?= $page - 1; ?>">Previous</a></li>
      <li class="page-item"><a class="page-link text-dark" href="?page=1">1</a></li>
      <li class="page-item"><a class="page-link text-dark" href="?page=2">2</a></li>
      <li class="page-item"><a class="page-link text-dark" href="?page=3">3</a></li>
      <li class="page-item"><a class="page-link text-dark" href="?page=<?= $page + 1; ?>">Next</a></li>
    </ul>
  </nav>
</div>


  <script>
  function changeRecordLimit() {
    const recordLimit = document.getElementById('recordLimit').value;
    const url = new URL(window.location.href);
    url.searchParams.set('page', 1);
    url.searchParams.set('recordLimit', recordLimit);
    window.location.href = url.toString();
  }

  // Set the selected record limit in the dropdown based on the URL parameter
  document.addEventListener("DOMContentLoaded", function () {
    const url = new URL(window.location.href);
    const recordLimit = url.searchParams.get("recordLimit");
    if (recordLimit) {
      document.getElementById('recordLimit').value = recordLimit;
    }
  });
</script>





    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>