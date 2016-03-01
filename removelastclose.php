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
			$content = preg_replace("/\?>\s*$/","",$content);
			file_put_contents($dir.$file, $content);
			echo 'Saved '.$dir.$file."<br>\n";
			
		}

	}
}


?>
