<?php
/*

*/

//* Add color choice to categories
final class Erik_Category_Color 
{
    //* Holds the instance of this class.
    protected static $_instance = null;

    //* Returns the instance.
    public static function instance() 
    {
        if ( !self::$_instance )
            self::$_instance = new self;
        return self::$_instance;
    }

    function __construct(){
        add_action( 'category_edit_form_fields', array( $this, 'show' ), 10, 1 ); // hook: {$taxonomy}_edit_form_fields
        add_action( 'edited_category', array($this, 'save_category_color') ); // hook: edited_{$taxonomy}
    }

    // Show meta fields
    function show( $tag )
    {
        //* Get category_colors
        $category_colors = get_option( "_category_colors", array() );

        //* Get current category color
        $category_color = isset($category_colors[$tag->term_id]) ? $category_colors[$tag->term_id] : '';
        ?>
        <tr class="form-field">
            <th scope="row"><label for="color">Color</label></th>
            <td>
                <input name="category_color" id="color" type="text" style="max-width:100px" value="<?php echo $category_color; ?>" size="10" placeholder="#000000" />
                <p class="description">Add a hexadecimal color value to this category. Like this: <i>#FF0000</i></p>
            </td>
        </tr>
        <?php
    }

    //*save 
    function save_category_color( $term_id ) 
    {
        //* Get category_colors
        $category_colors = get_option( "_category_colors", array() );

        //* Get saved category color
        $saved_category_color = isset( $_POST['category_color'] ) ? $_POST['category_color'] : NULL;

        if ($saved_category_color) {
            //* Put category_color in array
            $category_colors[$term_id] = $saved_category_color;
        }
    
        //* Store in database        
        update_option( "_category_colors", $category_colors );
    }
}

Erik_Category_Color::instance();

include_once( THEME_LIB_DIR . 'extensions/erik-category-color/functions.php' );