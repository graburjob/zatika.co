<?php
/*
* Title: Zatika.co Script
* Author: Zatika.co
* Version: 1.0
*
* Performance rating = [(Total of opponents' ratings + 400 * (Wins - Losses)) / score].
*/
include('Mysql.php');
include('functions.php');


// Get random 2
$query="SELECT * FROM images ORDER BY RAND() LIMIT 0,2";
$result = @mysql_query($query);
while($row = mysql_fetch_object($result)) {
$images[] = (object) $row;
}

// Get the top10
$result = mysql_query("SELECT *, ROUND(score/(1+(losses/wins))) AS performance FROM images ORDER BY ROUND(score/(1+(losses/wins))) DESC LIMIT 0,10");
while($row = mysql_fetch_object($result)) $top_ratings[] = (object) $row;

// Close the connection
mysql_close();

?>


<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation Template | Workspace</title>

    
    <meta name="description" content="Documentation and reference library for ZURB Foundation. JavaScript, CSS, components, grid and more." />
    
    <meta name="author" content="ZURB, inc. ZURB network also includes zurb.com" />
    <meta name="copyright" content="ZURB, inc. Copyright (c) 2013" />
    <link rel="stylesheet" href="../assets/css/foundation.css" />
    <script src="../assets/js/modernizr.js"></script>
    <style type="text/css">
body, html {font-family:Arial, Helvetica, sans-serif;width:100%;margin:0;padding:0;text-align:center;}
a img {border:0;}
td {font-size:11px;}
.image {background-color:#eee;border:1px solid #ddd;border-bottom:1px solid #bbb;padding:5px;}
</style>

  </head>
  <body>
    

<div class="row">
  <div class="large-12 columns">
    <!-- Navigation -->

    <nav class="top-bar" data-topbar>
      <ul class="title-area">
        <!-- Title Area -->

        <li class="name">
          <h1><a href="#">Top Bar Title</a></h1>
        </li>

        <li class="toggle-topbar menu-icon">
          <a href="#"><span>menu</span></a>
        </li>
      </ul>

      <section class="top-bar-section">
        <ul class="left">
          <li>
            <a href="#">Link 1</a>
          </li>

          <li>
            <a href="#">Link 2</a>
          </li>
        </ul>

        <ul class="right">
          <li class="search">
            <form>
              <input type="search">
            </form>
          </li>

          <li class="has-button">
            <a class="small button" href="#">Search</a>
          </li>
        </ul>
      </section>
    </nav><!-- End Navigation -->
  </div>
</div>

<div class="row">
  <div class="large-12 columns">
    <!-- Desktop Slider -->

    <div class="hide-for-small">
	  <center>
		<table>
		<tr>
		  <td valign="top" class="image"><a href="Rate.php?winner=<?=$images[0]->image_id?>&loser=<?=$images[1]->image_id?>"> <div id="featured"><img src="../images/<?=$images[0]->filename ?>" height=500 weight=500 /></div</a></td>
		  <td valign="top" class="image"><a href="Rate.php?winner=<?=$images[1]->image_id?>&loser=<?=$images[0]->image_id?>"> <div id="featured"><img src="../images/<?=$images[1]->filename ?>" height=500 weight=500 /></div></a></td>
		</tr>
		<tr>
		  <td>Won: <?=$images[0]->wins?>, Lost: <?=$images[0]->losses?></td>
		  <td>Won: <?=$images[1]->wins?>, Lost: <?=$images[1]->losses?></td>
		</tr>
		<tr>
		  <td>Score: <?=$images[0]->score?></td>
		  <td>Score: <?=$images[1]->score?></td>
		</tr>
		<tr>
		  <td>Expected: <?=round(expected($images[1]->score, $images[0]->score), 4)?></td>
		  <td>Expected: <?=round(expected($images[0]->score, $images[1]->score), 4)?></td>
		</tr>
		</table>
	  </center>
	  
    </div><!-- End Desktop Slider -->
    <!-- Mobile Header -->
  </div>
</div><br>

<div class="row">
  <div class="large-12 columns">
    <div class="row">
      <!-- Thumbnails -->
  <?php
  foreach ($top_ratings as $key => $image) { 
  ?>
      <div class="large-3 small-6 columns">
        <img src="../images/<?= $image->filename ?>" />

        <h6 class="panel">Description</h6>
      </div>
  <?php 
  } 
  ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="large-12 columns">
    <div class="row">
      <!-- Content -->

      <div class="large-8 columns">
        <div class="panel radius">
          <div class="row">
            <div class="large-6 small-6 columns">
              <h4>Header</h4>
              <hr>

              <h5 class="subheader">Risus ligula, aliquam nec fermentum vitae, sollicitudin eget urna. Donec
              dignissim nibh fermentum odio ornare sagittis.</h5>

              <div class="show-for-small" style="text-align: center">
                <a class="small radius button" href="#">Call To Action!</a><br>
                <a class="small radius button" href="#">Call To Action!</a>
              </div>
            </div>

            <div class="large-6 small-6 columns">
              <p>Suspendisse ultrices ornare tempor. Aenean eget ultricies libero. Phasellus non ipsum eros. Vivamus
              at dignissim massa. Aenean dolor libero, blandit quis interdum et, malesuada nec ligula. Nullam erat
              erat, eleifend sed pulvinar ac. Suspendisse ultrices ornare tempor. Aenean eget ultricies libero.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="large-4 columns hide-for-small">
        <h4>Get In Touch!</h4>
        <hr>
        <a href="#">
        <div class="panel radius callout" style="text-align: center">
          <strong>Call To Action!</strong>
        </div></a> <a href="#">
        <div class="panel radius callout" style="text-align: center">
          <strong>Call To Action!</strong>
        </div></a>
      </div><!-- End Content -->
    </div>
  </div>
</div><!-- Footer -->

<footer class="row">
  <div class="large-12 columns">
    <hr>

    <div class="row">
      <div class="large-6 columns">
        <p>© Copyright no one at all. Go to town.</p>
      </div>

      <div class="large-6 columns">
        <ul class="inline-list right">
          <li>
            <a href="#">Link 1</a>
          </li>

          <li>
            <a href="#">Link 2</a>
          </li>

          <li>
            <a href="#">Link 3</a>
          </li>

          <li>
            <a href="#">Link 4</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/templates/foundation.js"></script>
    <script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
  </body>
</html>