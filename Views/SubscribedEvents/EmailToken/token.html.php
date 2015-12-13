<?php

/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
use Mautic\CoreBundle\Helper\BuilderTokenHelper;
?>
<div class="row ml-2 mr-2 mb-2">
    <?php
    foreach ($colors as $color) {
        ?>
        <div class="col-sm-12" style="margin-bottom:5px">
            <a style="background-color:<?php echo $color; ?>;border-radius:<?php echo $buttons_radius; ?>;color:<?php echo $buttons_font_color; ?>;display:inline-block;font-family:sans-serif;font-size:<?php echo $buttons_font_size; ?>;font-weight:bold;line-height:<?php echo $buttons_height; ?>;text-align:center;text-decoration:none;width:<?php echo $buttons_width; ?>;-webkit-text-size-adjust:none;" href="#" data-toggle="tooltip" data-token='<p><!--[if mso]>
               <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="%url%" style="height:<?php echo $buttons_height; ?>;v-text-anchor:middle;width:<?php echo $buttons_width; ?>;" arcsize="<?php echo ceil(((int) $buttons_radius / (int) $buttons_height) * 100); ?>" stroke="f" fillcolor="<?php echo $color; ?>">
               <w:anchorlock/>
               <center>
               <![endif]-->
               <a href="%url%"
               style="background-color:<?php echo $color; ?>;border-radius:<?php echo $buttons_radius; ?>;color:<?php echo $buttons_font_color; ?>;display:inline-block;font-family:sans-serif;font-size:<?php echo $buttons_font_size; ?>;font-weight:bold;line-height:<?php echo $buttons_height; ?>;text-align:center;text-decoration:none;width:<?php echo $buttons_width; ?>;-webkit-text-size-adjust:none;">%text%</a>
               <!--[if mso]>
               </center>
               </v:roundrect>
               <![endif]--></p>' data-drop="showBuilderLinkModal" class="">
                   <?php echo $buttons_text; ?>
            </a>
        </div>
        <?php
    }
    ?>
</div>