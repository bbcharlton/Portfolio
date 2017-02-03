<div class="container">
	<div class="starter-template">
		<?php

			$data = json_decode($data, true);

			foreach ($data['items'] as $item) {
				echo $item['title'] . "<br>";
			}

		?>
	</div>
</div>