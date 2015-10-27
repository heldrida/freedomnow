<?php
	
	global $detect, $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;
	require( 'cms/wp-load.php');
	include('./includes/httpful.phar');
	include('./includes/simple_html_dom.php');

	function getImage($html) {

		// Create DOM from URL or file
		$html = str_get_html($html);

		return $html->find('img') ? $html->find('img')[0]->src : false;
	}

	function getPhotos($category, $posts) {

		$is_highlights = !is_array($posts);
		$data = !$is_highlights ? $posts : [];

		$url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . 'cms/wp-json/posts?filter[posts_per_page]=-1&filter[order]=desc&filter[orderby]=post_date' . ($is_highlights ? '&filter[category_name]=destaque' : null);

		$response = \Httpful\Request::get($url)->send();
		
		$catId = get_cat_ID($category);

		foreach ($response->body as $key => $post) {

			$image_src = getImage($post->content);

			$attachment_id = pn_get_attachment_id_from_url($image_src);
			$image_large_src = wp_get_attachment_image_src($attachment_id, 'large');


			if (!$is_highlights && !isHighgligthCategory($catId, $post->terms->category)) {

				if ($image_src) {
					array_push($data, array(
							'id' => $post->ID,
							'title' => $post->title,
							'image_src' => getImage($post->content),
							'image_large_src' => $image_large_src[0]
						)
					);
				}

			} else if ($is_highlights && isHighgligthCategory($catId, $post->terms->category)) {

				if ($image_src) {
					array_push($data, array(
							'id' => $post->ID,
							'title' => $post->title,
							'image_src' => getImage($post->content),
							'image_large_src' => $image_large_src[0]
						)
					);
				}

			}

		}

		return $data;

	}

	function isHighgligthCategory($catId, $categories) {

		$bool = false;

		foreach ($categories as $key => $value) {

			if ($value->ID === $catId) {
				$bool = true;
			}

		}

		return $bool;

	}

	function getPhotosByHighglithFirst($category) {
		global $detect;
		
		$cache = phpFastCache();

		if (isset($_GET['clear_cache'])) {
			$cache->delete('posts');
		}

		$posts = $cache->get("posts");
		
		if (!$posts || $posts == null) {

			$posts = getPhotos($category, false);
			$posts = getPhotos($category, $posts);

			// cache for an hour
			$cache->set("posts", $posts, 3000);

		}

		return $posts;
	}

	function pn_get_attachment_id_from_url( $attachment_url = '' ) {
	 
		global $wpdb;
		$attachment_id = false;
	 
		// If there is no url, return.
		if ( '' == $attachment_url )
			return;
	 
		// Get the upload directory paths
		$upload_dir_paths = wp_upload_dir();
	 
		// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
		if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
	 
			// If this is the URL of an auto-generated thumbnail, get the URL of the original image
			$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
	 
			// Remove the upload path base directory from the attachment URL
			$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
	 
			// Finally, run a custom database query to get the attachment ID from the modified attachment URL
			$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	 
		}
	 
		return $attachment_id;
	}

	function translation($language, $name) {
	
		global $languagePackage;

		return isset($languagePackage[$language][$name]) && !empty($languagePackage[$language][$name]) ? $languagePackage[$language][$name] : '[Translation failing!]';

	}