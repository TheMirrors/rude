<?

/* ============================================================ */
/*                           base settings                      */
/* ============================================================ */
define('RUDE_FB2_OUTPUT_DIRECTORY', './tmp/');
define('RUDE_FB2_BOOKS_DIRECTORY',  './books/');
define('RUDE_FB2_BOOKS_EXTENSION',  'fb2');
define('RUDE_FB2_TEXT_EXTENSION',   'txt');


/* ============================================================ */
/*                           replacements                       */
/* ============================================================ */

define('RUDE_FB2_REPLACE_IMG_OLD',                               '<image');
define('RUDE_FB2_REPLACE_IMG_NEW',                               '<img');

define('RUDE_FB2_REPLACE_IMG_PROPERTY_SRC_OLD',                  'l:href');
define('RUDE_FB2_REPLACE_IMG_PROPERTY_SRC_NEW',                  'src');

define('RUDE_FB2_REPLACE_EMPTY_LINE_OLD',                        '<empty-line/>');
define('RUDE_FB2_REPLACE_EMPTY_LINE_NEW',                        '<div class="spacer">');


define('RUDE_FB2_REPLACE_CHAPTER_TITLE_OPEN_TAG_OLD',            '<title>');
define('RUDE_FB2_REPLACE_CHAPTER_TITLE_OPEN_TAG_NEW',            '<h1>');

define('RUDE_FB2_REPLACE_CHAPTER_TITLE_CLOSE_TAG_OLD',           '</title>');
define('RUDE_FB2_REPLACE_CHAPTER_TITLE_CLOSE_TAG_NEW',           '</h1>');

define('RUDE_FB2_REPLACE_CHAPTER_SUBTITLE_OPEN_TAG_OLD',         '<subtitle>');
define('RUDE_FB2_REPLACE_CHAPTER_SUBTITLE_OPEN_TAG_NEW',         '<h2>');

define('RUDE_FB2_REPLACE_CHAPTER_SUBTITLE_CLOSE_TAG_OLD',        '</subtitle>');
define('RUDE_FB2_REPLACE_CHAPTER_SUBTITLE_CLOSE_TAG_NEW',        '</h2>');

define('RUDE_FB2_REPLACE_CHAPTER_CONTAINER_OPEN_TAG_OLD',        '<section>');
define('RUDE_FB2_REPLACE_CHAPTER_CONTAINER_OPEN_TAG_NEW',        '<div class="content">');

define('RUDE_FB2_REPLACE_CHAPTER_CONTAINER_CLOSE_TAG_OLD',       '</section>');
define('RUDE_FB2_REPLACE_CHAPTER_CONTAINER_CLOSE_TAG_NEW',       '</div>');


/* ============================================================ */
/*                        fb2 book structure                    */
/* ============================================================ */
define('RUDE_FB2_TAG_DESCRIPTION',                               'description');
	define('RUDE_FB2_TAG_TITLE_INFO',                            'title-info');
		define('RUDE_FB2_TAG_GENRE',                             'genre');
		define('RUDE_FB2_TAG_AUTHOR',                            'author');
			define('RUDE_FB2_TAG_FIRST_NAME',                    'first-name');
			define('RUDE_FB2_TAG_LAST_NAME',                     'last-name');
		define('RUDE_FB2_TAG_BOOK_TITLE',                        'book-title');
		define('RUDE_FB2_TAG_BOOK_ANNOTATION',                   'annotation');
		define('RUDE_FB2_TAG_BOOK_RELEASE_DATE',                 'date');
		define('RUDE_FB2_TAG_BOOK_COVERPAGE',                    'coverpage');
			define('RUDE_FB2_TAG_BOOK_COVERPAGE_IMAGE',          'image');
		define('RUDE_FB2_TAG_BOOK_LANG',                         'lang');
		define('RUDE_FB2_TAG_BOOK_LANG_SRC',                     'src-lang');
		define('RUDE_FB2_TAG_BOOK_TRANSLATOR',                   'translator');
			define('RUDE_FB2_TAG_BOOK_TRANSLATOR_FIRST_NAME',    'first-name');
			define('RUDE_FB2_TAG_BOOK_TRANSLATOR_MIDDLE_NAME',   'middle-name');
			define('RUDE_FB2_TAG_BOOK_TRANSLATOR_LAST_NAME',     'last-name');
	define('RUDE_FB2_TAG_PUBLISH_INFO',                          'publish-info');
		define('RUDE_FB2_TAG_PUBLISH_INFO_BOOK_NAME',            'book-name');
		define('RUDE_FB2_TAG_PUBLISH_INFO_PUBLISHER',            'publisher');
		define('RUDE_FB2_TAG_PUBLISH_INFO_CITY',                 'city');
		define('RUDE_FB2_TAG_PUBLISH_INFO_YEAR',                 'year');
		define('RUDE_FB2_TAG_PUBLISH_INFO_ISBN',                 'isbn');
	define('RUDE_FB2_TAG_BODY',                                  'body');
		define('RUDE_FB2_TAG_TITLE',                             'title');
		define('RUDE_FB2_TAG_SECTION',                           'section');
	define('RUDE_FB2_TAG_BINARY',                                'binary');
		define('RUDE_FB2_TAG_BINARY_ID',                         'id');