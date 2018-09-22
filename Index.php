<html>
<head>Crawler demo</head>
<body>
<form method="post">
	<label for="textInput">Web Crawler Demo:</label>
  <input id="myURL" name="myURL" type="url" required>
  <input type="submit" name="submit" value="Crawl">
</form>
</body>
</html>

<?php
if(isset($_POST["submit"]) && !empty($_POST["myURL"])) {
include("getData.php");
$myUrl = $_POST["myUrl"];
echo "Crawling URL: <br /><strong>".$myUrl."</strong><br />";
$content = getData($myUrl);
$exploded_contents = explode('<h1 itemprop="name" class="">', $content);
//title
$title_exploded_content = explode('<span id="titleYear">', $exploded_contents[1]);
$title = $title_exploded_content[0];

echo "title =>". $title ."<br/>";

//rating
$rating_content = explode('itemprop="ratingValue">', $content);
$rating_content = explode('</span>', $rating_content[1]);
$rating = $rating_content[0];

echo "rating->". $rating .'<br/>';

//rating people count
$rating_count = explode('itemprop="ratingCount">', $content);
$rating_content = explode('</span>', $rating_count[1]);
$rating_people_count = $rating_content[0];

echo "rating_people_count ->". $rating_people_count. "<br/>";

//image
$image_find = explode('<div class="poster">', $content);
$image_find = explode('src="', $image_find[1]);
$image_find = explode('"', $image_find[1]);
$image_src = $image_find[0];
echo "<img src='" .$image_src."' />";

file_put_contents($title.'.jpg',file_get_contents($image_src));
}
?>