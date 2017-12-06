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
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">To Do List</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<main role="main" class="container">
    <br/>
    <br/>
    <br/>
    <form class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control" id="new_task" placeholder="New Task">
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
    <div >
        <ul class="list-group">
            <li class="list-group-item">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="">
                    Option one is this and that&mdash;be sure to include why it's great
                </label>
            </li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
    </div>
</main><!-- /.container -->


<!-- JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>

