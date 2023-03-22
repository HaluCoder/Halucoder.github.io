<?php
$db = new mysqli('localhost', 'root', '', 'fms');
if($db->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT reg_id,region
FROM regions WHERE reg_id = ?";

$stmt = $db->prepare($sql);
$stmt->bind_param("s", $_GET['p']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($reg_id, $region);
$stmt->fetch();
$stmt->close();

echo "
<select class='form-control' name='district' onchange='showCouncils(this.value)'>";
$sql1= "select * from districts 
WHERE reg_id='$reg_id'
";
	
$result = $db->query($sql1);	
if ($result->num_rows >=0)
{
echo"<option value=''>select district</option>";

	while($row = $result->fetch_assoc()) 
		{
			
$dist_id =$row["id"];
$district =$row["district"];
$reg_id =$row["reg_id"];
	
echo"<option value='$dist_id'>".$dist_id.".".$district."</option>";
		}
}
echo "</select>";

?>
