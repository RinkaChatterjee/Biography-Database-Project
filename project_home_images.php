<?php 
 include_once 'dbteam5.php';
 include 'project_header.php';
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $conn->query("SELECT distinct CONCAT_WS('',first_name,' ',' ',middle_name,' ',last_name) AS full_name,images,p.person_id as person_id from occupation o, has_occupation ho, person p where p.person_id = ho.person_id and o.occupation_id = ho.occupation_id;");
		//PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $stmt->fetch()) {
		printf("<a href=\"http://pluto.hood.edu/~team5/display_person.php?person_id=%s\">\n",$row['person_id']);
		printf("<h1>%s</h1></a>\n",$row['full_name']);
		printf("<a><img src=\"%s\" width='350' height='350'></a></br>\n",$row['images']);
	}
?>