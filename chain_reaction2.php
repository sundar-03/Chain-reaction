<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#container
	{
		width: 300px;
		margin: 0px auto;
	}
    .input
    {
    	width: 92%;
    	padding: 2%;
    }
	</style>
</head>
<body>
<div id="container">
<form method="post" action="chain_reaction3.php" >
	For standard game no of rows is 6 and no of columns is 10
		<input type="text" name="playera" placeholder="first player name" id="playera" class="input" required><br><br>
	    <input type="text" name="playerb"  placeholder="second player name" id="playerb" class="input" required><br><br>
	    <input type="number" name="rows" placeholder="no of rows" id="rows" class="input" required><br><br>
        <input type="number" name="columns" placeholder="no of columns" id="columns" class="input" required><br><br>
        <input type="submit" name="next" value="next">
	</form>
</div>
</body>
</html>
