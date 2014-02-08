<?

namespace rude;

class filesystem
{
	public function read($file_path)
	{
		if (file_exists($file_path))
		{
			return file_get_contents($file_path);
		}

		return false;
	}

	public function scandir($path, $extension)
	{
		$objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);


		$file_list = array();

		foreach ($objects as $name => $object)
		{
			$file_parts = pathinfo($name);

			if ($file_parts['extension'] == $extension)
			{
				$file_list[] = $name;
			}
		}

		return $file_list;
	}
}