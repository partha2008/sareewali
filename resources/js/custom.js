	var menu_shown = false;
	var filter_box = false;
	function resize(){
		if ($(window).width() < 991) {
			//$( ".mobielMenu" ).after( $( ".menu-container" ) );
			$( ".mobileSearch" ).after( $( ".form-box" ) );
			$( ".mobileAccount" ).after( $( ".myAccountDrop" ) );
			$( ".mobileCart" ).after( $( ".myCartBox" ) );
			$( ".currencyMyAccount" ).append( $( ".currencyBox" ) );
			$('.page-container .container').prepend( $('.categoryHeading') );

			/*$(window).scroll(function() {
				if ($(this).scrollTop() > 50){  
					$('header').removeClass("sticky");
				}else {  
					$('header').addClass("sticky");
				};
		    });*/
		}
	}	

	$(document).ready(function(){
		resize();
	});	

	$(window).resize(function(){
		resize();
	});

	$('.skip-container-mobile ul .mobileList').click(function(){
		if(false == $(this).next('.skip-container-mobile ul ul').is(':visible')) {
			$('.skip-container-mobile ul ul').slideUp(300);
		}
		$(this).next('ul').slideToggle();
	});	

	$('.currencyMyAccount').click(function() {
        $('.currencyBox').slideDown(300);
    });	

	$('.mobielMenu').click(function() {
        $('.menu-container').slideDown(300, function(){
        	menu_shown = true;
        });
    });

    $(window).click(function(e) {
    	if(!$('.menu-container').is(":hidden") && menu_shown){
			$('.menu-container').slideUp(300, function(){
				menu_shown = false;
			});
		}

		if(!$('.leftBox').is(":hidden") && filter_box){
			var container = $('.leftBox');
			if (!container.is(e.target) && container.has(e.target).length === 0) 
		    {
		        $('.leftBox').slideUp(300, function(){
					filter_box = false;
				});
		    }			
		}
	});

	$(".menu-container ul li").click(function(event){
		event.stopPropagation();
		if($(this).hasClass('menu-dropdown-icon')){
			$(this).toggleClass("fa-angle-up");
			return false;
		}else{
			return true;
		}		
	});

	$(document).on("click", ".tb_right li a", function(e){
		if($(this).parent().attr("class") != "topCart"){
			$(this).find("i").toggleClass("fa-angle-up");
		}
		$(".tb_right li ul").slideUp(300);
		if(!$(this).next('ul').is(':visible')) {
			$(this).next('ul').slideDown(300);
		}else{
			$(this).next('ul').slideUp(300);
		}
	});		

	$(".cartCloe").click(function() {
		$(".myCartBox").slideUp(300);
	});	

	$(".search a, .mobileSearch a").click(function (e) {
		e.stopPropagation();
		//$(".search-form .form-box").toggleClass("show");
		$(".form-box").slideToggle(300);
		$(".search a i").toggleClass("fa-times");
	});

	$('body').on('click', function () {
		//$(".form-box").slideUp(300);
		$(".search a i").removeClass("fa-times");
	});

	$('.form-box').on('click', function(e) {
		e.stopPropagation();
	});

	$(".showSignUpPopup").click(function() {
		$(".signUpPopupBox").show();
		$(".loginPopupBox").hide();	
	});	

	$(".showForgotPassPopup").click(function() {
		$(".forgotPassPopup").show();
		$(".loginPopupBox").hide();	
	});

	$(".showLoginPupup").click(function() {
		$(".loginPopupBox").show();
		$(".forgotPassPopup").hide();
		$(".signUpPopupBox").hide();
	});

	$('.shortByBox').on('click', function (e) {
		e.stopPropagation();
		if(!$('.leftBox').is(":hidden") && filter_box){
			$('.leftBox').slideUp(300, function(){
				filter_box = false;
			});
		}
		$('.shortByDropDown').slideToggle(300);
	});

	$('.shortByDropDown ul li').on('click', function (e) {
		var me = $(this);
		var selected_text = me.text();
		me.siblings().find("a").removeClass("active");
		me.find("a").addClass("active");

		$("#changed_txt").html(selected_text);

		search_by_attr(0);
	});

	 $("input:checkbox[class=filter_color]").click(function(){
	 	if($(this).is(':checked') == true){
	 		$(this).next().css("color", "#e4097f");
	 	}else{
	 		$(this).next().css("color", "#000000");
	 	}
	 })

	$('body').on('click', function () {
		$('.shortByDropDown').slideUp(300);
	});

	$(window).scroll(function() {
		if ($(this).scrollTop() > 50){  
	    	$('header').addClass("sticky");
	 	}else{
	    	$('header').removeClass("sticky");
	  }
	});

	$("#new-arrival").owlCarousel({
	    navigation:true,
		pagination: false,
		slideSpeed : 500,
		goToFirstSpeed : 1500,
		autoHeight : false,
		items :6, //10 items above 1000px browser width
		itemsDesktop : [1000,3], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // betweem 900px and 601px
		itemsTablet: [767,3], //2 items between 600 and 0
		itemsMobile : [480,2] // itemsMobile disabled - inherit from itemsTablet option
	});

	$("#featured-product").owlCarousel({
	    navigation:false,
		pagination: false,
		slideSpeed : 500,
		goToFirstSpeed : 1500,
		autoHeight : false,
		items :4, //10 items above 1000px browser width
		itemsDesktop : [1000,3], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // betweem 900px and 601px
		itemsTablet: [767,3], //2 items between 600 and 0
		itemsMobile : [480,2] // itemsMobile disabled - inherit from itemsTablet option
	});

	$("#everyone-alltime").owlCarousel({
	    navigation:false,
		pagination: false,
		slideSpeed : 500,
		goToFirstSpeed : 1500,
		autoHeight : false,
		items :3, //10 items above 1000px browser width
		itemsDesktop : [1000,3], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // betweem 900px and 601px
		itemsTablet: [767,3], //2 items between 600 and 0
		itemsMobile : [480,2] // itemsMobile disabled - inherit from itemsTablet option
	});

	$("#testimonial").owlCarousel({
	    navigation:false,
		pagination: true,
		slideSpeed : 500,
		goToFirstSpeed : 1500,
		autoHeight : false,
		items :1, //10 items above 1000px browser width
		itemsDesktop : [1000,1], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,1], // betweem 900px and 601px
		itemsTablet: [767,1], //2 items between 600 and 0
		itemsMobile : [480,1] // itemsMobile disabled - inherit from itemsTablet option
	});

	$(document).ready(function(){
	  	$(window).scroll(function(){
		    if ($(window).scrollTop() > 100) {
		      	$('.go-top').fadeIn();
		    }else {
		      	$('.go-top').fadeOut();
		    }
	  	});

	  	$('.go-top').click(function(){
	    	$('html, body').animate({scrollTop : 0},800);
	      	return false;
	    });
	});

	$("#more-collections").owlCarousel({
	    navigation:true,
		pagination: false,
		slideSpeed : 500,
		goToFirstSpeed : 1500,
		autoHeight : false,
		items :5, //10 items above 1000px browser width
		itemsDesktop : [1000,3], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // betweem 900px and 601px
		itemsTablet: [767,3], //2 items between 600 and 0
		itemsMobile : [480,2] // itemsMobile disabled - inherit from itemsTablet option
	});

	$("#best-selling-products").owlCarousel({
	    navigation:true,
		pagination: false,
		slideSpeed : 500,
		goToFirstSpeed : 1500,
		autoHeight : false,
		items :5, //10 items above 1000px browser width
		itemsDesktop : [1000,3], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // betweem 900px and 601px
		itemsTablet: [767,3], //2 items between 600 and 0
		itemsMobile : [480,2] // itemsMobile disabled - inherit from itemsTablet option
	});

	$(function () {
		var sideslider = $('[data-toggle=collapse-side]');
        var sel = sideslider.attr('data-target');
        var sel2 = sideslider.attr('data-target-2');
        sideslider.click(function(event){
            $(sel).toggleClass('in');
            $(sel2).toggleClass('out');
        });

	  	$('[data-toggle="tooltip"]').tooltip();

		$('.filterHeadMobile').on('click', function () {
			if(!$('.leftBox').is(":hidden") && filter_box){
				$('.leftBox').slideUp(300, function(){
					filter_box = false;
				});
			}else{
				$('.leftBox').slideDown(300, function(){
					filter_box = true;
				});
			}
			$('.filterHeadMobile').children('i').toggleClass("fa-caret-right");
		});

		$('.filterBox h2').on('click', function () {
			$(this).siblings('.mCustomScrollbar').slideToggle(300);	
			$(this).children('i').toggleClass('fa-caret-right');
			$(this).toggleClass('leftFilterActive');
		});

		if(PAGENAME == 'home'){
			wow = new WOW(
				{
					animateClass: 'animated',
					offset: 100,
					callback:     function(box) {
						//console.log("WOW: animating <" + box.tagName.toLowerCase() + ">");
					}
				}
		    );

		    wow.init();

			$("#slider4").responsiveSlides({
				auto: true,
				pager: true,
				nav: true,
				speed: 500,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
	        });
		}else if(PAGENAME == 'product-list'){
			$(".scroll-color").mCustomScrollbar({
				setHeight:150,
				theme:"dark-3"
			});

			$(".scroll-fabric").mCustomScrollbar({
				setHeight:150,
				theme:"dark-3"
			});

			$(".scroll-occassion").mCustomScrollbar({
				setHeight:150,
				theme:"dark-3"
			});
			
			sessionStorage.setItem("page", 0);
			sessionStorage.setItem("page_end", false);
			
			window.onscroll = function() {
				var d = document.documentElement;
				var offset = d.scrollTop + window.innerHeight;
				var height = d.offsetHeight;
				if (offset >= height-100) {
					if(sessionStorage.getItem("page_end") === 'false'){
			    		sessionStorage.setItem("page", parseInt(sessionStorage.getItem("page"))+1);
				        load_products(sessionStorage.getItem("page"), VIEW);
				    }
				}
			}

			$(function() {
		        $(".lazy").unveil(300);
		    });
		}else if(PAGENAME == 'product-details'){
			$('#notetabs a').tabs();

			$('.offerbtn').click(function()
		    {
		        $('.prodoffer .offerdetail').toggleClass('show_me');
		    });

		    $('.offerdetail .closebtn').click(function()
		    {
		        $('.prodoffer .offerdetail').toggleClass('show_me');
		    });

		     $('.pintitle').click(function()
		    {
		        $('.pintitle').toggleClass('show_me');
		        $('.pincode').slideToggle(500);
		    });

		}else if(PAGENAME == 'mywishlist'){
			$(function() {
		        $(".lazy").unveil(300);
		    });
		    sessionStorage.setItem("page", 0);
			sessionStorage.setItem("page_end", false);
			
			loadWishList(sessionStorage.getItem("page"));

			$(window).scroll(function() {
			    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
			    	if(sessionStorage.getItem("page_end") === 'false'){
			    		sessionStorage.setItem("page", parseInt(sessionStorage.getItem("page"))+1);
				        loadWishList(sessionStorage.getItem("page"));
				    }
			    }
			});
		}else{
		    $('#btnFeatures').on('click', function() {
		        $('html, body').animate({
		            scrollTop: $('.tc-all-features').offset().top - 50 + 'px'
		        }, 800);
		    });

		    function select_size(size, price) {
		        $('#size').val(size);
		        $('.sizeBox a').removeClass('active');
		        $('#sizeBox-' + size + ' a').addClass('active');
		        $("#actualPrice").html(price);
		    }
		}
	});