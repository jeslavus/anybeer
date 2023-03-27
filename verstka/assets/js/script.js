jQuery(function($) {

    $(document).ready(function() {

        /* CLOSE ALL MODAL WHEN CLICK ON DOCUMENT */
        $(document).click(function (e) {
            $(this).prop('disabled', true);

            var burger = $(".burger_menu"),
                main_menu = $('.dropdown_main_menu'),
                drop = $('.dropdown_menu_header'),
                drop_btn = $('.service_flex_item');

            if (!burger.is(e.target) && burger.has(e.target).length === 0 && !main_menu.is(e.target) && main_menu.has(e.target).length === 0) {

                $('.burger_item').eq(0).removeClass('turn_left');
                $('.burger_item').eq(2).removeClass('turn_right');
                setTimeout(function(){
                    $('.burger_item').eq(1).removeClass('hide');
                },1000);

                if($(window).width() > 660) {
                    $('.dropdown_main_menu').animate({'width' : 'hide'}, 1000);
                };

                setTimeout(function(){
                    $('section').removeClass('blur-bg');
                    $('header .drop_btn_wrap').removeClass('blur-bg');
                    $('header .logo_href').removeClass('blur-bg');
                    $('header .header_bottom').removeClass('blur-bg');
                },1000);

                $("body").removeClass('stop_scroll');
            };

            if(!drop.is(e.target) && drop.has(e.target).length === 0 && !drop_btn.is(e.target) && drop_btn.has(e.target).length === 0) {
                $('.dropdown_menu_header').slideUp(500);
                $('.arrow_menu').removeClass('rotate_arrow');
            }

            setTimeout(function() {
                $(this).prop('disabled', false);
            }.bind(this), 1e3);
        });

        /* PREVENT DEFAULT WHEN DROPDOWN BURGER IS OPENED */
        function dropdownOpened(tag) {
            $(tag).not($(`.dropdown_main_menu ${tag}`)).click(function(e){
                if($('.dropdown_main_menu').css("display") == "block") {
                    e.preventDefault();
                };
            });
        };

        dropdownOpened('a');
        dropdownOpened('button');
        dropdownOpened('form');
        dropdownOpened('input');
        
        /* MY ACHIVEMENT COUNTER */
        $('.count_achiv').text('(' + ($('.circle_img_wrap').length - $('.gray_circle_achivement').length) + ')');

        /*FOR HEADER DROPDOWN ITEMS MENU*/
        $('.service_flex_item').click(function(){
            $(this).prop('disabled', true);

            let drop = $(this).siblings('.dropdown_menu_header'),
                arrow = $(this).children('.arrow_menu');

            if($(window).width() > 767) {
                $('.dropdown_menu_header').not(drop).slideUp(500);
                $('.arrow_menu').not(arrow).removeClass('rotate_arrow');
            };
                
            drop.slideToggle(500);
            arrow.toggleClass('rotate_arrow');

            setTimeout(function() {
                $(this).prop('disabled', false);
            }.bind(this), 1e3);
        });

        /*FUNCTION FOR BURGER-MENU*/
        $('.burger_menu').on('click', function(){
            $(this).prop('disabled', true);

            $('.burger_item').eq(0).toggleClass('turn_left');
            $('.burger_item').eq(2).toggleClass('turn_right');
            if($('.burger_item').eq(1).hasClass('hide')){
                setTimeout(function(){
                    $('.burger_item').eq(1).removeClass('hide');
                },1000);
            }else{
                $('.burger_item').eq(1).addClass('hide');
            };
            
            if($(window).width() > 660) {
                $('.dropdown_main_menu').animate({'width' : 'toggle'}, 1000);
            }else{
                $('.dropdown_main_menu').slideToggle(1000);
            };

            if(($('section') || $('header .drop_btn_wrap') || $('header .logo_href') || $('header .header_bottom')).hasClass('blur-bg')) {
                setTimeout(function(){
                    $('section').removeClass('blur-bg');
                    $('header .drop_btn_wrap').removeClass('blur-bg');
                    $('header .logo_href').removeClass('blur-bg');
                    $('header .header_bottom').removeClass('blur-bg');
                },1000);
            }else{
                $('section').addClass('blur-bg');
                $('header .drop_btn_wrap').addClass('blur-bg');
                if($(window).width() > 660) {
                    $('header .logo_href').addClass('blur-bg');
                };
                $('header .header_bottom').addClass('blur-bg');
            };
            
            $("body").toggleClass('stop_scroll');

            setTimeout(function() {
                $(this).prop('disabled', false);
            }.bind(this), 1e3);
        });

        /*FOR REGISTRATION PAGE*/
        $('.role_select').click(function(){
            var index_sel = $('.role_select').index(this);
                text_inp =  $('.inputs_registration_wrap');
    
            $('.role_select').removeClass('role_select_active');
            $('.role_select').eq(index_sel).addClass('role_select_active');
            
            text_inp.fadeOut(500);
            text_inp.eq(index_sel).fadeIn(500);
        });

        /*FOR MAN PAGE*/
        $('.select_page_tab').click(function(){
            var index_sel = $('.select_page_tab').index(this);
                text_inp =  $('.right_block_wrap');
            
            $('.select_page_tab').removeClass('select_page_tab_active');
            $('.select_page_tab').eq(index_sel).addClass('select_page_tab_active');
            
            text_inp.fadeOut(500);
            text_inp.eq(index_sel).fadeIn(500);
        });

        //ТАБЛИЦА С МОИМИ ТОВАРАМИ
        /*$("input[type='number']").on('input', function() {
            $(this).val($(this).val().replace(/\D/g, ''))
        });*/

        let start_text = [];

        $('.price').each(function(i){
            start_text.push($(this).attr("value"));
        });

        $('.price').click(function(){

            let price = $(this),
                first_text = price.text().replace(/\s/g, '');

            //path.toggleClass('gray_path');

            $(document).mouseup( function(e){  
                if ( !price.is(e.target) && price.has(e.target).length === 0 ) { 
                    let second_text = price.text().replace(/\s/g, '');

                    if(second_text == first_text) {
        
                    };
                };
            });

            $(document).on('keypress', function(e) {
                let second_text = price.text().replace(/\s/g, '');
                if (e.key == "Enter") {

                    if(second_text == first_text) {
                        price.removeClass('price_yellow');
                    };
                };
                if (e.key == "Escape") {
                    price.removeClass('price_yellow');
                    //price.text(start_text[]);
                };
            });
        });
        
        



        //ПОЛЗУНОК требует доработки
        let rangeInput = $('.range_line input'),
            priceInput = $('.price_inputs_range_wrap input'),
            range = $('.yellow_range_line')[0],
            priceGap = 11750;

        rangeInput.each(function(){
            $(this)[0].addEventListener("input", e => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if((maxVal - minVal) < priceGap){
                    if(e.target.className === "min_range"){
                    rangeInput[0].value = maxVal - priceGap;
                    }else{
                    rangeInput[1].value = minVal + priceGap;
                    }
                }else{
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });

        priceInput.each(function(){
            $(this)[0].addEventListener("keyup", e => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);
        
                if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
                    if(e.target.className === "price_input_min"){
                    rangeInput[0].value = minPrice;
                    range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                    }else{
                    rangeInput[1].value = maxPrice;
                    range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });

        });

    });
});
