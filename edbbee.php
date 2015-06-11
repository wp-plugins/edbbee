<?php
/*
Plugin Name: edbbee
Plugin URI: https://wordpress.org/plugins/edbbee/
Description: [edbbee server="thyme.dbbee.com" projectkey="29ffffffec482318be67844ae10000008b045c5eb4efe9083ded4e927042fd5b25144d26292e392d5d363130748206aa"] shortcode
Version: 1.0
Author: dbBee.com
Author URI: http://www.dbbee.com/
License: GPLv3
*/


function edbbee_embed_shortcode( $atts, $content = null ) {
	
        $defaults = array(
		'server' => 'thyme.dbbee.com'
	);
        if ($atts['projectkey'] == ''){
           $dbbeecode = 'Required edbbee parameter &quot;projectkey&quot; missing!<br/>Please provide valid dbBee project key from your dbBee dashboard at ';
           $dbbeecode .= '<a href="https://'.$atts['server'].'" target="_blank">'.$atts['server'].'</a>';
           return $dbbeecode;
        }
	foreach ( $defaults as $default => $value ) {
		if ( ! @array_key_exists( $default, $atts ) ) {
			$atts[$default] = $value;
		}
	}
	$dbbeecode = "\n".'<!-- dbBee embed script code plugin v.1.0 https://wordpress.org/plugins/edbbee/ -->'."\n";
	$dbbeecode .= '<!--Start_dbBee_Widget-->'."\n";
        $dbbeecode .= '<script>'."\n";
        $dbbeecode .= '(function(){'."\n";
        $dbbeecode .= 'var dbBeeSrv="'.$atts['server'].'";'."\n";
        $dbbeecode .= 'var dbBeeKey="'.$atts['projectkey'].'";'."\n";
        $dbbeecode .= 'var scriptElement = document.createElement("script");'."\n";
        $dbbeecode .= 'scriptElement.type = "text/javascript";'."\n";
        $dbbeecode .= 'scriptElement.setAttribute("async", true);'."\n";
        $dbbeecode .= 'scriptElement.src = ("https:" == document.location.protocol ? "https://" : "http://") + dbBeeSrv+"/widget/?url="+dbBeeKey;'."\n";
        $dbbeecode .= 'var s = document.currentScript || (function() {'."\n";
        $dbbeecode .= 'var scripts = document.getElementsByTagName(\'script\');'."\n";
        $dbbeecode .= 'return scripts[scripts.length - 1];'."\n";
        $dbbeecode .= '})();'."\n";
        $dbbeecode .= 's.parentNode.insertBefore(scriptElement, s);'."\n";
        $dbbeecode .= '})();'."\n";
        $dbbeecode .= '</script>'."\n";
        $dbbeecode .= '<!--End_dbBee_Widget-->'."\n";
	return $dbbeecode;
}
add_shortcode( 'edbbee', 'edbbee_embed_shortcode' );
function edbbee_plugin_meta( $links, $file ) {
	if ( strpos( $file, 'edbbee.php' ) !== false ) {
		$links = array_merge( $links, array( '<a href="http://www.dbbee.com/" target="_dbBee" title="dbBee Service">dbBee</a>' ) );
		$links = array_merge( $links, array( '<a href="https://thyme.dbbee.com/register/" target="_dbBee" title="Create free account">Register</a>' ) );
		$links = array_merge( $links, array( '<a href="http://www.dbbee.com/plans" target="_dbBee" title="See available plans">Plans</a>' ) );
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'edbbee_plugin_meta', 10, 2 );