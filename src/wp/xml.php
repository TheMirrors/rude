<?

namespace rude\wp;

require_once 'item.php';

class xml
{
	private $item_list = array();


	private function include_header()
	{
		return '<?xml version="1.0" encoding="UTF-8" ?>

		<rss version="2.0"
			 xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"
			 xmlns:content="http://purl.org/rss/1.0/modules/content/"
			 xmlns:wfw="http://wellformedweb.org/CommentAPI/"
			 xmlns:dc="http://purl.org/dc/elements/1.1/"
			 xmlns:wp="http://wordpress.org/export/1.2/"
			>

			<channel>
				<title>' . RUDE_WP_SITE_TITLE . '</title>
				<link>' . RUDE_WP_SITE_URL . '</link>
				<description>' . RUDE_WP_SITE_DESCRIPTION . '</description>
				<pubDate>' . RUDE_WP_SITE_PUB_DATE . '</pubDate>
				<language>' . RUDE_WP_SITE_LANG . '</language>
				<wp:wxr_version>' . RUDE_WP_EXPORT_VERSION . '</wp:wxr_version>
				<wp:base_site_url>' . RUDE_WP_BASE_SITE_URL . '</wp:base_site_url>
				<wp:base_blog_url>' . RUDE_WP_BASE_BLOG_URL . '</wp:base_blog_url>

				<wp:author><wp:author_id>1</wp:author_id><wp:author_login>root</wp:author_login><wp:author_email>thisnicknamewasfree@gmail.com</wp:author_email><wp:author_display_name><![CDATA[root]]></wp:author_display_name><wp:author_first_name><![CDATA[]]></wp:author_first_name><wp:author_last_name><![CDATA[]]></wp:author_last_name></wp:author>

				<wp:category><wp:term_id>1</wp:term_id><wp:category_nicename>%d0%b1%d0%b5%d0%b7-%d1%80%d1%83%d0%b1%d1%80%d0%b8%d0%ba%d0%b8</wp:category_nicename><wp:category_parent></wp:category_parent><wp:cat_name><![CDATA[Без рубрики]]></wp:cat_name></wp:category>

				<generator><?= RUDE_WP_GENERATOR ?></generator>';
	}


	private function include_body()
	{
		$body = '';

		foreach ($this->item_list as $item) /* @var $item item */
		{
			$body .= $item->save();
		}

		return $body;
	}

	private function include_footer()
	{
		return '</channel></rss>';
	}



	private function save($file_path)
	{
		$data  = $this->include_header();
		$data .= $this->include_body();
		$data .= $this->include_footer();

		file_put_contents($file_path, $data);
	}
}