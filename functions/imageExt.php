<!-- Checks the image extension and returns it identifier representation as a GD Object -->
<!-- I used GD Graphics Library functions because they get simple data from the image quickly. -->
<!-- Creadits: https://www.php.net/manual/en/book.image.php -->

<?php
function imgExt($image)
{
	if (!file_exists($image)) {
		echo "There was a problem upload the image, Please try again";
		exit(1);
	}

	switch (GetImageSize($image)[2]) {
		case 1:
			return imagecreatefromgif($image);
		case 2:
			return imagecreatefromjpeg($image);
		case 3:
			return imagecreatefrompng($image);
		case 6:
			return imagecreatefrombmp($image);
	}
}
?>