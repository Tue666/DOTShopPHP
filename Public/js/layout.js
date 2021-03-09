/* js layout start */

	/* change quantity*/
	$('#plus').click(function(){
		maxCount = parseInt(document.getElementById('quantity-left').innerHTML);
		var valueCount = parseInt(document.getElementById('quantity').value);
		valueCount++;
		document.getElementById('quantity').value = valueCount;
		if (valueCount == maxCount) {
			$('#plus').addClass('disable');
		}
		if (valueCount > 1){
			$('#sub').removeClass('disable');
		}
	});
	$('#sub').click(function(){
		maxCount = parseInt(document.getElementById('quantity-left').innerHTML);
		var valueCount = parseInt(document.getElementById('quantity').value);
		valueCount--;
		document.getElementById('quantity').value = valueCount;
		if (valueCount == 1){
			$('#sub').addClass('disable');
		}
		if (valueCount < maxCount) {
			$('#plus').removeClass('disable');
		}
	});
	
	/* change active description menu */
	$('.description-tabs .description-tab-item').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
	});

	/* function move description menu */
	function move(index){
		if (index==1){
			$('.description-slides .newFirst').css('margin-left','0');
		}
		else if (index==2){
			$('.description-slides .newFirst').css('margin-left','-34%');
		}
		else {
			$('.description-slides .newFirst').css('margin-left','-68%');
		}
	};

	/* load product category */
	$('.product-navigation li').click(function(){
		const value = $(this).attr('data-filter');
		if (value == 'all'){
			$('.product-card').show(1000);
		}
		else{
			$('.product-card').not('.'+value).hide('1000');
			$('.product-card').filter('.'+value).show('1000');
		}
	});

	/* change active product menu */
	$('.product-navigation li').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
	});
	
	/* move image card */
	$('.add-cart-card').click(function(){
		$(this).parent().parent().parent().prev().prev().css({'top':'73%','right':'9%','width':'0%','height':'0%','zIndex':'1000','transition':'1s','opacity':'1'});
		$.post('./Ajax/getSession',function(response){
			//$('.add-cart-card').parent().parent().parent().prev().prev().css({'top':'73%','right':'9%','width':'0%','height':'0%','zIndex':'1000','transition':'1s'});
			if (response){

			}
			else{
				$('.add-cart-card').parent().parent().parent().prev().prev().css({'zIndex':'0','transition':'0s'});
				alert('Log in to use this button');
			}
		});
	});
	$('.add-cart-card').mouseout(function(){
		$(this).parent().parent().parent().prev().prev().css({'top':'20%','right':'33%','width':'35%','height':'28%','zIndex':'0','transition':'0s','opacity':'0'});
	});

	/* toggle account */
	$('#toggle-account').on('click',function(){
		$('.toggle-account').animate({
			height: 'toggle'
		}, 'slow');
	});
	// const account_toggle = document.getElementById('toggle-account');
	// account_toggle.addEventListener('click',()=>{
	// 	alert('test');
	// });

	/* change active menu button */
	$('.navigation a').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
		// if (!$(this).hasClass('active')){
		// 	$('.navigation a').removeClass('active');
		// 	$(this).addClass('active');
		// }
	});

	/* sticky navbar */
	window.addEventListener("scroll",function(){
		document.getElementById("scroll-header").classList.toggle('fading',window.scrollY > 90);
	});

	/* toggle navigation */
	const menu_toggle = document.querySelector('.menu-toggle');
	const _navigation = document.querySelector('.navigation');
	menu_toggle.addEventListener('click',() => {
		menu_toggle.classList.toggle('active');
		_navigation.classList.toggle('active');
	});

	/* auto slide */
	function clickSlide(i){
		slideShow(i,false);
	}
	var slideIndex = 0;
	slideShow(slideIndex,true);
	function slideShow(i,isRunning) {
		$('.buttons span').removeClass('active');
		var value = 0;
		if (i==0){
			$('#btn1').addClass('active');
		}
		else if(i==1){
			value = -34;
			$('#btn2').addClass('active');
		}
		else{
			value = -68;
			$('#btn3').addClass('active');
		}
		$('.first').css("margin-left",value + "%");
		i = i + 1;
		if (i>2){
			i=0;
		}
		if (isRunning){
			var clearTime = setTimeout(slideShow.bind(null,i,true),5500);
		}
		else{
			var clearTime = setTimeout(slideShow.bind(null,i,false),5500);
			clearTimeout(clearTime);
		}
	}

	/* scroll to top */
	const scroll_Top = document.querySelector('.scroll-top');
	window.addEventListener('scroll',()=>{
		scroll_Top.classList.toggle('active',window.scrollY > 500);
	});
	scroll_Top.addEventListener('click',()=>{
		$('html,body').animate({
			scrollTop:0,
		},'slow');
	});
/* js layout end */