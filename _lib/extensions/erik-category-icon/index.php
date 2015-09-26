<?php
/*

*/

//* Add icon choice to categories
final class Erik_Category_Icon 
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
        add_action( 'edited_category', array($this, 'save_category_icon') ); // hook: edited_{$taxonomy}
    }

    // Show meta fields
    function show( $tag )
    {
        //* Get category_icons
        $category_icons = get_option( "_category_icons", array() );

        //* Get current category icon
        $category_icon = isset($category_icons[$tag->term_id]) ? $category_icons[$tag->term_id] : '';
        ?>

        <tr class="form-field">
            <th scope="row"><label for="icon">Icon</label></th>
            <td>
                <?php if( is_plugin_active( 'better-font-awesome/better-font-awesome.php' ) ) : ?>
                    
                    <select name="category_icon" id="icon">

                        <?php $font_awesome = Better_Font_Awesome_Library::get_instance(); ?>

                        <?php foreach ($font_awesome->get_icons() as $icon) : ?>

                            <option value="<?php echo $icon; ?>" <?php selected($icon, $category_icon); ?>><?php echo $icon; ?></option>

                        <?php endforeach; ?>

                    </select>
                    <p class="description"></p>

                <?php else : ?>

                    <input name="category_icon" id="icon" type="text" style="max-width:100px" value="<?php echo $category_icon; ?>" size="10" placeholder="" />
                    <p class="description"></p>

                <?php endif; ?>
            </td>
        </tr>
        <?php
    }

    //*save 
    function save_category_icon( $term_id ) 
    {
        //* Get category_icons
        $category_icons = get_option( "_category_icons", array() );

        //* Get saved category icon
        $saved_category_icon = isset( $_POST['category_icon'] ) ? $_POST['category_icon'] : NULL;

        if ($saved_category_icon) {
            //* Put category_icon in array
            $category_icons[$term_id] = $saved_category_icon;
        }
    
        //* Store in database        
        update_option( "_category_icons", $category_icons );
    }
}

Erik_Category_Icon::instance();

include_once( THEME_LIB_DIR . 'extensions/erik-category-icon/functions.php' );