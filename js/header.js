var site_url = '';
var nav  = [ '#home', '#about', '#services', '#solutions', '#contact' ];

$(document).ready(function(){
	setBkgPos();
	
	for ( i = 0; i < nav.length; i++ ) {
		$(nav[i]).bind( 'mouseover', mMouseOver );
		$(nav[i]).bind( 'mouseout', mMouseOut );
		$(nav[i]).bind( 'click', mClick );
	}
	
	for ( i = 0; i < nav.length; i++ ) {
		// element with \x91active?class will  start animation 
		if ( $(nav[i]).get(0).className.indexOf('active') >= 0 ){
			$(nav[i])
				.animate({ backgroundPosition:'(' + _getHPos( nav[i] ) +'px -30px}'},"fast",
					function(){ 
						$(this)
							.children()
								.animate({backgroundPosition:'(0px -40px)'},20)
								.animate({backgroundPosition:'(0px -20px)'},"fast");
						$(this)
							.animate({backgroundPosition:'(' + _getHPos( nav[i] ) +'px 50px)'},"fast")
							.animate({backgroundPosition:'(' + _getHPos( nav[i] ) +'px 25px)'},"fast");
						var parent = this;
						$(this)
							.children()
								.animate( {backgroundPosition:'(0px -45px)'},"fast",function(){
											$(parent).animate({backgroundPosition:'(' + _getHPos( parent.id ) +'px 25px)'},"fast");
											$(parent).css({backgroundImage: 'url(img/nav.png)'});
									});
					});
			break;
		}
	}
}); 

function _getHPos( id )
{
	for ( i = 0; i < nav.length; i++ ){
		if ( '#' + id == nav[i] ){
			return i*(-98);
		}
	}	
	
	return 0;
}

function setBkgPos()
{
	for ( i = 0; i < nav.length; i++ ){
		$(nav[i]).css({backgroundPosition: i*(-98) + 'px -25px'});
		$(nav[i] + ' div').css({ backgroundPosition: '0px -60px'});
	}
}

function mMouseOver(e)
{
	// element with \x91active?class will ignore this event and do nothing
	if ( this.className.indexOf('active') >= 0  ){
		return;
	}
	
	$(this)
		// stop any animation that took place before this
		.stop()
		// step 1. change the image file
		.css({backgroundImage: 'url(img/nav-over.png)',cursor: 'pointer'})
		// step.2 move up the navigation item a bit
		.animate({ backgroundPosition:'(' + _getHPos( this.id ) +'px -30px}'},"fast",
			// this section will be executed after the step.2 is done
			function(){ 
				$(this)
					.children()
						// step. 3 move the white box down
						.animate({backgroundPosition:'(0px -40px)'},20)
						// step 4. move the white box down
						.animate({backgroundPosition:'(0px -20px)'},"fast");
				$(this)
					// step 4. move the navigation item down
					.animate({backgroundPosition:'(' + _getHPos( this.id ) +'px 50px)'},"fast")
					// step 5. move the navigation item to its final position
					.animate({backgroundPosition:'(' + _getHPos( this.id ) +'px 25px)'},"fast");
				// store the parent element id for later usage
				var parent = this;
				$(this)
					.children()
						// step 5. move the white box to its final position
						.animate( {backgroundPosition:'(0px -45px)'},"fast",
							// this section will be executed after the step.5 is done
							function(){
								// step.6 change the image to its original image	
								$(parent).css({backgroundImage: 'url(img/nav.png)'});
							});
			
			});
}

function mMouseOut(e)
{			
	// element with \x91active?class will ignore this event and do nothing
	if ( this.className.indexOf('active') >= 0  ){
		return;
	}
	
	$(this)
		// stop any animation that took place before this
		.stop()
		// step.1 move down navigation item
		.animate({backgroundPosition:'(' + _getHPos( this.id ) +'px 40px )'}, "fast", 
			// this section will be executed after the step.1 is done
			function(){
				// step.2 white box move really fast
				$(this).children().animate({backgroundPosition:'(0px 70px)'}, "fast");
				// step 3. move navigation item up
				$(this).animate( {backgroundPosition:'(' + _getHPos( this.id ) +'px -40px)'}, "fast", 
					// this section will be executed after the step.3 is done
					function(){
						// step 4. move navigation item ot its original position
						$(this).animate( {backgroundPosition:'(' + _getHPos( this.id ) +'px -25px)'}, "fast",
							// this section will be executed after the step.4 is done
							function(){
								// move white box to its original position, ready for next animation
								$(this).children().css({ backgroundPosition:'0px -60px'});
							})
					})
			})
		.css({backgroundImage: 'url(img/nav.png)', cursor: ''});
}

function mClick(e)
{
	location.href = this.id;
}
