Example Usage:
$config = array( // these values are all optional
	'min_font_em' => 1,
	'max_font_em' => 3,
	'base_url' => '/tag/'
);
$tagger = new Tags($config);
$tagger->cloud($tags); // This returns links with font-sizes ranging from the min and max font em specified.
Example Ouput: <a href="base_url/tag_name" style="font-size: 1.2em;">tag_name</a>
