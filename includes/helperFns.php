<?php

	include('./includes/httpful.phar');
	include('./includes/simple_html_dom.php');

	function getImage($html) {

		// Create DOM from URL or file
		$html = str_get_html($html);

		return $html->find('img') ? $html->find('img')[0]->src : false;
	}

	function getPhotos() {

		$data = [];

		$response = \Httpful\Request::get('http://' . $_SERVER['SERVER_NAME'] . '/' . 'cms/wp-json/posts?filter[posts_per_page]=-1&filter[order]=desc&filter[orderby]=post_date')->send();

		foreach ($response->body as $key => $post) {

			$image_src = getImage($post->content);

			if ($image_src) {
				array_push($data, array(
						'title' => $post->title,
						'image_src' => getImage($post->content)
					)
				);
			}

		}

		return $data;

	}
