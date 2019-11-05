<!DOCTYPE html><!--Below design is taken from W3 free html page template, which has been modified in order to show oue data-->
<html>
 <head> 
  <title>Most Influential Person</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
</head>
<body class="w3-light-grey">



<!-- PHP code here used for the tables where we have assumed person has one detail, one education detail and occupation under php because we are pulling out image row value, that we used below in left column image position-->
 <?php 
 include_once 'dbteam5.php';
 include_once 'project_header.php';

$person_id = $_GET['person_id'];
 # prepared statement with Unnamed Placeholders
//PHP code here used in order to pull out person_detail row values, that we assumed that one person have one details, so no use of loop.
 $query = "SELECT p.first_name, p.middle_name, p.last_name, p.SSN, p.last_updated_date, p.author, p.website_name, p.URL,
 pd.date_of_birth, pd.zodiac_sign, pd.nationality, pd.gender, pd.place_of_birth, pd.email_id
 FROM person p, person_details pd
 WHERE p.person_id = pd.person_id
 AND p.person_id = $person_id;";
 $stmt = $conn->prepare($query);
 $stmt->bindValue(1, $first_name); # bind by value and assign variables to each place holder	
 $stmt->execute();
 $stmt->setFetchMode(PDO::FETCH_NUM);
 $person = $stmt->fetch();
 $name = $person[0];
 //printf("Person First Name : <input type=\"text\" name=\"first_name\" value=\"%s\"/><br>\n",$person[0]);
 //printf("Person Middle Name: <input type=\"text\" name=\"middle_name\" value=\"%s\"/><br>\n",$person[1]);
 //printf("Person Last Name: <input type=\"text\" name=\"last_name\" value=\"%s\"/><br>",$person[2]);
 //printf("SSN: <input type=\"text\" name=\"SSN\" value=\"%s\"/><br>",$person[3]);
 //printf("Last Updated Date: <input type=\"text\" name=\"Last_updated_date\" value=\"%s\"/><br>",$person[4]);
 //printf("Author: <input type=\"text\" name=\"author\" value=\"%s\"/><br>",$person[5]);
 //printf("Website Name: <input type=\"text\" name=\"website_name\" value=\"%s\"/><br>",$person[6]);
 //printf("Website URL: <input type=\"text\" name=\"URL\" value=\"%s\"/><br>",$person[7]);
 //printf("Date of Birth: <input type=\"text\" name=\"date_of_birth\" value=\"%s\"/><br>",$person[8]);
 //printf("Zodiac: <input type=\"text\" name=\"zodiac_sign\" value=\"%s\"/><br>",$person[9]);
 //printf("Nationality: <input type=\"text\" name=\"nationality\" value=\"%s\"/><br>",$person[10]);
 //printf("Gender: <input type=\"text\" name=\"gender\" value=\"%s\"/><br>",$person[11]);
 //printf("Place of birth: <input type=\"text\" name=\"place_of_birth\" value=\"%s\"/><br>",$person[12]);
 //printf("Email id: <input type=\"text\" name=\"email_id\" value=\"%s\"/><br><br>",$person[13]);


//PHP code here used in order to pull out image row values, that we used below in left column image position//
$query = "SELECT o.name_of_occupation, o.occupation_description, o.start_date, o.images, o.occupation_title
FROM person p, occupation o, has_occupation hc 
WHERE p.person_id = hc.person_id
AND hc.occupation_id = o.occupation_id
AND hc.person_id = $person_id;";
 $stmt = $conn->prepare($query);
 $stmt->bindValue(1, $name_of_occupation); # bind by value and assign variables to each place holder
 $stmt->execute();
 $stmt->setFetchMode(PDO::FETCH_NUM);
 $occupation = $stmt->fetch();


//PHP code here used in order to pull out education row values, that we assumed only the highest level of education deatail, so no use of loop//
$query = "SELECT ed.name_of_institute, ed.highest_level_of_education, ed.from_year, ed.to_year, ed.location
FROM education ed
WHERE ed.person_id = $person_id;";
$stmt = $conn->prepare($query);
$stmt->bindValue(1, $coverage_medium); # bind by value and assign variables to each place holder
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_NUM);
$education = $stmt->fetch();
//printf("Name of institute: <input type=\"text\" name=\"name_of_institute\" value=\"%s\"/><br>\n",$education[0]);
//printf("Highest level of education: <input type=\"text\" name=\"highest_level_of_education\" value=\"%s\"/><br>\n",$education[1]);
//printf("From year: <input type=\"text\" name=\"from_year\" value=\"%s\"/><br>\n",$education[2]);
//printf("To year: <input type=\"text\" name=\"to_year\" value=\"%s\"/><br>\n",$education[3]);
//printf("Location: <input type=\"text\" name=\"location\" value=\"%s\"/><br><br>\n",$education[4]);


?>
<br/>


<!-- Page layout - HTML - Left column -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">
  <!-- The Grid -->
  <div class="w3-row-padding"> 
    <!-- Left Column -->
    <div class="w3-third"> <div class="w3-white w3-text-grey w3-card-4">
<!-- Left Column -  Person Image HTML - Person image and name - image(column) pulled out from above PHP occupation code-->
        <div class="w3-display-container">
          <img src="<?php echo $occupation[3];?>" style="width:100%" alt="Personality Image">
        </div>



<!-- Left Column -  Person Detail HTML Table, as person can only have one himself/herself details. Columns details pulled out from above person_detail table -->
        <div class="w3-container">
          <p><i class="fa fa-asterisk fa-fw  w3-large w3-text-teal"></i>Date of Birth:<?php echo $person[8];?></p>
          <p><i class="fa fa-asterisk fa-fw  w3-large w3-text-teal">Zodiac:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $person[9];?></p>
          <p><i class="fa fa-asterisk fa-fw  w3-large w3-text-teal">Nationality:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $person[10];?></p>
          <p><i class="fa fa-asterisk fa-fw  w3-large w3-text-teal">Gender:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $person[11];?></p>
          <p><i class="fa fa-asterisk fa-fw  w3-large w3-text-teal"></i>Place of Birth:<?php echo $person[12];?></p>
          <p><i class="fa fa-asterisk fa-fw  w3-large w3-text-teal">Email:</i><?php echo $person[13];?></p>
          <p><i class="fa fa-asterisk fa-fw  w3-large w3-text-teal">Author:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $person[5];?></p>
          <p><i class="fa fa-asterisk fa-fw  w3-large w3-text-teal">Website:</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $person[6];?></p>
          <p><i class="fa fa-asterisk fa-fw  w3-large w3-text-teal">URL:</i><?php echo $person[7];?></p>
          <hr>

    

<!-- Left Column - Achievement php Table, using while loop as person can have receieve many achievements -->
    <h5 class="w3-opacity"><b>Achievements</b></h5>
    <?php 
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $conn->query("SELECT name_of_achievement, year_received, achievement_description
	FROM achievement ac, has_achievement hac, person p
	WHERE p.person_id = hac.person_id
	AND hac.achievement_id = ac.achievement_id
	AND hac.person_id = $person_id;");
		//PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $stmt->fetch()) {
     
      echo "Achievement: {$row['name_of_achievement']}";
      echo "<br>";
      echo "<br>";
      echo "Year received: {$row['year_received']}";
      echo "<br>";
      echo "<br>";
      echo "Achievement Description: {$row['achievement_description']}";
      echo "<br>";
      echo "<br>";

}
?>
         <br>
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>




<!--Top Name -  Right Column - Name of Person - person(has only one name) name from above person_detail php table -->
    <div class="w3-twothird"> 
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa w3-xxlarge w3-text-teal">Name :</i><?php echo $person[0];?>&nbsp;<?php echo $person[1];?>&nbsp;<?php echo $person[2];?>
          </div>



<!-- Right Column - Ocupation detail in PHP, while loop as it a person can have many occupations-->
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Occupation</b></h5>
          <?php
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $stmt = $conn->query("SELECT o.name_of_occupation, o.occupation_description, o.start_date, o.images, o.occupation_title
    FROM person p, occupation o, has_occupation hc 
    WHERE p.person_id = hc.person_id
    AND hc.occupation_id = o.occupation_id
    AND hc.person_id = $person_id;");
            //PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  while ($row = $stmt->fetch()) {
     echo "Occupation Title: {$row['occupation_title']}";
     echo "<br>";
     echo "Name of Occupation: {$row['name_of_occupation']}";
     echo "<br>";
     echo "Start Date: {$row['start_date']}";
     echo "<br>";
     echo "Occupation Description: {$row['occupation_description']}";
     echo "<br>";
}
?>
                

<!-- Right Column - Award PHP Table, using while loop as one person can have receieve many awards -->                
        <hr>
      </div>

        <div class="w3-container">
          <h5 class="w3-opacity"><b>Awards</b></h5>                  
           <?php 
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $conn->query("SELECT distinct awards
		from has_award ha, has_achievement hac, person p
		where hac.achievement_id = ha.achievement_id
		and hac.person_id = $person_id;");
		//PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $stmt->fetch()) {
      echo $row['awards'];
      echo "<br>";
}
?>
        <hr>
      </div>



<!-- Right Column - Invention PHP Table, using while loop as one person can have receieve many awards -->  
       <div class="w3-container">
          <h5 class="w3-opacity"><b>Invention</b></h5>
           <?php 
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $conn->query("SELECT distinct inv.name_of_invention, inv.year_of_invention, inv.description
		from has_invention hi, invention inv, person p
		where hi.name_of_invention = inv.name_of_invention
		and hi.person_id = $person_id;");
		//PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $stmt->fetch()) {
     
      echo "Name of Invention: {$row['name_of_invention']}";
      echo "<br>";
      echo "Year of Invention: {$row['year_of_invention']}";
      echo "<br>";
      echo "Invention Description: {$row['description']}";
      echo "<br>";
}
?>
        <hr>
      </div>



<!-- Right Column - has_quote php Table, using while loop as person can have receieve many quotes -->        
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Quotes</b></h5>                  
           <?php 
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $stmt = $conn->query("SELECT distinct quotes
from has_quote hq, has_occupation ho, person p
where ho.occupation_id = hq.occupation_id
and ho.person_id = $person_id;");
    //PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  while ($row = $stmt->fetch()) {
      echo "Person Quotes: {$row['quotes']}";
      echo "<br>";
}
?>
        <hr>
      </div>



<!-- Right Column - Spouse php Table, using while loop as person can have receieve many spouses -->       
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Spouse</b></h5>
          <?php
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $stmt = $conn->query("SELECT s.spouse_name, s.relationship, s.biography
    FROM  spouse s
    WHERE s.person_id = $person_id;");
            //PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  while ($row = $stmt->fetch()) {
     echo "Spouse Name: {$row['spouse_name']}";
     echo "<br>";
     echo "Relationship: {$row['relationship']}";
     echo "<br>";
     echo "Spouse Biography: {$row['biography']}";
     echo "<br>";
}
?>
          <hr>
        </div>



<!-- Right Column - Children php Table, using while loop as person can have receieve many children -->
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Children</b></h5>
          <?php 
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$stmt = $conn->query("SELECT child_name, biography
		FROM  children
		WHERE person_id = $person_id;");
		//PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $stmt->fetch()) {     
      echo "Child name: {$row['child_name']}";
      echo "<br>";
      echo "Child biography: {$row['biography']}";
      echo "<br>";
      
}
?>
           <hr>
         </div>
      


<!-- Right Column - Person Total Wealth php Table, using while loop as person can have receieve many wealth -->   
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Person Net Worth</b></h5>                  
           <?php 
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $stmt = $conn->query("SELECT pw.net_worth, pw.description
    FROM  person_wealth pw
    WHERE pw.person_id = $person_id;");
    //PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  while ($row = $stmt->fetch()) {
      echo "Net-Worth($): {$row['net_worth']}";
      echo "<br>";
      echo "Net-Worth Description: {$row['description']}";
      echo "<br>";
}
?>
        <hr>
      </div>




<!-- Right Column - Person Feature Medium php Table, using while loop as person can have featured in many mediums -->        
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Person Feature Medium</b></h5>                  
           <?php 
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $stmt = $conn->query("SELECT pfm.coverage_medium, pfm.description
    FROM  person_feature_medium pfm
    WHERE pfm.person_id = $person_id;");
    //PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  while ($row = $stmt->fetch()) {
      echo "Name of Coverage Medium: {$row['coverage_medium']}";
      echo "<br>";
      echo "Coverage Medium: {$row['description']}";
      echo "<br>";
}
?>
        <hr>
      </div>



<!-- Right Column - Education HTML Table, In this case we have taken highest level of education hence one institute-->
      <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxxlarge w3-text-teal"></i>Education</h2>       
        <div class="w3-container">
          <h5 class="w3-opacity"><b><?php echo $education[0]; ?></b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-asterisk">Highest level of education:</i><?php echo $education[1]; ?></h6>
          <h6 class="w3-text-teal"><i class="fa fa-asterisk">From year:</i><?php echo $education[2]; ?></h6>
          <h6 class="w3-text-teal"><i class="fa fa-asterisk">To year:</i><?php echo $education[3]; ?></h6>
          <h6 class="w3-text-teal"><i class="fa fa-home">Location:</i><?php echo $education[4]; ?></h6>
          <hr>
        </div>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>
</form>


<br/>
</body>
</html>