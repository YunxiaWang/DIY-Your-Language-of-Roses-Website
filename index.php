<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<title>Language of Roses</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
	<header>
    	<h1 id="header_title">DIY Your Language of Roses</h1>
	</header>

	<div class="content">
	<br>
<!--main table contain information--> 
	<div id= "table"> 
		<table id="list">
  			<tr>
    			<th>Name</th>
    			<th>Color</th> 
    			<th>Count</th>
    			<th>Meaning</th>
  			</tr> 			
  	
    <!--read file and search, present the search result in the main table-->
    <?php
  	//when user click search
  		if ((isset($_GET["searchsubmit"])) && (!empty($_GET['sname']) || $_GET["scolor"] != "blank" || !empty($_GET['scount']))) {   
        $sname = $_GET["sname"];
        $sname = "/$sname+/i";
    		$scolor = $_GET["scolor"];
        $scolor = "/$scolor+/i";
    		$scount = $_GET["scount"];
        $scount = "/$scount+/i";
    		$delimiter = '|'; 
	   		$files = fopen("data.txt", "a+");
  			if (!$files) {
      			die("Data file open error!");
  			}
  			$lines = file("data.txt");
        asort($lines); //sort entries
  			foreach ($lines as $line) {
  				if (preg_match($sname, $line) || preg_match($scolor, $line) || preg_match($scount, $line)) { //"OR" search			
    				$info = explode($delimiter, trim($line));
    				print "<tr>
            		<td>$info[0]</td>
            		<td>$info[1]</td> 
            		<td>$info[2]</td>
            		<td>$info[3]</td> </tr>"; 
            	}    
  			}	
    		fclose($files);
  		} else {
  			//read all the file to the table when not searching	
  			$delimiter = '|'; 
  			$filer = fopen("data.txt", "a+");
  			if (!$filer) {
      			die("Data file open error!");
  			}
  			$lines = file("data.txt");
        asort($lines); //sort entries
  			foreach ($lines as $line) {
    		$info = explode($delimiter, trim($line));
    		print "<tr>
            	<td>$info[0]</td>
            	<td>$info[1]</td> 
            	<td>$info[2]</td>
            	<td>$info[3]</td> </tr>";     
  			}
  			fclose($filer);
  		}			
	?>	 		
		</table>
	</div>


<!--php form to add entries, use sticky forms and input checking-->
	<?php include "editform.php"; ?>
	<div id="add_entry">
		<h2>Create your own language of roses</h2><span class="error">* required field</span>
		<form id="sticky_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">			
			<label>Name</label>
			<input 
				type="text" name="name" 
				value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>"/>
			<span class="error">* <?php echo "$nameErr";?></span><br>
			<label>Color</label>
			<select name="color">
				<option value="blank">Select</option>
  				<option value="Red">Red</option>
  				<option value="White">White</option>
  				<option value="Pink">Pink</option>
  				<option value="Yellow">Yellow</option>
  				<option value="Blue">Blue</option>
  				<option value="Orange">Orange</option>
  				<option value="Lavender">Lavender</option>
  				<option value="Black">Black</option>
			</select> <span class="error">* <?php echo "$colorErr";?></span><br>
			<label>Count</label>
			<input 
				type="number" name="count"
				value="<?php if(isset($_POST['count'])) echo $_POST['count']; ?>"/>
			<span class="error">* <?php echo "$countErr";?></span><br>
			<label>Meaning</label><br>
			<textarea 
				name="meaning" rows="4"><?php if(isset($_POST['meaning'])) echo $_POST['meaning']; ?></textarea>
			<span class="error">* <?php echo "$meaningErr";?></span><br>
			<input class="submit" type="submit" name="addsubmit" value="Add!">
			<span class="error"><?php echo $addsubmitInfo;?></span><br>
		</form>
	</div>
	<br>

<!--add entry to data and refresh the page to add to table-->
	<?php
		if ((!empty($_POST["addsubmit"])) && $nameCheck === true && $colorCheck === true && $countCheck === true && $meaningCheck === true) {   
    		$addname = $name;
    		$addcolor = $color;
    		$addcount = $count;
    		$addmeaning = $meaning;
    		$delimiter = '|'; 
  			$filew = fopen("data.txt", "a+");
  			if (!$filew) {
      			die("Data file open error!");
  			}	   
    		fputs($filew, "$addname$delimiter$addcolor$delimiter$addcount$delimiter$addmeaning\n");
    		fclose($filew);
    		echo "<meta http-equiv='refresh' content='0'>";
    		echo '<script language="javascript"> alert("Add entry successfully!"); </script>';
  		}
	?>

<!--form for search, can search on 1-3 conditions-->
	<div id="search">
		<h2>Search the language of roses</h2><br>
		<form id="search_form" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">			
			<label>Name</label>
			<input type="text" name="sname" /><br>
			<label>Color</label>
			<select name="scolor">
				<option value="blank">Select</option>
  				<option value="Red">Red</option>
  				<option value="White">White</option>
  				<option value="Pink">Pink</option>
  				<option value="Yellow">Yellow</option>
  				<option value="Blue">Blue</option>
  				<option value="Orange">Orange</option>
  				<option value="Lavender">Lavender</option>
  				<option value="Black">Black</option>
			</select><br>
			<label>Count</label>
			<input type="number" name="scount"/><br>
			<input class="submit" type="submit" name="searchsubmit" value="Search!"><br>
		</form>
	</div>
	<br>

	</div>

	<footer>
		&copy; Yunxia Wang, Feb. 2015<br/>
		Background image source  <a href="http://weddingpetals.com/wp-content/uploads/2012/10/Wedding-Petals-p-Copy.jpg">http://weddingpetals.com/wp-content/uploads/2012/10/Wedding-Petals-p-Copy.jpg</a>		
	</footer>
	
</body>
</html>