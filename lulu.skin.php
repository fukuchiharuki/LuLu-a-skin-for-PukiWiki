<?php
// lulu.skin.php
// Copyright
//   2017 FUKUCHI Haruki
// License: GPL v2 or (at your option) any later version
//
// PukiWiki custom skin

//// PukiWiki - Yet another WikiWikiWeb clone.
//// pukiwiki.skin.php
//// Copyright
////   2002-2016 PukiWiki Development Team
////   2001-2002 Originally written by yu-ji
//// License: GPL v2 or (at your option) any later version
////
//// PukiWiki default skin

// ------------------------------------------------------------
// Settings (define before here, if you want)

// Set site identities
$_IMAGE['skin']['logo']     = 'pukiwiki.png';
$_IMAGE['skin']['favicon']  = ''; // Sample: 'image/favicon.ico';

// Show / Hide topickpath UI at your choice
if (! defined('PKWK_SKIN_SHOW_TOPICPATH'))
	define('PKWK_SKIN_SHOW_TOPICPATH', 1); // 1, 0

// Show / Hide toolbar UI at your choice
if (! defined('PKWK_SKIN_SHOW_TOOLBAR'))
	define('PKWK_SKIN_SHOW_TOOLBAR', 1); // 1, 0

// ------------------------------------------------------------
// Code start

// Prohibit direct access
if (! defined('UI_LANG')) die('UI_LANG is not set');
if (! isset($_LANG)) die('$_LANG is not set');
if (! defined('PKWK_READONLY')) die('PKWK_READONLY is not set');

$lang  = & $_LANG['skin'];
$link  = & $_LINK;
$image = & $_IMAGE['skin'];
$rw    = ! PKWK_READONLY;

// Decide charset for CSS
$css_charset = 'iso-8859-1';
switch(UI_LANG){
	case 'ja': $css_charset = 'Shift_JIS'; break;
}

// MenuBar
$menu = arg_check('read') && exist_plugin_convert('menu') ? do_plugin_convert('menu') : FALSE;

// ------------------------------------------------------------
// Output

// HTTP headers
pkwk_common_headers();
header('Cache-control: no-cache');
header('Pragma: no-cache');
header('Content-Type: text/html; charset=' . CONTENT_CHARSET);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<?php if ($nofollow || ! $is_read)  { ?><meta name="robots" content="NOINDEX,NOFOLLOW" /><?php } ?>
		<title><?php echo $title ?> - <?php echo $page_title ?></title>
		<link rel="SHORTCUT ICON" href="<?php echo $image['favicon'] ?>" />
		<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $link['rss'] ?>" />
		<?php echo $head_tag ?>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-blue.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
		<link rel="stylesheet" href="skin/lulu/assets/css/template-style.css">
		<link rel="stylesheet" href="skin/lulu/assets/css/lulu-style.css">
		<link rel="stylesheet" href="skin/lulu/assets/css/custom-style.css">
		<style>
		</style>
	</head>
	<body>
		<div class="template-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">

			<header class="lulu-header template-header mdl-layout__header mdl-layout__header--scroll mdl-color--grey-100 mdl-color-text--grey-800">
				<div class="mdl-layout__header-row">
					<span class="lulu-header__title mdl-layout-title">
						<a href="<?php echo $link['top'] ?>" class="mdl-color-text--grey-800">
							<span class="lulu-header__title__icon"><i class="material-icons">home</i></span>
							<span class="lulu-header__title__text"><?php echo $page_title ?></span>
						</a>
					</span>
					<div class="mdl-layout-spacer"></div>
					<div class="lulu-header__search mdl-textfield mdl-js-textfield mdl-textfield--expandable">
						<form class="lulu-header__search__form" action="<?php echo $link['search'] ?>" method="post">
							<label class="mdl-button mdl-js-button mdl-button--icon" for="search">
								<i class="material-icons">search</i>
							</label>
							<div class="mdl-textfield__expandable-holder">
								<input class="lulu-header__search__form__query mdl-textfield__input" type="text" name="word" id="search">
								<label class="mdl-textfield__label" for="search">Enter your query...</label>
							</div>
						</form>
					</div>
				</div>
			</header>

<?php
function _toolbar($key){
	$lang  = & $GLOBALS['_LANG']['skin'];
	$link  = & $GLOBALS['_LINK'];
	//$image = & $GLOBALS['_IMAGE']['skin'];
	if (! isset($lang[$key])) { echo 'LANG NOT FOUND'; return FALSE; }
	if (! isset($link[$key])) { echo 'LINK NOT FOUND'; return FALSE; }
	//if (! isset($image[$key])) { echo 'IMAGE NOT FOUND'; return FALSE; }
	echo '<a class="mdl-navigation__link" href="' . $link[$key] . '">' . $lang[$key] . '</a>';
	return TRUE;
}
?>

<?php if (PKWK_SKIN_SHOW_TOOLBAR) { ?>
			<div class="mdl-layout__drawer">
				<span class="mdl-layout-title">Menu</span>
				<nav class="mdl-navigation">

					<?php if ($is_page) { ?>
						<?php if ($rw) { ?>
							<?php _toolbar('edit') ?>
							<?php if ($is_read && $function_freeze) { ?>
								<?php if (! $is_freeze) { _toolbar('freeze'); } else { _toolbar('unfreeze'); } ?>
							<?php } ?>
						<?php } ?>
						<?php _toolbar('diff') ?>
						<?php if ($do_backup) { ?>
							<?php _toolbar('backup') ?>
						<?php } ?>
						<?php if ($rw) { ?>
							<?php if ((bool)ini_get('file_uploads')) { ?>
								<?php _toolbar('upload') ?>
							<?php } ?>
							<?php _toolbar('copy') ?>
							<?php _toolbar('rename') ?>
						<?php } ?>
						<?php _toolbar('reload') ?>
						<hr />
					<?php } ?>

					<?php if ($rw) { ?>
						<?php _toolbar('new') ?>
					<?php } ?>
					<?php _toolbar('list')   ?>
					<?php _toolbar('search') ?>
					<?php _toolbar('recent') ?>
					<hr />

					<?php _toolbar('help') ?>
					<hr />
					<?php _toolbar('rss10') ?>

				</nav>
			</div>
<?php } // PKWK_SKIN_SHOW_TOOLBAR ?>

			<div class="template-ribbon"></div>

			<main class="template-main mdl-layout__content">

			<div class="template-container mdl-grid">
				<div class="mdl-cell mdl-cell--1-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
				<div class="template-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--10-col">
					<article class="lulu-article">

						<?php 
						$topicpath = '';
						if (PKWK_SKIN_SHOW_TOPICPATH) { 
							require_once(PLUGIN_DIR . 'topicpath.inc.php'); 
							$topicpath = plugin_topicpath_inline();
						}
						?>
						<?php if ($topicpath != '' || $lastmodified != '') { ?>
						<div class="lulu-article__meta-information">
							<?php if ($topicpath != '') { ?>
							<div class="lulu-article__meta-information__crumbs mdl-color-text--grey-500">
								<?php require_once(PLUGIN_DIR . 'topicpath.inc.php'); echo plugin_topicpath_inline(); ?>
							</div>
							<?php } ?>
							<?php if ($lastmodified != '') { ?>
							<div class="lulu-article__meta-information__updated-at mdl-color-text--grey-500">
								<?php echo $lastmodified ?>
							</div>
							<?php } ?>
						</div>
						<?php } ?>

						<?php echo $body ?>

						<?php if ($notes != '') { ?>
						<div class="lulu-article__note">
							<?php echo $notes ?>
						</div>
						<?php } ?>
						<?php if ($attaches != '') { ?>
						<div class="lulu-article__attach">
							<?php echo $attaches ?>
						</div>
						<?php } ?>

					</article>
				</div>
			</div>

			<?php if ($menu !== FALSE) { ?>
			<div class="template-container mdl-grid">
				<div class="mdl-cell mdl-cell--1-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
				<div class="template-content template-content--type_sub mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--10-col">
					<?php echo $menu ?>
				</div>
			</div>
			<?php } ?>

			<footer class="template-footer mdl-mini-footer">
				<div class="mdl-mini-footer--left-section">
					Site admin: <a href="<?php echo $modifierlink ?>"><?php echo $modifier ?></a><br />
					<?php echo S_COPYRIGHT ?>.
					Powered by PHP <?php echo PHP_VERSION ?>. HTML convert time: <?php echo elapsedtime() ?> sec.
				</div>
			</footer>

			</main>
		</div>
		<script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
		<script src="skin/lulu/assets/js/lulu-main.js"></script>

	</body>
</html>
