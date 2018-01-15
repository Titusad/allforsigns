<?php

add_action('wp_enqueue_scripts', 'callback_for_setting_up_scripts');
function callback_for_setting_up_scripts() {
    wp_register_style('afs-styles', plugins_url('css/afs-styles.css',__FILE__ ));
    wp_enqueue_style('afs-styles');
}


// Add custom fields inside the product add-to-cart form

function afs_custom_fields() {
	global $product;
        ?>

    <div class="imput_fields custom-imput-fields">

        <div class="size_input fields-row">
            <h4>Quote & Order</h4>
            <div class="calc-field">
            <label class="field1" style="display: none;"> <p>Width:</p> 
                <input class="number_input" type="number" id="width_ft" name="width_length" value="1" onclick="this.select();"/>

                <select class="finishing-options" name="width_in" id="width_in">
                    <option value="0" selected="selected">0"</option>
                    <option value="1">1"</option>
                    <option value="2">2"</option>
                    <option value="3">3"</option>
                    <option value="4">4"</option>
                    <option value="5">5"</option>
                    <option value="6">6"</option>
                    <option value="7">7"</option>
                    <option value="8">8"</option>
                    <option value="9">9"</option>
                    <option value="10">10"</option>
                    <option value="11">11"</option>
                    <option value="12">12"</option>
                </select>
            </label>
        </div>
       
        <div class="calc-field">
            <label class="field1" style="display: none;"> <p>Height:</p> 
                <input class="number_input" type="number" id="height_ft" name="height_length" value="1" onclick="this.select();"/>
                <select class="finishing-options" name="height_in" id="height_in">
                    <option value="0" selected="selected">0"</option>
                    <option value="1">1"</option>
                    <option value="2">2"</option>
                    <option value="3">3"</option>
                    <option value="4">4"</option>
                    <option value="5">5"</option>
                    <option value="6">6"</option>
                    <option value="7">7"</option>
                    <option value="8">8"</option>
                    <option value="9">9"</option>
                    <option value="10">10"</option>
                    <option value="11">11"</option>
                    <option value="12">12"</option>
                </select>
            </label>
        </div>
        <div class="calc-totals field1" style="display: none;">
            <div><span id="width_total_inches"> 12" </div>
            <div> x </div>
            <div><span id="height_total_inches"> 12 </span></div>
            <div> = </div>
            <div id="sqf_total">1</div> ft<sup>2</sup6>
        </div>
    </div>
  

    <div class="finishing fields-row">
        <h4>Finishing Options</h4>
        <label id="#field2"> <p># of Sides</p>
            <select class="finishing-options" name="n_s_product" id="n_s_product">
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
            </select>               
        </label>
        
        <label id="field3" style="display: none;">
            <p>2 Sided Image</p>
            <select class="finishing-options" name="d_s_image" id="d_s_image">
                <option value="1" selected="selected">No</option>
                <option value="2">Yes</option>
            </select>               
        </label>
        
        <label id="field4" style="display: none;"> <p>Pole Pocket + Hem</p>
            <select class="finishing-options" name="pp_h" id="pp_h">
                <option value="1" selected="selected">No pole pockets</option>
                <option value="2">2" Top and Bottom</option>
                <option value="3">3" Top and Bottom</option>
                <option value="4">4" Top and Bottom</option>
                <option value="5">2" Top Only</option>
                <option value="6">3" Top Only</option>
                <option value="7">4" Top Only</option>
            </select>               
        </label>
        
        <label id="field5" style="display: none;"> <p>Grommets</p>
            <select class="finishing-options" name="gmm" id="gmm">
                <option value="1" selected="selected">No Grommet</option>
                <option value="2">Every 2" All sides</option>
                <option value="3">Every 2" Top and Bottom</option>
                <option value="4">Every 2" Left and Right</option>
                <option value="5">4 Corner Only</option>
                <option value="6">Custom Grommet</option>
            </select>      
        </label>

        <label id="field6" style="display: none;"> <p>Windlist</p>
            <select class="finishing-options" name="windlist" id="windlist">
                <option value="1" selected="selected">No Windlist</option>
                <option value="2">Standard Windlist</option>
            </select>      
        </label>

        <label id="field7" style="display: none;"> <p>Webbing</p>
            <select class="finishing-options" name="webbing" id="webbing">
                <option value="1" selected="selected">No webbing, No D-Rings</option>
                <option value="2">1" Webbing</option>
                <option value="3">1" Webbing w/ D-Rings</option>
                <option value="4">1" Velcro All Sides</option>
            </select>      
        </label>

        <label id="field8" style="display: none;"> <p>Corners</p>
            <select class="finishing-options" name="corners" id="corners">
                <option value="1" selected="selected">No reinforced Corners</option>
                <option value="2">All corners w/ Webbing</option>
            </select>      
        </label>

        <label id="field9" style="display: none;"> <p>Rope</p>
            <select class="finishing-options" name="rope" id="rope">
                <option value="1" selected="selected">No rope swen</option>
                <option value="2">3/16 top or bottom only</option>
                <option value="3">3/16 top and bottom</option>
                <option value="4">1/2 top or bottom only</option>
                <option value="5D">1/2 top and bottom</option>
            </select>      
        </label>

        <label id="field10" style="display: none;"> <p>Silicone Edges</p>
            <select class="finishing-options" name="s_e" id="s_e">
                <option value="1" selected="selected">No</option>
                <option value="2">Yes</option>
            </select>      
        </label>

        <label id="field11" style="display: none;"> <p>Lamination</p>
            <select class="finishing-options" name="lam" id="lam">
                <option value="1" selected="selected">No</option>
                <option value="2">Yes</option>
            </select>  
        </label>

        <label id="field12" style="display: none;"> <p>Shape Cutout</p>
            <select class="finishing-options" name="s_c" id="s_c">
                <option value="1" selected="selected">No</option>
                <option value="2">Yes</option>
            </select>  
        </label>

        <label id="field13" style="display: none;"> 
            <p>H Stake</p>
            <select class="finishing-options" name="h_stake" id="h_stake">
                <option value="1" selected="selected">No</option>
                <option value="2">Yes</option>
            </select>  
        </label>

        <label id="field14" style="display: none;"> 
            <p>Holes</p>
            <select class="finishing-options" name="holes" id="holes">
                <option value="1" selected="selected">No</option>
                <option value="2">Yes</option>
            </select>  
        </label>
    </div>

    <div class="shipping-options fields-row">
        <h4>Shipping Options</h4>
        <div class="shipping-options">
            <label>
                <input type='radio' name='choices' value='1'>
                Store Pick Up
            </label>
            <br>
            <h6>Shipping</h6>
            <label>
                <input type='radio' name='choices' value='2'>
                Default Ship
            </label>
            <label>
                <input type='radio' name='choices' value='3'>
                Dropship
            </label>            
        </div>
    </div>

    <div class="project-desc">
        <label> <p>Turn Around</p>
            <select class="finishing-options" name="d_s_image" id="turn_around">
                <option value="1" selected="selected">Next Day</option>
                <option value="2">Same Day</option>
            </select>               
        </label>
        <label> <p>Design Proof</p>
            <select class="finishing-options" name="d_s_image" id="design_proof">
                <option value="1" selected="selected">No proof run as is</option>
                <option value="2">Email Proof</option>
            </select>               
        </label>
    </div> 

    <div class="totals-container fields-row">
        <h3>Total</h3>
        <div>$</div>
        <input id="grand_total" name="grand_total" value="0" disabled>
    </div>

</div>
 
	<?php
}

add_action( 'woocommerce_before_add_to_cart_button', 'afs_custom_fields', 10 );



// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
die;
}

function js_enqueue_scripts() {

    $js_src = plugin_dir_url( __FILE__ ) . '/js/afs-script.js';
    wp_enqueue_script( 'fe-display-php-value', $js_src, [], '' );

        // GET PRICE PER SQFT VARIABLES
        $less_than_100  =  types_render_field("100sqf");
        $between_101_and_200    = types_render_field("plus100sqf");
        $between_201_and_500    = types_render_field("200");
        $between_501_and_1000   = types_render_field("500");
        $between_1001_and_10000   = types_render_field("1000");

        // GET PRICE PER FINISHING OPTIONS VARIABLES
        $finishing_1     = types_render_field("double-sided-product", array( ));
        $finishing_2     = types_render_field("2-sided-image");
        $finishing_3     = types_render_field("pole-pocket-hem-price");
        $finishing_4     = types_render_field("grommet-price");
        $finishing_5     = types_render_field("windlist-price");
        $finishing_6     = types_render_field("1-webbing-price");
        $finishing_7     = types_render_field("1-webbing-w-d-rings");
        $finishing_8     = types_render_field("1-velcro-all-sides");
        $finishing_9     = types_render_field("corners-price-all-corners-w-webbing");
        $finishing_10    = types_render_field("rope-3-16-top-or-bottom-only");
        $finishing_11    = types_render_field("rope-3-16-top-and-bottom");
        $finishing_12    = types_render_field("rope-1-2-top-or-bottom-only");
        $finishing_13    = types_render_field("rope-1-2-top-and-bottom");
        $finishing_14    = types_render_field("silicone-all-edges-price");
        $finishing_15    = types_render_field("lamination-finishing");
        $finishing_16    = types_render_field("shape-cutout");
        $finishing_17    = types_render_field("h-stake");
        $finishing_18    = types_render_field("holes");


    //SEND PHP VARIABLES TO SCRIPT FILE
    wp_localize_script( 'fe-display-php-value', 'localize_script', array( 
        'value1'   => $less_than_100,
        'value2'  => $between_101_and_200,
        'value3'  => $between_201_and_500,
        'value4'  => $between_501_and_1000,
        'value5'  => $between_1001_and_10000,

        'value6'  => $finishing_1,
        'value7'  => $finishing_2,
        'value8'  => $finishing_3,
        'value9'  => $finishing_4,
        'value10'  => $finishing_5,
        'value11'  => $finishing_6,
        'value12'  => $finishing_7,
        'value13'  => $finishing_8,
        'value14'  => $finishing_9,
        'value15'  => $finishing_10,
        'value16'  => $finishing_11,
        'value17'  => $finishing_12,
        'value18'  => $finishing_13,
        'value19'  => $finishing_14,
        'value20'  => $finishing_15,
        'value21'  => $finishing_16,
        'value22'  => $finishing_17,
        'value23'  => $finishing_18,
        ) );
    }

add_action( "wp_enqueue_scripts", "js_enqueue_scripts" );



// Save product custom fields values after submission into the cart item data

function iconic_add_engraving_text_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
    $product_custom_price = filter_input( INPUT_POST, 'grand_total' );
    
 
    if ( empty( $grand_total) ) {
        return $cart_item_data;
    }
 
    $cart_item_data['grand_total'] = $product_custom_price;
 
    return $cart_item_data;
}
 
add_filter( 'woocommerce_add_cart_item_data', 'iconic_add_engraving_text_to_cart_item', 10, 3 );


// Display Custom Fields in the Cart
function iconic_display_engraving_text_cart( $item_data, $cart_item ) {
    if ( empty( $cart_item['grand_total'] ) ) {
        return $item_data;
    }
 
    $item_data[] = array(
        'key'     => __( 'Total Price', 'allforsigns' ),
        'value'   => wc_clean( $cart_item['grand_total'] ),
        'display' => '',
    );
 
    return $item_data;
}
 
add_filter( 'woocommerce_get_item_data', 'iconic_display_engraving_text_cart', 10, 2 );


// Replace the item price by your custom calculation

add_action('woocommerce_before_calculate_totals', 'set_custom_price');
function set_custom_price($cart_obj) {
    foreach ($cart_obj->get_cart() as $key => $value) {

    		$final_price = floatval( $cart_item_data['grand_total'] );

    		$orgPrice = floatval( $value['data']->price );
            $value['data']->set_price($final_price);
            $new_price = $value['data']->get_price();
    }
}




