<?php
$db = new mysqli('localhost', 'root', '', 'fms');
if($db->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT id,district
FROM districts WHERE id = ?";

$stmt = $db->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $district);
$stmt->fetch();
$stmt->close();

echo "
<select class='form-control' name='council'>";
$sql1= "select * from councils 
WHERE dist_id='$id'
";
	
$result = $db->query($sql1);	
if ($result->num_rows >=0)
{
echo"<option value=''> Select council</option>";
	while($row = $result->fetch_assoc()) 
		{
$id =$row["id"];
$council =$row["council"];
$dist_id =$row["dist_id"];
	
echo"<option value='$id'>".$id.".".$council."</option>";
		}
}

?>