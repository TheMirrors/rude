<?

namespace rude\fb2;

require_once 'author.php';
require_once 'chapter.php';
require_once 'image.php';
require_once 'publisher.php';
require_once 'translator.php';

class book
{
	public $genre        = '';
	public $title        = '';

	public $author_list  = array();

	public $annotation   = '';
	public $release_date = '';
	public $coverpage    = '';

	public $lang         = '';
	public $lang_src     = '';

	public $translator   = false;

	public $publisher    = false;

	public $chapter_list = false;
	public $image_list   = false;
}