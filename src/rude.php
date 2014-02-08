<?

require_once 'fb2.php';

class rude
{
	public function debug($variable, $force_var_dump = false)
	{
		if ($force_var_dump)
		{
			?><pre><? var_dump($variable) ?></pre><?

			return;
		}


		?><pre><? print_r($variable) ?></pre><?
	}
}