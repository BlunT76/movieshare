<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <?php echo Asset::css('bootstrap.css'); ?>
  <?php echo Asset::css('custom.css'); ?>
	<style>
		/* body { margin: 40px; } */
	</style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="/film">MovieShare</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/film">Movie list<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/rented/progress">Panier<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <ul class="navbar-nav mx-auto">
      <li><h2 class="title" >AlloCino</h2></li>
    </ul>
    
    <?php if (isset($_SESSION['login'])){?>
    <ul class="navbar-nav ml-auto">
    <form action="/film/searchfilm/" method="POST" class="form-inline my-2 my-lg-0 ml-auto">
      <input name="searchfilm"  class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search film</button>
    </form>
    <li class="nav-item active">
        <a class="btn btn-dark ml-3" href="/logout">Logout<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <?php }?>
  </div>
</nav>
<!--
        //inserer condition pour admin 
        <li><a href="/film/newfilm">Searchfilm</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search a movie">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
	  <?php// if (isset($_SESSION['login'])){?>
        <li><a href="user/logout">Logout</a></li>
	  <?php// }?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div> /.navbar-collapse 
  </div> /.container-fluid 
</nav>-->

	<div class="container">
		<div class="col-md-12">
			<h1><?php echo $title; ?></h1>
			<hr>
<?php if (Session::get_flash('success')): ?>
			<div class="alert alert-success">
				<strong>Success</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
				</p>
			</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
			<div class="alert alert-danger">
				<strong>Error</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
				</p>
			</div>
<?php endif; ?>
		</div>
		<div class="col-md-12">
<?php echo $content; ?>
		</div>
		<footer>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <?php echo Asset::js('bootstrap.js'); ?>
			
		</footer>
	</div>
</body>
</html>
