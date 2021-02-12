<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  
    <title>sMVC Welcome</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <style>
        /*
         * Base structure
         */

        html,
        body {
          height: 100%;
          background-color: #333;
        }

        body {
          display: -ms-flexbox;
          display: -webkit-box;
          display: flex;
          -ms-flex-pack: center;
          -webkit-box-pack: center;
          justify-content: center;
          color: #fff;
          text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
          box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
        }

        .main-container {
          max-width: 50em;
        }
        hr {
            border-top: 1px solid red;
        }
        /* Custom default button */
        .btn-secondary,
        .btn-secondary:hover,
        .btn-secondary:focus {
          color: #333;
          text-shadow: none; /* Prevent inheritance from `body` */
          background-color: #fff;
          border: .05rem solid #fff;
        }
    </style>
  </head>

  <body>

    <div class="main-container d-flex h-100 p-3  flex-column">
        <div class="d-flex justify-content-center" >
            <h1>Welcome to sMVC</h1>
        </div>
        <div class="d-flex justify-content-center">
            <h2>a small PHP MVC Framework</h2>
        </div>
        <br>
        <div><h3>What is sMVC</h3></div>
        <div> <hr> </div>
        <div>
            <p class="lead">
                sMVC is an MVC (Model-View-Controller) application framework for PHP.
                It provides clear separation between the data (Model), 
                the presentation (View), and the glue in between (Controller).
            </p>
        </div>
        <div><h3>What sMVC is NOT</h3></div>
        <div> <hr> </div>
        <div>
            <p class="lead">sMVC is not a complete framework that already contains 
                all kinds of libraries and software components. Out-of-the-box it 
                only offers an MVC structure with support for database operations via the PDO class 
                The framework can be extended according to your own needs by own classes 
                and functions or by third-party libraries (https://packagist.org/) 
                that you can install via composer. This means the framework is the ideal basis to master programming in PHP.
            </p>
        </div>
        <div class="d-flex flex-row justify-content-center">
            <p class="lead">
              <a href="https://github.com/ssegers/sMVC/wiki" class="btn btn-lg btn-secondary">Learn more</a>
            </p>
        </div>
    </div>
  </body>
</html>
