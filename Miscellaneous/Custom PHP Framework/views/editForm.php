<div class="container">
	<div class="starter-template">
		<h1>Edit fruit</h1>
		<form action="/About/editAction/<?= $data[0]['id'] ?>" method="POST">
			<input type='text' name='name' placeholder='<?= $data[0]['name'] ?>'>
			<button>Edit</button>
		</form>

	</div>
</div>