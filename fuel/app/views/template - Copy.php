<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
        
<!-- All assets -->
	<?php echo Asset::css('bootstrap.css'); ?>
	<style>
		body { margin: 40px; }
	</style>
</head>
<body>

 <!-- Autentification -->
 
 <?php if ($current_user): ?>
  <p class="navbar-text pull-right">
     
     Pierakstījies kā <?php  echo Html::anchor('users/view/'.$current_user->id, $current_user->username)  ?>
     (<?php echo Html::anchor('users/logout','Izrakstīties') ?>)
  </p>
  <?php else: ?>
  <p class="navbar-text pull-right"><?php echo Html::anchor('users/login','Pierakstīties') ?> </p>
  <?php endif ?>
 
 
 <!-- End of autentification -->   
        
    
    <div class="menu">
        <?php echo Html::anchor('welcome', 'Sākums'); ?>
        <?php echo Html::anchor('psihologu', 'Psihologu pakalpojumi'); ?>
        <?php echo Html::anchor('smiltis', 'Smilšu terapija'); ?>
        <?php echo Html::anchor('montesori', 'Montesori skoliņa'); ?>
        <?php echo Html::anchor('logopeds', 'Logopēds'); ?>
        <?php echo Html::anchor('fizioterapija', 'Fizioterapija'); ?>
        <?php echo Html::anchor('papildus', 'Papildus pakalpojumi'); ?>
        <?php echo Html::anchor('cenas', 'Cenas'); ?>
    </div>
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
			<div class="alert alert-error">
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
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
			<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				<small>Version: <?php echo e(Fuel::VERSION); ?></small>
			</p>
		</footer>
	</div>
</body>
</html>
