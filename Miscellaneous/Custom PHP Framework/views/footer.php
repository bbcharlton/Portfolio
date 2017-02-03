		<footer>
			<p>Site created by Bailey Charlton  |  <span id="contact" data-toggle="modal" data-target="#contactModal">Contact me <span class="glyphicon glyphicon-phone"></span></span></p>
		</footer>

		<?

		function create_image($cap){

			$link = "./assets/images/image1.png";
			unlink($link);

			global $image;

			$image = imagecreatetruecolor(200, 50) or die("Cannot Initialize new GD image stream");

			$background_color = imagecolorallocate($image, 255, 255, 255);

			$text_color = imagecolorallocate($image, 0, 255, 255);

			$line_color = imagecolorallocate($image, 64, 64, 64);

			$pixel_color = imagecolorallocate($image, 0, 0, 255);

			imagefilledrectangle($image, 0, 0, 200, 50, $background_color);

			for ($i = 0; $i < 3; $i++) {
				imageline($image, 0, rand() % 50, 200, rand() % 50, $line_color);
			}

			for ($i = 0; $i < 1000; $i++) {
				imagesetpixel($image, rand() % 200, rand() % 50, $pixel_color);
			}

			$text_color = imagecolorallocate($image, 0, 0, 0);

			ImageString($image, 22, 30, 22, $cap, $text_color);

			$_SESSION["captcha_string"] = $cap;

			imagepng($image, $link);

		}

		create_image($data["cap"]);

		?>

		<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h4 class="modal-title" id="contactModalLabel">Contact me...</h4>
		      </div>
		      <div class="modal-body">
		      	<? echo "<img src='../assets/images/image1.png'>" ?>
		    	<form>
					<input id="form-cap" name="captcha" type="captcha" placeholder="Enter captcha...">
		    		<input id="form-1" name="name" type="text" placeholder="Enter name..."><br>
		    		<input id="form-2" name="email" type="text" placeholder="Enter email..."><br>
		    		<textarea id="form-3" name="message" rows="9" placeholder="Enter message..."></textarea>
		    		<button id="form-4" class="btn">Submit</button>
		    	</form>
		      </div>
		    </div>
		  </div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="../assets/js/main.js"></script>
	</body>
</html>