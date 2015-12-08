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
    <div class="col-sm-12">
        <a style="background-color:#4cb939;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:220px;-webkit-text-size-adjust:none;" href="#" data-toggle="tooltip" data-token='<p><!--[if mso]>
           <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="%url%" style="height:35px;v-text-anchor:middle;width:220px;" arcsize="10%" stroke="f" fillcolor="#4cb939">
           <w:anchorlock/>
           <center>
           <![endif]-->
           <a href="%url%"
           style="background-color:#4cb939;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:220px;-webkit-text-size-adjust:none;">%text%</a>
           <!--[if mso]>
           </center>
           </v:roundrect>
           <![endif]--></p>' data-drop="showBuilderLinkModal" class="" title="<?php echo $view['translator']->trans('mautic.email.token.unsubscribe_url.descr'); ?>">
               <?php echo $view['translator']->trans('mautic.extendedplugin.email.token.button'); ?>
        </a>
    </div>
</div>
<div class="row ml-2 mr-2 mb-2">
    <div class="col-sm-12">
        <a style="background-color:#c70013;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:220px;-webkit-text-size-adjust:none;" href="#" data-toggle="tooltip" data-token='<p><!--[if mso]>
           <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="%url%" style="height:35px;v-text-anchor:middle;width:220px;" arcsize="10%" stroke="f" fillcolor="#c70013">
           <w:anchorlock/>
           <center>
           <![endif]-->
           <a href="%url%"
           style="background-color:#c70013;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:220px;-webkit-text-size-adjust:none;">%text%</a>
           <!--[if mso]>
           </center>
           </v:roundrect>
           <![endif]--></p>' data-drop="showBuilderLinkModal" class="" title="<?php echo $view['translator']->trans('mautic.email.token.unsubscribe_url.descr'); ?>">
               <?php echo $view['translator']->trans('mautic.extendedplugin.email.token.button'); ?>
        </a>
    </div>
</div>