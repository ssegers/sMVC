<!DOCTYPE html>
<html lang="en">
<head>
    <title>sMVC</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!-- Custom styles -->
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>

    <!-- Header -->
    <header class="container">
        <div class="row align-items-center py-2">

            <!-- Logo -->
            <div class="col-3 col-md-2">
                <img
                    class="img-fluid"
                    src="/img/logo.png"
                    alt="UCLL logo">
            </div>

            <!-- Titles -->
            <div class="col">
                <h2 class="text-danger fs-5 mb-1">
                    <?php echo $title ?>
                </h2>

                <h1 class="text-primary fs-2 mb-1">
                    <?php echo $bigTitle ?>
                </h1>

                <h3 class="text-secondary fs-6 mb-0">
                    <?php echo $subTitle ?>
                </h3>
            </div>

        </div>
    </header>
    <!-- End Header -->


    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault"
                aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse"
                id="navbarsExampleDefault">

                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <?php echo $bootstrapNavigation ?>
                </ul>

                <form class="d-flex" role="search">
                    <input
                        class="form-control me-2"
                        type="search"
                        placeholder="Search"
                        aria-label="Search">

                    <button
                        class="btn btn-secondary"
                        type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->


    <!-- Main content -->
    <main class="container py-4">

        <div class="content">
            <?php echo $content ?>
        </div>

        </main><!-- /.container -->
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
</body>
</html>
