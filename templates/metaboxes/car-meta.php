
<style>
    #car_price {
        width: 100% !important;
    }

    #car_gear {
        width: 50% !important;
    }
</style>

<section class="car-settings">
   
    <div>
        
        <p>
            <label for="car_price">Car Price</label>
        </p>
        <input 
            id="car_price" 
            type="text" 
            name="car_price"
            value="<?= esc_attr($car_price) ?>" 
            placeholder="Add car price"
    >
    </div>

    <div>
        <p><label for="car_gear">Car Gear</label></p>
        <select name="car_gear" id="car_gear">
            <option disabled selected>Choose gear</option>
            <option <?= $car_gear == 'auto' ? 'selected' : '' ?> value="auto">Auto</option>
            <option <?= $car_gear == 'manual' ? 'selected' : '' ?> value="manual">Manual</option>
            <option <?= $car_gear == 'electric' ? 'selected' : '' ?> value="electric">Electric</option>

        </select>
    </div>
</section>