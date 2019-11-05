<?php include 'project_header.php'; ?>
	<form action="project_insert.php" method="post">
	    <label>First Name:</label> <input type="text" name="firstName" required size="20"/><br>
	    <label>Last Name: </label> <input type="text" name="lastName" required size="20"/><br>
	    <label>Education: </label><input type="text" name="education" size="20"/><br>
	    <label>Title:</label> <input type="text" name="title" size="50"/><br>
	    <label>Date of Birth: </label><input type="date" name="dob"/><br>
	    <label>Nationality: </label><input type="text" name="nationality" size="20"/><br>
	    <label>Gender: </label><input type="text" name="gender" size="20"/><br>
	    <label>Occupation:</label> <input type="text" name="occupation" size="20"/><br>
	    <label>Achievements:</label> <input type="text" name="achievements" size="20"/><br>
	    <label>Inventions:</label> <input type="text" name="inventions" size="20"/><br>
	    <input type="Submit" value= "Insert"/><input type="Reset"/>
	</form>
 <?php include 'footer.php'; ?>