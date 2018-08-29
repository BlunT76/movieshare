# MOVIESHARE
Movieshare is an exercice with fuelphp

## WHAT WE DO?

```curl https://get.fuelphp.com/oil | sh```

```oil create movieshare```

```php oil g scaffold user username:string password:string email:string role:string```

```php oil g scaffold film title:string year:int director:string actors:string runtime:string plot:text rented:bool poster:string```

```oil refine migrate```



/******************************************************
*******************script to populate *****************
********************** films table ********************
******************************************************/

<?php
    $string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
    $brut = json_decode($string, true);
    $top = $brut["feed"]["entry"];

    $arrayTitle = [];
    foreach ($top as $value) {
        array_push($arrayTitle, $value["im:name"]["label"]);
    }

    
    $arrayFilms = [];
    
    foreach ($arrayTitle as $value) {
        $api = 'http://www.omdbapi.com/?apikey=f75df4c9&t=';
        $arrayFilm = [];
        $titleSplit = (explode(" ", $value));
        foreach ($titleSplit as $word) {
            $api .= $word.'+';
        }

        $json = file_get_contents($api, FILE_USE_INCLUDE_PATH);
        $info = json_decode($json, true);

        $arrayFilm["title"] = (isset($info["Title"]) ? $info["Title"] : null);
        $arrayFilm["director"] = (isset($info["Director"]) ? $info["Director"] : null);
        $arrayFilm["actors"] = (isset($info["Actors"]) ? $info["Actors"] : null);
        $arrayFilm["year"] = (isset($info["Year"]) ? $info["Year"] : null);
        $arrayFilm["runtime"] = (isset($info["Runtime"]) ? $info["Runtime"] : null);
        $arrayFilm["plot"] = (isset($info["Plot"]) ? $info["Plot"] : null);
        $arrayFilm["poster"] = (isset($info["Poster"]) ? $info["Poster"] : null);
        $arrayFilm["rented"] = 0;
        array_push($arrayFilms, $arrayFilm);
    }

        return $arrayFilms;



        /***************************************
        ****************************************
        ****************************************
        ***************************************/