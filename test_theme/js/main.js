jQuery(document).ready(function(){
	jQuery('.testslider').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		pauseOnHover:true,
		autoplay: true,
		autoplaySpeed: 5000,
		dots: true,
		arrows: true,
		responsive: [
			{
				breakpoint: 769,
				settings: {
					slidesToShow: 3
				}
			},
			{
			breakpoint: 550,
			settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 1
				}
			}
		]
	});

    //Popup
    $('.js-button-campaign').click(function() { 

        // Отримання опису з data-атрибута відповідного посту
        var description = $(this).closest('.testslider_item').find('.testslider_item-description').text();
        // Вставка опису в попап
        $('.js-description').text(description);
        console.log(description);
	
        $('.js-overlay-campaign').fadeIn();
        $('.js-overlay-campaign').addClass('disabled');
    });
    
    $('.js-close-campaign').click(function() { 
        $('.js-overlay-campaign').fadeOut();
        
    });
    
    $(document).mouseup(function (e) { 
        var popup = $('.js-popup-campaign');
        if (e.target!=popup[0]&&popup.has(e.target).length === 0){
            $('.js-overlay-campaign').fadeOut();
            
        }
    });



  });
