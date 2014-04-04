<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href='css/style.css?<?php echo _VERSION_ ?>' rel='stylesheet' type='text/css'>
<title>Report Cards</title>
</head>
<body class="tundra">
<h1 id="heading">Report Cards</h1>
<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) : ?>
<a id="logout" href="logout">Logout <?php echo htmlentities($_SESSION['username']) ?></a>
<?php endif ?>
<div id="main" class="<?php echo $page ?>">
<?php echo $content ?>
</div>
<div id="footer">
<p>&copy; 2013 <?php if (date('Y') != '2013') echo '-' . date('Y'); ?> Betsy A. Gamrat, all rights reserved.</p>
</div> 
</body>
</html>
