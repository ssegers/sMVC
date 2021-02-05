<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
        }
        </style>
        <!-- Custom styles for this template -->
        <link href="/css/main.css" rel="stylesheet">
    </head>
    <body>
        <!-- Header -->
        <!--title block -->
        <div class="row">
            <div class="col-2"> 
                <img class="img-fluid mt-2 mb-2" src="/img/logo.png" alt="ucll logo"> 
            </div>
            <div class="col">
                <h2 class="text-danger" style="font-size:1.5vw"><?php echo $title ?></h2>
                <h1 class="text-primary" style="font-size:2vw"><?php echo $bigTitle ?></h1>
                <h3 class="text-secondary" style="font-size:1vw"><?php echo $subTitle ?></h3>
            </div>

        </div>
        <!-- end title block -->
        <!-- nav bar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                    </li>
                </ul>
<!--                <form class="form-inline my-2 my-lg-0">
                   <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                   <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>-->
            </div>
        </nav>
        <!-- end nav bar -->
        <main role="main" class="container">

            <div class="content">
                <p><?php echo $content ?></p>
            </div>

        </main><!-- /.container -->
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
