<?php
$connect = mysqli_connect("localhost", "root", "", "ims_db_dept_gh_old");
$query = "SELECT * FROM feed_datatable ORDER BY ID DESC";
$result = mysqli_query($connect, $query);
$connect->close();
?>
<!DOCTYPE html>
<html>

<head>
  <!-- <title>Adonko Bitters Ltd</title> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
    $(function() {
      $("#datepicker").datepicker();
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#employee_data').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });
  </script>
</head>

<body>
  <br /><br />
  <div class="container">
    <!-- <h3 align="center">Adonko Bitters Ltd</h3> -->
    <div class="table-responsive">
      <table id="employee_data" class="table table-striped table-bordered">
        <thead>
          <tr>
            <td>Date</td>
            <td>Stock Name</td>
            <td>Day</td>
            <td>Night</td>
            <td>Amount Used</td>
            <td>Amount Available</td>
          </tr>
        </thead>
        <?php
        if ($result === false) {
          echo "Error: " . $query . "<br>" . $connect->error;
        } else {
          while ($row = mysqli_fetch_array($result)) {
            echo '  
                                   <tr>  
                                        <td>' . substr($row["date"], 0, 10) . '</td>  
                                        <td>' . $row["stock_name"] . '</td>  
                                        <td>' . $row["day"] . '</td>  
                                        <td>' . $row["night"] . '</td>  
                                        <td>' . $row["used"] . '</td>  
                                        <td>' . $row["available"] . '</td>  
                                   </tr>  
                                   ';
          }
        }

        ?>
      </table>
    </div>
  </div>
</body>

</html>