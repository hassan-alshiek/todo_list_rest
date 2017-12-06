<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>To Do List</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">To Do List</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<main role="main" class="container">
    <br/>
    <br/>
    <br/>
    <div class="card">
        <div class="card-body">
            <form id="add_item">
                <div class="form-row">
                    <div class="col-10">
                        <input type="text" class="form-control" id="new_item" placeholder="New Item">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary btn-add" type="button">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div>
        <ul class="list-group" id="list_items">
            <li class="list-group-item">
        </ul>
    </div>
</main><!-- /.container -->


<!-- JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>

