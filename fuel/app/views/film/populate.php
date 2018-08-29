<?php
$films = require APPPATH . 'tmp/index.php';
foreach ($films as $key => $movie) {
	$movieArr = array(
		'title' => $movie['title'],
		'year' => $movie['year'],
		'director' => $movie['director'],
		'actors' => $movie['actors'],
		'runtime' => $movie['runtime'],
		'plot' => $movie['plot'],
		'rented' => $movie['rented'],
		'poster' => $movie['poster']
	);
	$newMovie = Model_Film::forge($movieArr);
	$newMovie->save();
}
echo "c'est bon j'ai rien cassé!!!";