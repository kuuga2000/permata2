<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pix_social {

	private $CI;
	public $url = '';
	public $attr = '';
	public $title = '';

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->model('meta_model');
	}

	public function facebook($url, $attr)
	{
		$val = '<div id="fb-root"></div>';
		$val .= "<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = '//connect.facebook.net/en_US/all.js#xfbml=1';
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>";
		$val .= '<div class="fb-like" data-href="'.$url.'" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" '.$attr.'></div>';

		return $val;
	}

	public function tweet($url, $title, $attr)
	{
		$val = '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
		$val .= '<iframe allowtransparency="true" frameborder="0" scrolling="no" src="https://platform.twitter.com/widgets/tweet_button.html?url='.$url.'" '.$attr.'&text='.$title.'"></iframe>';

		return $val;
	}

	public function youtube($url)
	{
		$feedURL = 'http://gdata.youtube.com/feeds/api/videos/' . $url;
		$entry = simplexml_load_file($feedURL);

		$obj= new stdClass;

		// get nodes in media: namespace for media information
		$media = $entry->children('http://search.yahoo.com/mrss/');
		$obj->title = $media->group->title;
		$obj->description = $media->group->description;

		// get video player URL
		$attrs = $media->group->player->attributes();
		$obj->watchURL = $attrs['url']; 

		// get video thumbnail
		$attrs = $media->group->thumbnail[0]->attributes();
		$obj->thumbnailURL = $attrs['url']; 

		// get <yt:duration> node for video length
		$yt = $media->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->duration->attributes();
		$obj->length = $attrs['seconds']; 

		// get <yt:stats> node for viewer statistics
		$yt = $entry->children('http://gdata.youtube.com/schemas/2007');
		$attrs = $yt->statistics->attributes();
		$obj->viewCount = $attrs['viewCount']; 

		// get <gd:rating> node for video ratings
		$gd = $entry->children('http://schemas.google.com/g/2005'); 
		if ($gd->rating) { 
			$attrs = $gd->rating->attributes();
			$obj->rating = $attrs['average']; 
		} else {
			$obj->rating = 0;         
		}

		// get <gd:comments> node for video comments
		$gd = $entry->children('http://schemas.google.com/g/2005');
		if ($gd->comments->feedLink) { 
			$attrs = $gd->comments->feedLink->attributes();
			$obj->commentsURL = $attrs['href']; 
			$obj->commentsCount = $attrs['countHint']; 
		}

		// get feed URL for video responses
		$entry->registerXPathNamespace('feed', 'http://www.w3.org/2005/Atom');
		$nodeset = $entry->xpath("feed:link[@rel='http://gdata.youtube.com/schemas/2007#video.responses']"); 
		if (count($nodeset) > 0) {
			$obj->responsesURL = $nodeset[0]['href'];      
		}

		// get feed URL for related videos
		$entry->registerXPathNamespace('feed', 'http://www.w3.org/2005/Atom');
		$nodeset = $entry->xpath("feed:link[@rel='http://gdata.youtube.com/schemas/2007#video.related']");
		if (count($nodeset) > 0) {
			$obj->relatedURL = $nodeset[0]['href'];
		}

		// return object to caller  
		return $obj;
	}
}
