<?

namespace rude\wp;

require_once 'defines.php';

class item
{
	public $id                = 0;
	public $title             = '';
	public $link              = '';

	public $pub_date          = '';
	public $post_date         = '';
	public $post_date_gmt     = '';

	public $post_name         = '';

	public $content           = '';

	public $category_nicename = '';
	public $category_name     = '';

	public $site_url          = RUDE_WP_SITE_URL;

	public $post_status       = RUDE_WP_SITE_POST_STATUS;
	public $post_type         = RUDE_WP_SITE_POST_TYPE;

	public $ping_status       = RUDE_WP_SITE_PING_STATUS;
	public $comment_status    = RUDE_WP_SITE_COMMENT_STATUS;

	public $user              = RUDE_WP_SITE_AUTHOR;


	public function save()
	{
		return '
		<item>
			<title>' . $this->title . '</title>
			<link>' . $this->link . '</link>
			<pubDate>' . $this->pub_date . '</pubDate>
			<dc:creator><![CDATA[' . $this->user . ']]></dc:creator>
			<guid isPermaLink="false">' . $this->site_url . '/?p=' . $this->id . '</guid>
			<description></description>
			<content:encoded><![CDATA[' . $this->content . ']]></content:encoded>
			<excerpt:encoded><![CDATA[]]></excerpt:encoded>
			<wp:post_id>' . $this->id . '</wp:post_id>
			<wp:post_date>' . $this->post_date . '</wp:post_date>
			<wp:post_date_gmt>' . $this->post_date_gmt . '</wp:post_date_gmt>
			<wp:comment_status>' . $this->comment_status . '</wp:comment_status>
			<wp:ping_status>' . $this->ping_status . '</wp:ping_status>
			<wp:post_name>' . $this->post_name . '</wp:post_name>
			<wp:status>' . $this->post_status . '</wp:status>
			<wp:post_parent>0</wp:post_parent>
			<wp:menu_order>0</wp:menu_order>
			<wp:post_type>' . $this->post_type . '</wp:post_type>
			<wp:post_password></wp:post_password>
			<wp:is_sticky>0</wp:is_sticky>
			<category domain="category" nicename="' . $this->category_nicename . '><![CDATA[' . $this->category_name . ']]></category>
			<wp:postmeta>
				<wp:meta_key>_edit_last</wp:meta_key>
				<wp:meta_value><![CDATA[1]]></wp:meta_value>
			</wp:postmeta>
		</item>';
	}
}