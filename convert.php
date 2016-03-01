<?

$dir='convert/';

parseDir($dir);


function parseDir($dir)
{
	foreach(scandir($dir) as $file)
	{
		if(trim($file,'./')=="") continue;

		if(is_dir($dir.$file))
		{
			parseDir($dir.$file.'/');
		} else {
		
			$content = file_get_contents($dir.$file);
			$tokens = token_get_all($content);
			$output = '';

			foreach($tokens as $token) {
			 if(is_array($token)) {
			  list($index, $code, $line) = $token;
			  switch($index) {
			   /*case T_OPEN_TAG_WITH_ECHO:
				$output .= '<?php echo ';
				break;*/
			   case T_OPEN_TAG:
				$output .= '<?php ';
				break;
			   default:
				$output .= $code;
				break;
			  }

			 }
			 else {
			  $output .= $token;
			 }
			}
			file_put_contents($dir.$file, $output);
			echo 'Saved '.$dir.$file."<br>\n";
			
		}

	}
}


?>
