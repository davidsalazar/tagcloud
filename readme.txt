Sample Usage:
$config = array( // these values are all optional
	'min_font_em' => 1,
	'max_font_em' => 3,
	'base_url' => '/tag/'
);
$tagger = new Tags($config);

// First two values for each array must follow this format. [0] = tag count, [1] = tag name
$tags = array(
	array(20, 'star trek'),
	array(10, 'stern'),
	array(1, 'star wars'),
	array(10, 'conan')
);

$tagger->cloud($tags); // This returns links with font-sizes ranging from the min and max font em specified.

Sample Ouput: <a href="base_url/tag_name" style="font-size: 1.2em;">tag_name</a>
