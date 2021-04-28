<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Community</title>
    <style>
        .nav {
            position: relative;
            overflow: hidden;
            background-color: #333;
        }

        .nav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .nav a:hover {
            background-color: #ddd;
            color: black;
        }

      

        .nav-centered a {
            float: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .nav-right {
            float: right;
        }

        /* Responsive navigation menu (for mobile devices) */
        @media screen and (max-width: 600px) {
            .nav a, .nav-right {
                float: none;
                display: block;
            }

            .nav-centered a {
                position: relative;
                top: 0;
                left: 0;
                transform: none;
            }
        }
    </style>
</head>
<body>
    <div class="nav">
        <div class="nav-left">
            <!-- LOGO href to home-->
            <a href="../controller/index.php?page=home">Home</a>

        </div>
        <div class="nav-centered">
            <a href="../controller/index.php?page=browse">Browse</a>
        </div>
        <div class="nav-right">
                <a href="myAccount_view.php/index.php?page=myAccount">My Account</a>
                <a href="../controller/index.php?page=logout">Sign Out</a>
                <a href="../controller/index.php?page=upload">Upload</a>

        </div>
    </div>


