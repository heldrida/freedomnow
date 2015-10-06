=== ACF to WP REST API ===
Contributors: airesvsg
Tags: acf, api, rest, wp-api, wp-rest-api, json
Requires at least: 3.0.1
Tested up to: 4.3.1
Stable tag: 1.0
License: MIT   
License URI: http://opensource.org/licenses/MIT

Puts ACF data into the WP-REST-API (WP-API)

== Description ==
Puts in answers all fields of ACF.

**Fork me on GitHub**

https://github.com/airesvsg/acf-to-wp-rest-api

**Get ACF data by ID**

* /wp-json/acf/post/ID
* /wp-json/acf/user/ID
* /wp-json/acf/term/ID/TAXONOMY
* /wp-json/acf/comment/ID
* /wp-json/acf/attachment/ID

**Get Options**

* /wp-json/acf/options

**Get Option by Field Name**

* /wp-json/acf/options/FIELD_NAME

**Sample Answer**
`
{
  "ID" : 1,
  "post_title" : "Post 1",
  "..."
  "acf" : {
    "field1" : "value 1",
    "field2" : "value 2"
  }
}
`

== Installation ==
1. Copy the `acf-to-wp-rest-api` folder into your `wp-content/plugins` folder
2. Activate the `ACF to WP REST API` plugin via the plugins admin page