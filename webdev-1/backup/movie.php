<?php
/*
Ben Wallen
CS 248-003, Ian Edhlund
PHP Page for generating information on the movies listed on the index page.
*/
$movie_name = $_GET["film"];
list($title, $year) = file("$movie_name/info.txt");
//returns array of filenames matching review[x].txt
$review_files = glob("$movie_name/review*.txt");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= $title ?> - Rancid Tomatoes</title>
	<link href="movie.css" type="text/css" rel="stylesheet" />
</head>

<body background="background.png">
	<span><img src="banner.png" alt="Rancid Tomatoes" /></span>
	<table>
		<tr>
			<td colspan=3 class="heading"><?= $title ?> (<?= $year ?>)</td>
		</tr>
		<tr>
			<td><img src="<?=$movie_name ?>/overview.png" alt="general overview" /></td>
			<td colspan=2>

				<dl>

					<?php
					//this loops and reads overview for each movie
					foreach (file("$movie_name/overview.txt") as $info_line) {
						//explode is ued to break the term and definition apart, found by the colon
						list($term, $defn) = explode(":", $info_line);
					?>
						<dt><?= $term ?></dt>
						<dd><?= $defn ?></dd>
					<?php

					}
					?>
				</dl>
			</td>
		</tr>
		<tr>
			<td colspan=3 class="heading">Reviews</td>
		</tr>

		<?php
		//similar concept as above, but for reviews
		foreach ($review_files as $reviewfile) {
			list($review, $rating, $critic, $publication) = file($reviewfile);
			$tomatoimage = strtolower(trim($rating));
		?>


			<tr class="review">
				<th>
					<?= $critic ?><br>
					<?= $publication ?>
				</th>
				<td>
					<img src="<?=$tomatoimage ?>.gif" alt="<?=$tomatoimage ?>" />
				</td>
				<td>
					<?= $review ?>
				</td>
			</tr>
		<?php
		}
		?>
	</table>
</body>

</html>