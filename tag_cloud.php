<?php
/*
	Example Usage:
	$options = array( // these values are all optional
		'min_font_em' => 1,
		'max_font_em' => 3,
		'base_url' => '/tag/'
	);
	$tagger = new Tag_Cloud($options);
	echo $tagger->cloud($tags); // This returns links with font-sizes ranging from the min and max font em specified.
	Example Ouput: <a href="base_url/tag_name" style="font-size: 1.2em;">tag_name</a>
	
*/

class Tag_Cloud
{
	private $options = array(
		'min_font_em' => 1,
		'max_font_em' => 3,
		'base_url' => '/tag/'
	);
	
	public function __construct($options = array())
	{
		$this->set_options($options);
	}

	public function set_options($options = array())
	{
		$this->options = $this->arr_overwrite($this->options, $options);
	}

	/*
	First two values for each array must follow this format. [0] = tag count, [1] = tag name
	$tags = array(
		array(20, 'star trek'),
		array(10, 'stern'),
		array(1, 'star wars'),
		array(10, 'conan')
	);
	*/

    public function cloud($tags)
    {
		// grab only unique tag counts
		$tag_counts = array_values(array_unique(array_map('array_shift', $tags)));
		$tag_counts_total = count($tag_counts) - 1;

		// Run a sort on the 2 dimensional array and sort by the 1st value of each array (returns tag counts sorted by popularity)
		sort($tag_counts);

		$tag_sizes = array();
		foreach ($tag_counts as $position => $tag_count)
		{
			$tag_sizes[$tag_count] = $this->get_font_em($position, $tag_counts_total);
		}
		unset($tag_counts, $tag_counts_total);

		$tags_html = array();
		foreach ($tags as $tag)
		{
			list($tag_count, $name) = $tag;
			$tags_html[] = '<a href="' . $this->options['base_url'] . htmlspecialchars($name) . '" style="font-size: ' . $tag_sizes[$tag_count] . 'em;">' . htmlspecialchars($name) . '</a>';
		}

		return implode("\n", $tags_html);

	}

	// calculating font sizes using weight for each distinct tag count
	private function get_font_em($position, $tag_counts_total)
	{
		$weight = $tag_counts_total ? $position / $tag_counts_total : 0;
		$em = ($weight * ($this->options['max_font_em'] - $this->options['min_font_em'])) + $this->options['min_font_em'];

		return round($em, 1);
	}

	private static function arr_overwrite($arr1, $arr2)
	{
		foreach (array_intersect_key($arr2, $arr1) as $k => $v)
		{
			$arr1[$k] = $v;
		}

		return $arr1;
	}

}
