<?php
if (!defined('IPHORM_VERSION')) exit;
$uploadNumFields = (int) $element->getUploadNumFields();
?>
<div class="iphorm-element-wrap iphorm-element-wrap-file <?php echo $name; ?>-element-wrap iphorm-clearfix iphorm-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'iphorm-element-required' : 'iphorm-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="iphorm-element-spacer iphorm-element-spacer-file <?php echo $name; ?>-element-spacer">
        <?php
            if ($element->getIsMultiple() && $uploadNumFields > 0) {
                echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss, false, $uniqueId . '_file_label');
            } else {
                echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss, true);
            }
        ?>
        <div class="iphorm-input-outer-wrap <?php echo $name; ?>-input-outer-wrap" <?php echo $element->getCss(null, $leftMarginCss); ?>>
            <?php if ($element->getIsMultiple() && $uploadNumFields > 0) : ?>
                    <?php for ($i = 1; $i <= $uploadNumFields; $i++) : ?>
                        <div class="iphorm-input-wrap iphorm-input-wrap-file iphorm-clearfix <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
                            <span class="iphorm-element-file-inner"><label id="<?php echo esc_attr(sprintf('%s_file_label_%d', $uniqueId, $i)); ?>" class="iphorm-screen-reader-text"><?php printf(esc_html__('File %d', 'iphorm'), $i); ?></label><input class="iphorm-element-file <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" type="file" name="<?php echo $name; ?>[]" <?php echo $tooltipTitle; ?> aria-labelledby="<?php echo esc_attr($uniqueId . '_file_label'); ?> <?php echo esc_attr(sprintf('%s_file_label_%d', $uniqueId, $i)); ?>" /></span>
                        </div>
                    <?php endfor; ?>
                    <?php if ($element->getUploadUserAddMore()) : ?>
                        <?php $uploadAddAnotherText = strlen($element->getUploadAddAnotherText()) ? $element->getUploadAddAnotherText() : __('Upload another', 'iphorm'); ?>
                        <div class="iphorm-hidden iphorm-add-another-upload <?php echo $name; ?>-add-another-upload iphorm-clearfix">
                            <span class="iphorm-add-another-upload-button"><?php echo esc_html($uploadAddAnotherText); ?></span>
                        </div>
                        <script type="text/javascript">
                        jQuery(document).ready(function ($) {
                            var uniqueId = '<?php echo esc_js($uniqueId); ?>',
                                labelText = '<?php echo esc_js(__('File %d', 'iphorm')); ?>';

                            $('.<?php echo $name; ?>-add-another-upload', iPhorm.instance.$form).show().find('span').click(function (e) {
                                var count = $(this).closest('.iphorm-input-outer-wrap').find('.iphorm-input-wrap').length,
                                    labelId = uniqueId + '_file_label_' + (count + 1),
                                    thisLabelText = labelText.replace('%d', (count + 1)),
                                    ariaLabelledBy = uniqueId + '_file_label ' + labelId;

                                var $newFileElement = $('<div class="iphorm-input-wrap iphorm-input-wrap-file iphorm-clearfix <?php echo $name; ?>-input-wrap"><span class="iphorm-element-file-inner"><label class="iphorm-screen-reader-text"></label><input class="iphorm-element-file <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" type="file" name="<?php echo $name; ?>[]" <?php echo $tooltipTitle; ?> /></span></div>');
                                $('.<?php echo $name; ?>-input-outer-wrap .iphorm-input-wrap:last').after($newFileElement);
                                $newFileElement.find('.iphorm-screen-reader-text').text(thisLabelText).attr('id', labelId);
                                $newFileElement.find('.iphorm-element-file').attr('aria-labelledby', ariaLabelledBy);
                                $newFileElement.addClass('iphorm-add-another-file-wrap').show();

                                <?php if ($form->getUseUniformJs()) : ?>
                                if ($.isFunction($.fn.uniform)) {
                                    $newFileElement.find('input:file').uniform({
                                        fileDefaultHtml: '<?php echo $element->getDefaultText(); ?>',
                                        fileButtonHtml: '<?php echo $element->getBrowseText(); ?>'
                                    });
                                }
                                <?php endif; ?>
                            });
                        });
                        </script>
                <?php endif; ?>
            <?php else : ?>
                <div class="iphorm-input-wrap iphorm-input-wrap-file iphorm-clearfix <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner'); ?>>
                    <span class="iphorm-element-file-inner"><input id="<?php echo esc_attr($uniqueId); ?>" class="iphorm-element-file <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" type="file" name="<?php echo $name; ?>" <?php echo $tooltipTitle; ?> /></span>
                </div>
            <?php endif; ?>
            <?php if ($form->getUseUniformJs()) : ?>
                <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    if ($.isFunction($.fn.uniform)) {
                        $('.<?php echo $name; ?>-element-wrap input:file', iPhorm.instance.$form).not('.iphorm-upload-enhanced').uniform({
                        	fileDefaultHtml: '<?php echo esc_js($element->getDefaultText()); ?>',
                        	fileButtonHtml: '<?php echo esc_js($element->getBrowseText()); ?>'
                        });
                    }
                });
                </script>
            <?php endif; ?>
            <script type="text/javascript">
            jQuery(document).ready(function ($) {
              	$('.<?php echo $name; ?>-input-wrap', iPhorm.instance.$form).show();
            });
            </script>
            <?php if ($useAjax && $element->getEnableSwfUpload()) : ?>
                <div id="<?php echo esc_attr($uniqueId); ?>-swfupload" class="iphorm-swfupload">
                	<div class="iphorm-clearfix">
                        <div id="<?php echo esc_attr($uniqueId); ?>-file-queue" class="iphorm-file-queue iphorm-clearfix"></div>
                        <div id="<?php echo esc_attr($uniqueId); ?>-file-queue-errors" class="iphorm-queue-errors iphorm-hidden"></div>
                        <div class="iphorm-swfupload-browse-wrap iphorm-clearfix">
                            <div class="iphorm-swfupload-browse" id="<?php echo esc_attr($uniqueId); ?>-browse">
                                <span class="iphorm-upload-browse-text"><?php echo $element->getBrowseText(); ?></span>
                                <input id="<?php echo esc_attr($uniqueId); ?>-enhanced" class="iphorm-upload-enhanced <?php echo $name; ?>" type="file"<?php echo $element->getAllowMultipleUploads() ? ' multiple' : ''; ?> />
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    iPhorm.instance.addUploader({
                        id: <?php echo $element->getId(); ?>,
                        name: '<?php echo esc_js($name); ?>',
                        uniqueId: '<?php echo esc_js($uniqueId); ?>',
                        allowedExtensions: <?php echo json_encode($element->getFileUploadValidator()->getAllowedExtensions()); ?>,
                        fileSizeLimit : <?php echo esc_js($element->getFileUploadValidator()->getMaximumFileSize()); ?>,
                        fileUploadLimit : <?php echo $element->getAllowMultipleUploads() ? 0 : 1; ?>
                    });
                });
                </script>
            <?php endif; ?>
            <?php include IPHORM_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div>
        <?php include IPHORM_INCLUDES_DIR . '/elements/_errors.php'; ?>
    </div>
</div>