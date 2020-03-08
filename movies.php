
<!--                     Movies Database Listing: Dynamic Page                    -->

<?php 
	//	Preliminary stuff
	$ser = "localhost";
	$user = "root";
	$pass = "";
	$db = "movies";
	$strSQL = "SELECT * FROM movies ORDER BY IF(LEFT(title,2) = 'A ',
            SUBSTRING(title FROM 3),
            IF(LEFT(title,3) = 'An ',
              SUBSTRING(title FROM 4),
              IF(LEFT(title,4) = 'The ',
                 SUBSTRING(title FROM 5),
                 title)))";
	$strTableBlock = "";
	// Connect to the database server and open a database
	$strConnect = mysqli_connect($ser,$user,$pass,$db) or die("Connection Failed");
	echo ("Connection Success");
	// Submit a query
	$strResult = mysqli_query($strConnect,$strSQL);
	// Process the resulting recordset
	while ($strRow = mysqli_fetch_array($strResult)) {
		$strYear = $strRow['Year'];
		$strRuntime = $strRow['Runtime'];
		$strTitle = $strRow['Title'];
		$strDirector = $strRow['Director'];
		$strFormat = $strRow['Format'];
		$strRating = $strRow['Rating'];
		$strGenre = $strRow['Genre'];
		$strRTscore = $strRow['RTscore'];
		$strTableBlock .= "
			<tr>
				<td>$strYear</td><td>$strTitle</td><td>$strDirector</td><td>$strRuntime</td><td>$strFormat</td><td>$strRating</td><td>$strGenre</td><td>$strRTscore</td>
			</tr> \n";
	}
	mysqli_free_result($strResult);
	@mysqli_close($strConnect) or die("Crash");
?>
<! DOCTYPE html>
<html>
    <head>
	    <title>Movies</title>
		<link rel="stylesheet" type="text/css" href="./movies.css">
    </head>
    <body>
		<br />
		<br />
		<center><img src = "./filmreel1.png" alt = "film reel" class="center" width="300" height="200"></center>
		<br />
		<br />
        <h2 align = "center">Catalog Listing of my Movies on DVD/Bluray</h2>
		<!-- Table Below is populated from MySQL movies Database using php code and SQL statement to pull table in alphabetical order by title -->
        <table border="2" align="center">
        	<tr><th>Year</th><th>Title</th><th>Director</th><th>Runtime</th><th>Format</th><th>Rating</th><th>Genre</th><th>RT%</th></tr>
            <?php echo $strTableBlock ?>
        </table>
		<br />
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;<a href = "http://www.imdb.com">IMDB - Internet Movie Database</a>
		<br /><br />
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;<a href = "http://rottentomatoes.com">Rotten Tomatoes</a>
    </body>
</html> 
