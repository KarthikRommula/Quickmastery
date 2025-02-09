<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="google-site-verification" content="K8Tbptn0q-hSarjzt9vMWEmg5ly926iQSG9woX1h2TA" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<?php
echo '<style>
.header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 0;
    background: transparent;
    display: flex;
    justify-content: space-between;
    z-index: 100;
    align-items: center;
}

.navbar a {
    position: relative;
    font-size: 18px;
    color: white;
    font-weight: 500;
    text-decoration: none;
    margin-left: 100px;
}

.navbar a::before {
    content: "";
    position: absolute;
    top: 10px;
    left: -30px;
    width: 0%;
    height: 3px;
    background: cyan;
    transition: 0.2s;
}

.navbar a:hover::before {
    width: 105%;
}

.navbar a:hover {
    color: cyan;
}

.logo img {
    width: 230px;
}

@media only screen and (max-width: 900px) {
    .logo img {
        width: 150px;
        cursor: none;
        background-color: transparent;
        position: relative;
        overflow: hidden;
    }

    button[type="submit"] {
        cursor: auto;
    }
</style>';

echo '<header class="header" style="position: fixed;
top: 0;
left: 0;
width: 100%;
padding: 0;
background: transparent;
display: flex;
justify-content: space-between;
z-index: 100;
align-items: center;">
<a href="index1.php" class="logo"><img src="LOGO TEXT.png" alt="QUICK MASTERY"></a>
</nav>
</header>';
?>
<body>
<form action="login.php" method="post">
<h2>LOGIN</h2>
<?php if(isset($_GET['error'])) {?>
<p class="error"> <?php echo $_GET['error']; ?></p>
<?php } ?>
<label><i class="fa-solid fa-user fa-xs" style="color: #ffffff;"></i> USER NAME </label>
<input type="text" name="uname" ><br>
<label><i class="fa-solid fa-key fa-xs" style="color: #ffffff;"></i> PASSWORD </label>
<input type="password" name="password"><br>
<button type="submit"><span></span>LOGIN</button>
</form>
<script>
document.addEventListener('DOMContentLoaded', () => {
var disclaimer = document.querySelector("img[alt='www.000webhost.com']");
if(disclaimer) {
disclaimer.remove();
}
});
</script>
</body>
</html>
