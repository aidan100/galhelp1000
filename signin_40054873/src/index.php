<?php

include_once('functions.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

    <!-- Custom navbar styling -->
    <link rel="stylesheet" href="styling.css">

    <title>SignIn</title>
</head>

<body>
    <?php
    include("navbar.php");
    ?>



    <div class="column is-one-third side-bar">
    </div>
    <div class="column is-one-third is-offset-one-third">
        <div class="label">
            <h1 class="title">Sign In:</h1>
        </div>
        <form id="form" name="signin" method="POST" action="http://localhost:85/">

            <div class="field">
                <label class="label" for="email">Email</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input is-warning" type="email" placeholder="Email" name="email" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                </div>
            </div>


            <div class="field">
                <label class="label" for="password">Password</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input is-success" type="password" placeholder="Password" name="password" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <input type="submit" value="submit" name="submituser" class="button is-link">
                </div>
                <div class="control">
                    <button class="button is-link is-light">Clear</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    include("footer.php");
    ?>
</body>

</html>