<!DOCTYPE html>
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
</head>
<body>
<form action="MultilineFormSubmit.php" method="post">
<textarea id="message" rows="20" name="answer_text" wrap="hard" value=""><?php
if (isset($_REQUEST["submit"]))
{
	echo $_REQUEST["answer_text"];
}?>
</textarea><br>

<?php
if (isset($_REQUEST["submit"]))
{
	echo $_REQUEST["answer_text"];
}?>

<br>
<button type="submit" name="submit" >Submit</button>
</form>

</body>
</html>

