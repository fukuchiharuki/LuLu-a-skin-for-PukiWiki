<?php
// lulu.skin.php
//   2017 FUKUCHI Haruki
// License: GPL v2 or (at your option) any later version
//
// A custom skin for PukiWiki

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

// SKIN_DEFAULT_DISABLE_TOPICPATH
//   1 = Show reload URL
//   0 = Show topicpath
if (! defined('SKIN_DEFAULT_DISABLE_TOPICPATH'))
	define('SKIN_DEFAULT_DISABLE_TOPICPATH', 1); // 1, 0

// Show / Hide navigation bar UI at your choice
// NOTE: This is not stop their functionalities!
if (! defined('PKWK_SKIN_SHOW_NAVBAR'))
	define('PKWK_SKIN_SHOW_NAVBAR', 1); // 1, 0

// Show / Hide toolbar UI at your choice
// NOTE: This is not stop their functionalities!
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ($nofollow || ! $is_read)  { ?><meta name="robots" content="NOINDEX,NOFOLLOW" /><?php } ?>
	<title><?php echo $title ?> - <?php echo $page_title ?></title>
	<link rel="SHORTCUT ICON" href="<?php echo $image['favicon'] ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $link['rss'] ?>" />
	<?php echo $head_tag ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.4.0/balloon.min.css" />
	<link rel="stylesheet" href="skin/lulu/lulu.main.css" />
</head>
<body>

	<header>
		<div class="container">
			<h1>
				<?php echo $page ?>
			</h1>
			<p>
				<a href="<?php echo $link['top'] ?>">
					<i class="fa fa-home" aria-hidden="true"></i>
					<?php echo $page_title ?>
				</a>
			</p>
			<?php if ($vars['page']) { ?>
			<a class="button" href="?cmd=edit&amp;page=<?php echo $vars['page'] ?>">
				<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				編集
			</a>
			<?php } ?>
			<a class="button" href="?plugin=newpage">
				<i class="fa fa-plus" aria-hidden="true"></i>
				追加
			</a>
		</div>
	</header>

	<?php if (PKWK_SKIN_SHOW_TOOLBAR) { ?>
	<div id="tool-bar">
		<div class="container">
<?php
// Set toolbar-specific images
$_IMAGE['skin']['reload']   = 'fa fa-refresh';
$_IMAGE['skin']['new']      = 'fa fa-plus';
$_IMAGE['skin']['edit']     = 'fa fa-pencil-square-o';
$_IMAGE['skin']['freeze']   = 'fa fa-lock';
$_IMAGE['skin']['unfreeze'] = 'fa fa-unlock';
$_IMAGE['skin']['diff']     = 'fa fa-columns';
$_IMAGE['skin']['upload']   = 'fa fa-paperclip';
$_IMAGE['skin']['copy']     = 'fa fa-files-o';
$_IMAGE['skin']['rename']   = 'fa fa-eraser';
$_IMAGE['skin']['top']      = 'fa fa-home';
$_IMAGE['skin']['list']     = 'fa fa-list';
$_IMAGE['skin']['search']   = 'fa fa-search';
$_IMAGE['skin']['recent']   = 'fa fa-clock-o';
$_IMAGE['skin']['backup']   = 'fa fa-file-archive-o';
$_IMAGE['skin']['help']     = 'fa fa-question';
$_IMAGE['skin']['rss']      = 'fa fa-rss';
$_IMAGE['skin']['rss10']    = & $_IMAGE['skin']['rss'];
$_IMAGE['skin']['rss20']    = & $_IMAGE['skin']['rss'];
$_IMAGE['skin']['rdf']      = & $_IMAGE['skin']['rss'];
function _toolbar($key, $x = 20, $y = 20){
	$lang  = & $GLOBALS['_LANG']['skin'];
	$link  = & $GLOBALS['_LINK'];
	$image = & $GLOBALS['_IMAGE']['skin'];
	if (! isset($lang[$key]) ) { echo 'LANG NOT FOUND';  return FALSE; }
	if (! isset($link[$key]) ) { echo 'LINK NOT FOUND';  return FALSE; }
	if (! isset($image[$key])) { echo 'IMAGE NOT FOUND'; return FALSE; }

	echo 
		'<a class="tool" href="' . $link[$key] . '" data-balloon="' . $lang[$key] . '">' .
		'<i class="' . $image[$key] . '" aria-hidden="true"></i>' .
		'</a>';
	return TRUE;
}
?>
<?php _toolbar('top') ?>
<?php if ($is_page) { ?>
 | 
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
<?php } ?>
 | 
<?php if ($rw) { ?>
	<?php _toolbar('new') ?>
<?php } ?>
 <?php _toolbar('list')   ?>
 <?php _toolbar('search') ?>
 <?php _toolbar('recent') ?>
 | <?php _toolbar('help') ?>
 | <?php _toolbar('rss10', 36, 14) ?>
		</div><!-- /.container -->
	</div><!-- /#tool-bar -->
	<?php } // PKWK_SKIN_SHOW_TOOLBAR ?>
	<main>
		<div class="container">
			<div class="row">
				<?php if (arg_check('read') && exist_plugin_convert('menu')) { ?>
				<article id="paper-body" class="column column-67">
				<?php } else { ?>
				<article id="paper-body" class="column">
				<?php } ?>
					<div class="paper-meta">
						<?php if ($lastmodified != '') { ?>
						<div class="last-modified">
							<?php echo $lastmodified ?>
						</div>
						<?php } ?>
						<?php if(SKIN_DEFAULT_DISABLE_TOPICPATH) { ?>
						<div class="topic-path">
							<?php require_once(PLUGIN_DIR . 'topicpath.inc.php'); echo plugin_topicpath_inline(); ?>
						</div>
						<?php } ?>
					</div><!-- /.paper-meta -->
					<?php echo $body ?>
				</article><!-- /#paper-body -->
				<?php if ($menu !== FALSE) { ?>
				<div id="menu-bar" class="column column-33">
					<?php echo $menu ?>
				</div><!-- /#menu-bar -->
				<?php } ?>
			</div><!-- /.row -->
			<div class="row">
				<div id="paper-note" class="column">
					<?php if ($notes != '') { ?>
					<div class="note"><?php echo $notes ?></div>
					<?php } ?>
					<?php if ($attaches != '') { ?>
					<div class="attach"><?php echo $attaches ?></div>
					<?php } ?>
				</div><!-- /#paper-note -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</main>

	<footer>
		<div class="container">
			<p>
				Site admin: <a href="<?php echo $modifierlink ?>"><?php echo $modifier ?></a>
				<br />
				<?php echo S_COPYRIGHT ?>.
				Powered by PHP <?php echo PHP_VERSION ?>. HTML convert time: <?php echo elapsedtime() ?> sec.
			</p>
		</div><!-- /.container -->
	</footer>

</body>
</html>
