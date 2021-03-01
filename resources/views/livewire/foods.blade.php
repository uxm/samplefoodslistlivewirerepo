
<div x-data="alpineStuff()" style="text-align: center">

	<div style="margin: 1rem;">
		<h1 style="font-size:2rem; margin-bottom: 1rem;">Add Food</h1>
		<div style="padding: 10px;">
			<label for="foodName">Name:</label><br />
			<input type="text" wire:model="foodName" name="foodName" style="border: 1px solid #000; padding: 10px;" />
		</div>
		<div style="padding: 10px;">
			<label for="foodQuantity">Quantity:</label><br />
			<input type="text" wire:model="foodQuantity" name="foodQuantity" style="border: 1px solid #000; padding: 10px;" />
		</div>
		<div style="padding: 10px;">
			<button wire:click="addFood" style="padding: 10px; background-color: lightblue; border: 1px solid #000; border-radius: 5px;">Add Food</button>
		</div>
	</div>

	<div>
		<h2 style="font-size:1.5rem; margin-bottom: 1rem;">Food List</h2>
		@foreach($foods as $food)
		<div style="display: inline-block; padding: 10px;">
			<div style="text-align: right; padding: 0; margin: 0; line-height: 1;">
				<button wire:click="deleteFood({{ $food['id'] }})" style="padding: 10px; border-radius: 5px;">Delete</button>
			</div>
			<div style="font-size: 2rem;">
				<?php echo $food['name']; ?>
			</div>
			<div style="font-size: 1rem;">
				<?php echo $food['quantity']; ?>
			</div>
			<div>
			<?php
				if($food != null)
				{
					// the wire:click version works
					// echo '<button style="font-size: .8rem;" @click="showAdjustFoodQuantity = !showAdjustFoodQuantity" wire:click="setFoodNameToAdjust(\'' . $food['name'] . '\')" class="text-lg btn btn-primary">Adjust Quantity</button>';
					
					// the @click version does not
					// steps to reproduce - add multiple foods, of unique names. (you can use name 1, quantity 1, and name: 2, quantity: 2)
					// then delete the first food, the first item will not delete, but rather be filled with name 2 quantity 2 (so there are two that say name 2 quantity 2)
					echo '<button style="font-size: .8rem;" @click="showAdjustFoodQuantity = !showAdjustFoodQuantity, adjustFoodQuantityName=\'' . $food['name'] . '\'" class="text-lg btn btn-primary">Adjust Quantity</button>';
				}
			?>
				
			</div>
		</div>
		@endforeach

		<div x-show="showAdjustFoodQuantity">
			<h2 style="font-size:1.5rem; margin-bottom: 1rem;">Adjust Food Quantity</h2>
			<div>{{ $changeFoodQuantityError }}</div>
			<div style="padding: 10px;">
				<label for="foodNameChange">Name:</label><br />
				<input type="text" wire:model="foodNameChange" name="foodNameChange" id="foodNameChange" style="border: 1px solid #000; padding: 10px;" />
			</div>
			<div style="padding: 10px;">
				<label for="foodQuantityChange">Quantity:</label><br />
				<input type="text" wire:model="foodQuantityChange" name="foodQuantityChange" style="border: 1px solid #000; padding: 10px;" />
			</div>
			<div style="padding: 10px;">
				<button wire:click="adjustFoodQuantity" style="padding: 10px; background-color: lightblue; border: 1px solid #000; border-radius: 5px;">Adjust Food Quantity</button>
			</div>
		</div>
	</div>

</div>

<script>
	window.alpineStuff = () => {
        return {
        	showAdjustFoodQuantity: false,
        	adjustFoodQuantityName: @entangle('foodNameChange'),
        };
    }
</script>