<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавление");

?>



<div class="container mt-3">
	<h2>Добавление товара в каталог</h2>
	<form id="add-product-form" enctype="multipart/form-data">
		<div class="form-group">
			<label for="product-name">Наименование:</label>
			<input type="text" class="form-control" id="product-name" name="name">
		</div>
		<div class="form-group">
			<label for="product-price">Цена:</label>
			<input type="text" class="form-control" id="product-price" name="price">
		</div>
		<div class="form-group">
			<label for="product-photo">Фотография:</label>
			<input type="file" class="form-control" id="product-photo" name="photo">
		</div>
		<button type="submit" class="btn btn-primary">Добавить товар</button>
	</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
	jQuery(document).ready(function($) {
       
		$('#add-product-form').submit(function(e) {
			e.preventDefault();
			var form = $(this);
			var formData = new FormData(form[0]);

			$.ajax({
				url: '/ajax/addProduct.php',
				type: 'POST',
				data: formData,
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					if (response.success) {
						alert('Товар успешно добавлен!');
						form[0].reset();
					} else {
						alert('Ошибка при добавлении товара: ' + response.message);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert('Ошибка при отправке запроса: ' + errorThrown);
				}
			});
		});
	});
</script>


<?php 

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>