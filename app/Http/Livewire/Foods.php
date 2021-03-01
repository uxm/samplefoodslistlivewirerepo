<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Food;


class Foods extends Component
{
	public $foods = [];

	public $foodName = '';
	public $foodQuantity = '';

	public $foodNameChange = '';
	public $foodQuantityChange = '';

	public $changeFoodQuantityError = '';

	public function addFood()
	{
		$food = new Food;
		$food->name = $this->foodName;
		if($this->foodQuantity == null || $this->foodQuantity == '')
		{
			$food->quantity = 0;
		}
		else
		{
			$food->quantity = $this->foodQuantity;
		}
		$food->save();

		$food = $food->toArray();
		array_push($this->foods, $food);
	}

	public function deleteFood($foodId)
	{
		foreach($this->foods as $key => $value)
		{
			if($value['id'] == $foodId)
			{
				$this->storeDeleteFood($foodId, $key);
				return;
			}
		}
	}

	public function storeDeleteFood($foodId, $key)
	{
		$food = Food::where('id', $foodId)->get()->first();

		if($food == null)
		{
			return;
		}

		$food->delete();

		unset($this->foods[$key]);
	}

	public function setFoodNameToAdjust($value)
	{
		$this->foodNameChange = $value;
	}

	public function adjustFoodQuantity()
	{
		$food = Food::where('name', $this->foodNameChange)->get()->first();

		if($food == null)
		{
			$this->changeFoodQuantityError = "Error: could not find food with that name.";
			return;
		}

		$foodKey = null;
		foreach($this->foods as $key => $value)
		{
			if($value['id'] == $food->id)
			{
				$foodKey = $key;

				break;
			}
		}
		if($foodKey === null)
		{
			$this->changeFoodQuantityError = "Error: could not find food with that name in list.";
			return;
		}

		if($this->foodQuantityChange == null || $this->foodQuantityChange == '')
		{
			$food->quantity = 0;
		}
		else
		{
			$food->quantity = $this->foodQuantityChange;
		}

		$food->save();
		$this->foods[$foodKey]['quantity'] = $this->foodQuantityChange;

	}

    public function render()
    {
        return view('livewire.foods');
    }
}
