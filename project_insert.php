<?php include 'project_header.txt'; ?>
<?php 
include_once 'dbteam5.php';
include 'display.php';

//form data
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$title=$_POST['title'];
$dob=$_POST['dob'];
$nationality=$_POST['nationality'];
$gender=$_POST['gender'];
$occupation=$_POST['occupation'];
$achievements=$_POST['achievements'];
$education=$_POST['education'];
$inventions=$_POST['inventions'];
$date = date('Y-m-d');
$default_image_url = 'http://chittagongit.com//images/default-user-icon/default-user-icon-8.jpg';
$redirect_base_url = 'http://pluto.hood.edu/~team5/display_person.php?uid=';


try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$sql_get_person_id = "select max(person_id) as id from person";
	$stmt = $conn->prepare($sql_get_person_id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_NUM);
	$new_person_id = $row[0] + 1;
	
	$sql_get_occupation_id = "select max(occupation_id) as id from occupation";
	$sql_get_achievement_id = "select max(achievement_id) as id from achievement";
	$sql_get_education_id = "select max(education_id) as id from education";
	
	$stmt = $conn->prepare($sql_get_occupation_id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_NUM);
	$new_occupation_id = $row[0] + 1;

	$stmt = $conn->prepare($sql_get_achievement_id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_NUM);
	$new_achievement_id = $row[0] + 1;

	$stmt = $conn->prepare($sql_get_education_id);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_NUM);
	$new_education_id = $row[0] + 1;


	$sql_insert_to_person = "insert into person(person_id, first_name, last_name, title, last_updated_date) values(:new_person_id, :firstName, :lastName, :title, :date)";
	$sql_insert_to_person_details = "insert into person_details(person_id, date_of_birth, nationality, gender) values(:new_person_id, :dob, :nationality, :gender)";
	$sql_insert_to_education = "insert into education(person_id, education_id, highest_level_of_education) values(:new_person_id, :education_id, :education)";
	$sql_insert_to_occupation = "insert into occupation(occupation_id, name_of_occupation, occupation_description, occupation_title, images) values(:occupation_id, :occupation, :occupation, :occupation, :images)";
	$sql_insert_to_has_occupation = "insert into has_occupation(person_id, occupation_id) values(:new_person_id, :occupation_id)";
	$sql_insert_to_achievements = "insert into achievement(achievement_id, name_of_achievement, achievement_description) values(:achievement_id, :achievements, :achievements)";
	$sql_insert_to_has_achievement = "insert into has_achievement(person_id, achievement_id) values(:new_person_id, :achievement_id)";
	$sql_insert_to_invention = "insert into invention(name_of_invention, description) values(:inventions, :inventions)";
	$sql_insert_to_has_invention = "insert into has_invention(person_id, name_of_invention) values(:new_person_id, :inventions)";
	
	$stmt = $conn->prepare($sql_insert_to_person );
	$stmt->bindParam(':new_person_id', $new_person_id);
	$stmt->bindParam(':firstName', $firstName);
	$stmt->bindParam(':lastName', $lastName);
	$stmt->bindParam(':title', $title);
	$stmt->bindParam(':date', $date);

   
	if($stmt->execute()){
	   $stmt = $conn->prepare($sql_insert_to_person_details);
	   $stmt->bindParam(':new_person_id', $new_person_id);
	   $stmt->bindParam(':dob', $dob);
	   $stmt->bindParam(':nationality', $nationality);
	   $stmt->bindParam(':gender', $gender);
	   $stmt->execute();

	   if (!empty($education)) {
	      $stmt = $conn->prepare($sql_insert_to_education);
	      $stmt->bindParam(':new_person_id', $new_person_id);
	      $stmt->bindParam(':education_id', $new_education_id);
	      $stmt->bindParam(':education', $education);
	      $stmt->execute();
	   }

	      $stmt = $conn->prepare($sql_insert_to_occupation);
	      $stmt->bindParam(':occupation_id', $new_occupation_id);
	      $stmt->bindParam(':occupation', $occupation);
	      $stmt->bindParam(':images', $default_image_url);
	      $stmt->execute();
	
	      $stmt = $conn->prepare($sql_insert_to_has_occupation);
	      $stmt->bindParam(':new_person_id', $new_person_id);
	      $stmt->bindParam(':occupation_id', $new_occupation_id);
	      $stmt->execute();
	 

	   if (!empty($achievements)) {
		$stmt = $conn->prepare($sql_insert_to_achievements);
		$stmt->bindParam(':achievement_id', $new_achievement_id);
	        $stmt->bindParam(':achievements', $achievements);
		$stmt->execute();

		$stmt = $conn->prepare($sql_insert_to_has_achievement);
		$stmt->bindParam(':new_person_id', $new_person_id);
	        $stmt->bindParam(':achievement_id', $new_achievement_id);
		$stmt->execute();

           }

	   if (!empty($inventions)) {
		$stmt = $conn->prepare($sql_insert_to_invention);
		$stmt->bindParam(':inventions', $inventions);
		$stmt->execute();

		$stmt = $conn->prepare($sql_insert_to_has_invention);
		$stmt->bindParam(':new_person_id', $new_person_id);
		$stmt->bindParam(':inventions', $inventions);
		$stmt->execute();

           }	
	}
	header('Location:' . $redirect_base_url . $new_person_id);		
}
catch(PDOException $e) {
	die("Could not connect to the database $dbname :" . $e->getMessage());
}

?>
<?php include 'project_footer.txt'; ?>

 