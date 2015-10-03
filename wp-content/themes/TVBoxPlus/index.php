<?php require_once "frame_content.php"; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">	
<head>
<title>TVBoxPlus</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
<?php wp_head(); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/tabs.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/login.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=drawing,geometry,places&sensor=false"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/dynamic_content.js"></script>
</head>
	
	
	
<body>
		<nav id="top-menu-wrapper">
			<nav class="top-menu">
				<ul id="menu-topmenu" class="menu">
					<!-- <li><img src="<?php echo get_template_directory_uri(); ?>/images/language.png"></img><a href="<?php echo get_site_url(); ?>">  English </a><img src="<?php echo get_template_directory_uri(); ?>/images/arrow.png"></img></li>-->
					<li><a <?php echo (empty($sid) ? "" : "class='logged'"); ?> id="link_login" style="cursor: pointer;"><?php echo (empty($sid) ? "Login" : "Log out"); ?></a></li>
				<?php if (empty($sid)) { ?>
					<li><a href="http://crm.tvboxplus.com/plugin/order/main/index/IPTV">Sign Up</a></li>	
				<?php } ?>
				<?php if (isset($_GET['show_error_form']) && $_GET['show_error_form'] == "yes") { ?>
					<li><div id="error_form">Вы ввели неправильно логин или пароль <a style="color: blue; cursor: pointer;" id="close_error_form">(скрыть)</a></div></li>
				<?php } ?>	
				<?php if (!empty($sid)) { ?>
					<li><a href="<?php echo get_site_url(); ?>/?frame=profile">My Profile</a>
				<?php } ?>
					<li><?php require_once "login.php"; ?></li>
				</ul>
			</nav>
		</nav>			
		<div id="header-wrapper">
			<div id="header">			
				<div id="header-inner-wrapper">
					<div id="logo">
							<a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png"></img> </a>
					</div>
					<div id="full-menu-wrapper">
						<div id="call">Call FREE: 1-888-757-8477</div>
						<nav class="main-menu">
							<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
						</nav>
					</div>
					<div class="menu-shadow"></div>
				</div>
			</div>
		</div>

		<div id="content" role="main">
			<div style="float:left" id="frame_content">
				<?php if (!empty($frame)) { ?>
					<iframe 
							name="remote_frame" 
							id="id_remote_frame" 
							src="<?php echo $frame_url; ?>" 
							frameborder="0"
							scrolling="auto"
							width="1000px"
							height="550px" 
							marginwidth="0"
							marginheight="0"
						>
					</iframe>
				<?php } ?>		
			</div>
			
			<?php if (is_home_tmpl()) { ?>
				<div style="float:left" id="dynamic_content">
					<div id="announcement‏_content">
						<h2 class="announcement‏-content-h2">Сегодня на экранах</h2>
							<div class="cursors">
								<div id="cursor-announcement‏-next" class="cursor-next"></div>
								<div id="cursor-announcement‏-prev" class="cursor-prev"></div>
							</div>
							<div id="announcement‏_dynamic"></div>
							<input type="hidden" id="announcement_page" value="1"></input>
					</div>
					<div id="vod_content">
						<h2 class="vod-content-h2">Новинки видеотеки</h2>
							<div class="cursors">
								<div id="cursor-vod-next" class="cursor-next"></div>
								<div id="cursor-vod-prev" class="cursor-prev"></div>
							</div>
							<div id="vod_dynamic"></div>
							<input type="hidden" id="vod_page" value="1"></input>
					</div>
				</div>
			<?php } ?>
				
			<?php if (is_home_tmpl() || empty($frame)) { ?>
				<div id="posts"> 
					<?php if (have_posts()) { ?>
						<?php  while (have_posts()) : the_post(); ?>
							<?php get_template_part("content", get_post_format()); ?>
						<?php endwhile; ?>

					<?php } else { ?>
						<?php get_template_part("content", "none"); ?>
					<?php } ?>
				</div>
			<?php } ?>			
		</div>	

		<div id="footer">
			<div id="footer-menu">
				<nav class="footer-menu">
					 <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
				</nav>
			</div>


			<div id="copyright">Copyright &copy <?php echo date('Y'); ?> TVboxPlus. All Rights Reserved </div>
		</div>
</body>
<script>
	$(function(){
		$('#vod_dynamic').load('/wp-content/themes/TVBoxPlus/dynamic_content.php?action=getVod');
		$('#announcement‏_dynamic').load('/wp-content/themes/TVBoxPlus/dynamic_content.php?action=getAnnouncements');
		
		$('#close_error_form').on("click",function(){
			$('#error_form').hide();
		});
	});
</script>
</html>
