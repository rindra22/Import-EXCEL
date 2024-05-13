<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste de produits</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="row">
      <h1 class="d-flex justify-content-center my-4">Liste de produits</h1>
      <div class="d-flex justify-content-center">
        <form action="public/index.php?p=import" class="d-flex" method="post" enctype="multipart/form-data">
          <div class="mt-2">
            <input type="file" name="file" class="form-control" required>
          </div>
          <div class="ms-2">
            <button type="submit" class="btn btn-primary my-2">Import</button>
          </div>
        </form>
      </div>
      <table class="table" id="datatable">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col" class="text-center">Prix</th>
            <th scope="col">Description</th>
            <th scope="col">Type</th>
          </tr>
        </thead>

        <tbody>

          <?php foreach($products as $product){ ?>
          <tr>
            <th scope="row"><?php echo $product['id'] ?></th>
            <td><?php echo $product['name'] ?></td>
            <td class="text-center"><?php echo $product['price'] ?></td>
            <td><?php echo $product['description'] ?></td>
            <td><?php echo $product['type'] ?></td>
          </tr>
          <?php } ?>

        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="text-center">Total</th>
            <th colspan="3"></th>
          </tr>
        </tfoot>

      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>

  <script>
    $(document).ready(function () {
      $('#datatable').DataTable({
        "footerCallback": function (row, data, start, end, display) {
          var api = this.api(),
            data;
          var intVal = function (i) {
            return typeof i === 'string' ?
              i.replace(/[\$,]/g, '') * 1 :
              typeof i === 'number' ?
              i : 0;
          };
          total = api
            .column(2)
            .data()
            .reduce(function (a, b) {
              return intVal(a) + intVal(b);
            }, 0);
          $(api.column(2).footer()).html(formatMoney(total, '$'));
        },
        "columnDefs": [{
          "render": function (data, type, row) {
            return formatMoney(data);
          },
          "targets": 2
        }]
      });

      function formatMoney(amount, symbol = '') {
        return amount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ') + ' ' + symbol;
      }
    });
  </script>
</body>

</html>