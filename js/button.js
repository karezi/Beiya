$(document).ready(function(){

	$(".comm_count").each(function(){
		$T=$(this);
		$T.children(".cart_min").click(function(){
			if(parseInt($T.children(".td_qty_").val())>0)
			$T.children(".td_qty_").val(parseInt($T.children(".td_qty_").val())-1);
		});
		$T.children(".cart_add").click(function(){
			$T.children(".td_qty_").val(parseInt($T.children(".td_qty_").val())+1);
		});
	});
})

