<div id="signup-bg"></div>
    <div id="beforefooter">
        <div id="inner-beforefooter" class="wrap cf">
            <?php
            if(is_active_sidebar('beforefooter')){
                dynamic_sidebar('beforefooter');
            }
            ?>
        </div>
    </div>
    <footer class="footer" role="contentinfo">
        <div id="inner-footer" class="wrap cf">
            <div class="footer-widgets">
                <?php
                if(is_active_sidebar('footer')){
                    dynamic_sidebar('footer');
                }
                ?>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/library/js/libs/imagesloaded.pkgd.min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/library/js/libs/grayscale.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/library/js/libs/functions.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/library/js/libs/matchheight.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/library/js/libs/select2.min.js'></script>
</body>

</html> <!-- end of site-->
