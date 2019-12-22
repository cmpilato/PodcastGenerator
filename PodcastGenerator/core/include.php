<?php
include 'misc/security.php';
include 'misc/configsystem.php';
include 'misc/globs.php';
include 'episodes.php';
include 'feed_generator.php';
include 'buttons.php';
include 'freebox.php';
// Until Podcast Generator 3.0 passwords were stored in MD5, which is inseucre since 2005
// This file is wizard to convert old password to a more secure algorithim
$config = getConfig('config.php');
// Backwards compatibity
include 'backwards.php';
// Load translation
include 'translation.php';
// Check if the hash is MD5
if(strlen($config['userpassword']) == 32) {
    header('Location: core/misc/passwordconverter.php');
    die();
}
// Check if theme is compatible
if (!file_exists($config['theme_path'] . 'theme.json')) {
    // Fallback to defalt theme if incompatible
    updateConfig('config.php', 'theme_path', 'themes/default/');
}

// Do backwards comp
backwards_2_7_to_3_0($config["absoluteurl"]);