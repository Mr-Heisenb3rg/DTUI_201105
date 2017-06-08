<?php
class Minify_CSS {
public static function minify($css, $options = array()) 
{require_once 'Minify/CSS/Compressor.php';
if (isset($options['preserveComments']) 
&& !$options['preserveComments']) {
$css = Minify_CSS_Compressor::process($css, $options);
} else {
require_once 'Minify/CommentPreserver.php';
$css = Minify_CommentPreserver::process(
$css ,array('Minify_CSS_Compressor', 'process') ,array($options)
); }
if (! isset($options['currentDir']) && ! isset($options['prependRelativePath'])) {return $css;}
require_once 'Minify/CSS/UriRewriter.php';
if (isset($options['currentDir'])) {return Minify_CSS_UriRewriter::rewrite(
$css ,$options['currentDir'] ,isset($options['docRoot']) ? $options['docRoot'] : $_SERVER['DOCUMENT_ROOT'] ,isset($options['symlinks']) ? $options['symlinks'] : array());  
} else {return Minify_CSS_UriRewriter::prepend(
$css ,$options['prependRelativePath']
);
}
}
}
