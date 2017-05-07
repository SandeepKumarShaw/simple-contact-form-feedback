
<?php
 
function displaySimpleCSSSettings()
{
    global $wpcci_plugin;
    global $blog_id;
    $css_code = '';
$cssid = ( $blog_id > "1" ) ? $cssid = "_blog_id-".$blog_id : $cssid = null;

$css_path = dirname(__FILE__)."\wp-custom-css".$cssid.".css";
    if (isset($_POST['simple_save_settings']))
    {
        $css_code = strip_tags(stripslashes($_POST['simple_css_entry']));

        $settings_array = array('blog_id'=>$blog_id,'css_code'=>$css_code);

        update_option('simple_settings', $settings_array); //Store in options
        if (isset($_POST['simple_css_entry'])){

        }

        echo '<div id="message" class="updated fade">';
        echo '<p>Your custom CSS settings were successfully saved</p>';
        echo '</div>';
    }
    $settings = get_option('simple_settings');

    if ($settings){
        if($settings['blog_id'] == $blog_id){
            $css_code = $settings['css_code'];

            //write the css code to the file
            file_put_contents($css_path, $css_code);
              

        }else{
            $css_code = NULL;
        }
    }
 

?>

<div class="wrap">
<div id="poststuff">
<div id="post-body">

<div class="postbox">
<h3><label for="title">CSS Settings</label></h3>
<div class="wpcci_blue_box">
    <?php
    echo '<p>'.__('Enter or paste your custom CSS code in the box below and then click the save button.', 'simple css entry').'</p>';
    ?>
</div>
<div class="inside">

    
<form action="" method="POST">
    <textarea name="simple_css_entry" id="simple_css_entry"><?php echo $css_code; ?></textarea>
    
<div style="border-bottom: 1px solid #dedede; height: 10px"></div>
<br />
<input type="submit" name="simple_save_settings" value="Save CSS Code" class="button-primary" />
</form>
</div>
</div>
</div>
</div>
</div>
<?php } ?>