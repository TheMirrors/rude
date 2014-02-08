<?

namespace rude;

require_once 'fb2/defines.php';
require_once 'fb2/book.php';

require_once 'filesystem.php';
require_once 'speedtest.php';


class fb2
{
	private $filesystem; // class `filesystem` from rude\filesystem

	private $content;    // an identical copy of the fb2 book
	private $crawler;    // parsed fb2 book via SimpleXMLElement (libxml2 required)
	private $book;       // object structed from the $crawler parsed items

	private $speedtest;  // for debug reasons


	/* ===================== */
	/* Base class constuctor */
	/* ===================== */
	public function __construct()
	{
		$this->filesystem = new filesystem();
		$this->speedtest  = new speedtest();
	}


	/* ===================================== */
	/* Helps to scan directory for fb2 files */
	/* ===================================== */
	public function scan($dir_path = RUDE_FB2_BOOKS_DIRECTORY, $extension = RUDE_FB2_BOOKS_EXTENSION)
	{
		$file_list = $this->filesystem->scandir($dir_path, $extension);

		return $file_list;
	}


	/* ========================== */
	/* Helps to read the fb2 file */
	/* ========================== */
	public function read($file_path)
	{
		$this->content = $this->filesystem->read($file_path);

		$this->content = str_replace(RUDE_FB2_REPLACE_IMG_PROPERTY_SRC_OLD, RUDE_FB2_REPLACE_IMG_PROPERTY_SRC_NEW, $this->content); // SimpleXML unable to work with `l:href`

		$this->crawler = new \SimpleXMLElement($this->content);
	}


	/* ================================= */
	/* Returns a copy of the origin file */
	/* ================================= */
	public function content()
	{
		return $this->content;
	}


	/* ================================= */
	/* Complex .fb2 parse initialization */
	/* ================================= */
	public function parse()
	{
		$this->book = new fb2\book();

		$this->book->genre        = $this->get_genre();
		$this->book->title        = $this->get_title();

		$this->book->author_list  = $this->get_author_list();

		$this->book->annotation   = $this->get_annotation();
		$this->book->release_date = $this->get_release_date();
		$this->book->coverpage    = $this->get_coverpage();

		$this->book->lang         = $this->get_lang();
		$this->book->lang_src     = $this->get_lang_src();

		$this->book->translator   = $this->get_translator();

		$this->book->publisher    = $this->get_publisher();

		$this->book->chapter_list = $this->get_chapter_list();

		$this->book->image_list   = $this->get_image_list();

		return $this->book;
	}


	/* =================================== */
	/* Helps to parse names of the authors */
	/* =================================== */
	public function get_author_list()
	{
		$author_list = $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO};


		$result_list = array();

		foreach ($author_list->author as $author)
		{
			$result = new fb2\author();

			$result->firstname = (string) $author->{RUDE_FB2_TAG_FIRST_NAME};
			$result->lastname  = (string) $author->{RUDE_FB2_TAG_LAST_NAME};

			$result_list[] = $result;
		}

		return $result_list;
	}


	/* ==================== */
	/* Helps to parse genre */
	/* ==================== */
	public function get_genre()
	{
		return (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO}->{RUDE_FB2_TAG_GENRE};
	}


	/* ==================== */
	/* Helps to parse title */
	/* ==================== */
	public function get_title()
	{
		return (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO}->{RUDE_FB2_TAG_BOOK_TITLE};
	}


	/* ========================= */
	/* Helps to parse annotation */
	/* ========================= */
	public function get_annotation()
	{
		return (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO}->{RUDE_FB2_TAG_BOOK_ANNOTATION}->asXML();
	}


	/* =========================== */
	/* Helps to parse release date */
	/* =========================== */
	public function get_release_date()
	{
		return (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO}->{RUDE_FB2_TAG_BOOK_RELEASE_DATE};
	}


	/* ======================== */
	/* Helps to parse coverpage */
	/* ======================== */
	public function get_coverpage()
	{
		return (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO}->{RUDE_FB2_TAG_BOOK_COVERPAGE}->{RUDE_FB2_TAG_BOOK_COVERPAGE_IMAGE}->attributes()[RUDE_FB2_REPLACE_IMG_PROPERTY_SRC_NEW];
	}


	/* ======================= */
	/* Helps to parse language */
	/* ======================= */
	public function get_lang()
	{
		return (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO}->{RUDE_FB2_TAG_BOOK_LANG};
	}


	/* ============================== */
	/* Helps to parse source language */
	/* ============================== */
	public function get_lang_src()
	{
		return (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO}->{RUDE_FB2_TAG_BOOK_LANG_SRC};
	}


	/* ========================= */
	/* Helps to parse translator */
	/* ========================= */
	public function get_translator()
	{
		$translator = new fb2\translator();

		$translator->first_name  = (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO}->{RUDE_FB2_TAG_BOOK_TRANSLATOR}->{RUDE_FB2_TAG_BOOK_TRANSLATOR_FIRST_NAME};
		$translator->middle_name = (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO}->{RUDE_FB2_TAG_BOOK_TRANSLATOR}->{RUDE_FB2_TAG_BOOK_TRANSLATOR_MIDDLE_NAME};
		$translator->last_name   = (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_TITLE_INFO}->{RUDE_FB2_TAG_BOOK_TRANSLATOR}->{RUDE_FB2_TAG_BOOK_TRANSLATOR_LAST_NAME};

		return $translator;
	}


	/* ============================= */
	/* Helps to parse publisher info */
	/* ============================= */
	public function get_publisher()
	{
		$publisher = new fb2\publisher();

		$publisher->book_name      = (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_PUBLISH_INFO}->{RUDE_FB2_TAG_PUBLISH_INFO_BOOK_NAME};
		$publisher->publisher_name = (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_PUBLISH_INFO}->{RUDE_FB2_TAG_PUBLISH_INFO_PUBLISHER};
		$publisher->city           = (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_PUBLISH_INFO}->{RUDE_FB2_TAG_PUBLISH_INFO_CITY};

		$publisher->year           = (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_PUBLISH_INFO}->{RUDE_FB2_TAG_PUBLISH_INFO_YEAR};
		$publisher->isbn           = (string) $this->crawler->{RUDE_FB2_TAG_DESCRIPTION}->{RUDE_FB2_TAG_PUBLISH_INFO}->{RUDE_FB2_TAG_PUBLISH_INFO_ISBN};


		return $publisher;
	}


	/* ======================= */
	/* Helps to parse chapters */
	/* ======================= */
	public function get_chapter_list()
	{
		$body_list = $this->crawler->{RUDE_FB2_TAG_BODY}->{RUDE_FB2_TAG_SECTION};
		$i = 1;

		$result_list = array();



		foreach ($body_list as $chapter_list)
		{
			?><pre><? print_r($chapter_list) ?></pre><?

			if (!isset($chapter_list->{RUDE_FB2_TAG_SECTION}))
			{
				$result = new fb2\chapter();

				$result->content = (string) $chapter_list->asXML();
				$result->to_html();
				$result->save(RUDE_FB2_OUTPUT_DIRECTORY, 'chapter_' . $i);

				$i++;

				$result_list[] = $result;

				continue;
			}

			foreach ($chapter_list as $chapter)
			{
				$result = new fb2\chapter();

				$result->content = (string) $chapter->asXML();
				$result->to_html();
				$result->save(RUDE_FB2_OUTPUT_DIRECTORY, 'chapter_' . $i);

				$i++;

				$result_list[] = $result;
			}
		}

		return $result_list;
	}


	/* ===================== */
	/* Helps to parse images */
	/* ===================== */
	public function get_image_list()
	{
		$image_list = $this->crawler->{RUDE_FB2_TAG_BINARY};


		$result_list = array();

		foreach ($image_list as $image)
		{
			$result = new fb2\image();

			$result->image = (string) $image;
			$result->id    = (string) $image->attributes()[RUDE_FB2_TAG_BINARY_ID];
			$result->decode();

			$result->save(RUDE_FB2_OUTPUT_DIRECTORY);


			$result_list[] = $result;
		}

		return $result_list;
	}
}