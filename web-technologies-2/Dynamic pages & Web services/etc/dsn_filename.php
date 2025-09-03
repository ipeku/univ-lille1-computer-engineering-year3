<?php
	const DSN_SIMPLE_NAME = 'webtp_dsn.txt';
	function _dsn_filename():string {
		$filename = preg_replace('#public_html.*#',DSN_SIMPLE_NAME,__FILE__,-1,$count);
		if ($count==1 && is_readable($filename))
			return $filename;
		else
			return __DIR__.'/'.DSN_SIMPLE_NAME;
	}
	define ('DSN_FILENAME', _dsn_filename());
?>
