<div class="container">
	<div class="starter-template">
		<p><a href="/About/showAddForm">Add New</a></p>
		<?php

			foreach ($data as $fruit) {
				echo $fruit["name"] . " <a href='/About/showEditForm/" . $fruit['id'] . "'>EDIT</a> | <a href='/About/deleteAction/" . $fruit['id'] . "'>DELETE</a>" . "<br>";
			}

		?>

	</div>
</div>