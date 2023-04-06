<?php
add_action('wp_footer','readmore_flatsome');
function readmore_flatsome(){
    if(is_product() || is_product_category()) :
    ?>
    <style>
        .single-product div#tab-description {
            overflow: hidden;
            position: relative;
        }
        .category-page-row .shop-container div.term-description{
            overflow: hidden;
            position: relative;
        }
        .single-product .tab-panels div#tab-description.panel:not(.active) {
            height: 0 !important;
        }
        .readmore_flatsome {
            text-align: center;
            cursor: pointer;
            position: absolute;
            z-index: 9999;
            bottom: 0;
            width: 100%;
            background: #ececec;
        }
        .readmore_flatsome:before {
            height: 55px;
            margin-top: -45px;
            content: -webkit-gradient(linear,0% 100%,0% 0%,from(#ececec),color-stop(.2,#ececec),to(rgba(255,255,255,0)));
            display: block;
        }
        .readmore_flatsome a {
            color: #fff;
            display: block;
            width: 200px;
            background: #5d85c2;
            border-radius: 26px;
            padding: 8px;
            margin: 0 auto;
            font-weight: 500;
        }
        .readmore_flatsome a:after {
            content: '';
            width: 0;
            right: 0;
            border-top: 6px solid #fff;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            display: inline-block;
            vertical-align: middle;
            margin: -2px 0 0 5px;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("load", function() {
                var tabDescription = document.querySelector('.single-product div#tab-description');
                if (tabDescription) {
                    var currentHeight = tabDescription.clientHeight;
                    var yourHeight = 300;
                    if (currentHeight > yourHeight) {
                        tabDescription.style.height = yourHeight + 'px';
                        tabDescription.insertAdjacentHTML('beforeend', '<div class="readmore_flatsome"><a title="Xem thêm" href="javascript:void(0);">Xem thêm</a></div>');
                        document.querySelector('body').addEventListener('click', function(event) {
                            if (event.target.matches('.readmore_flatsome a')) {
                                tabDescription.style.height = null;
                                document.querySelector('body .readmore_flatsome').remove();
                            }
                        });
                    }
                }
                
                var termDescription = document.querySelector('.category-page-row .shop-container div.term-description');
                if (termDescription) {
                    var currentHeight = termDescription.clientHeight;
                    var yourHeight = 230;
                    if (currentHeight > yourHeight) {
                        termDescription.style.height = yourHeight + 'px';
                        termDescription.insertAdjacentHTML('beforeend', '<div class="readmore_flatsome"><a title="Xem thêm" href="javascript:void(0);">Xem thêm</a></div>');
                        document.querySelector('body').addEventListener('click', function(event) {
                            if (event.target.matches('.readmore_flatsome a')) {
                                termDescription.style.height = null;
                                document.querySelector('body .readmore_flatsome').remove();
                            }
                        });
                    }
                }
            });
        });
    </script>
    <?php
    endif;
}