<?php

	global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;
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

		$response = \Httpful\Request::get('http://' . $_SERVER['SERVER_NAME'] . '/' . $_SERVER['REQUEST_URI'] . 'cms/wp-json/posts?filter[posts_per_page]=-1&filter[order]=desc&filter[orderby]=post_date' . ($is_highlights ? '&filter[category_name]=destaque' : null))->send();
		
		$catId = get_cat_ID($category);

		foreach ($response->body as $key => $post) {

			if (!$is_highlights && !isHighgligthCategory($catId, $post->terms->category)) {

				$image_src = getImage($post->content);

				if ($image_src) {
					array_push($data, array(
							'title' => $post->title,
							'image_src' => getImage($post->content)
						)
					);
				}

			} else if ($is_highlights && isHighgligthCategory($catId, $post->terms->category)) {

				$image_src = getImage($post->content);

				if ($image_src) {
					array_push($data, array(
							'id' => $post->ID,
							'title' => $post->title,
							'image_src' => getImage($post->content)
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

		$posts = __c()->get("posts");
		
		var_dump('$posts dump:');
		var_dump($posts);

		if ($posts == null) {

			$posts = getPhotos($category, false);
			$posts = getPhotos($category, $posts);

			// cache for an hour
			__c()->set("posts", $posts, 6000);

		}

		return $posts;
	}