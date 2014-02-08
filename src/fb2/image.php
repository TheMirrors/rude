<?

namespace rude\fb2;

class image
{
	public $image;

	public $id;

	public function decode()
	{
		$this->image = str_replace(PHP_EOL, '', $this->image);
		$this->image = base64_decode($this->image);
	}

	public function save($dir_path)
	{
		file_put_contents($dir_path . $this->id, $this->image);
	}
}