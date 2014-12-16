$(document).ready(function(){
	var nav  = [ '#index_goods','#index_shops' ];
	var cateInfo = $("#detailMid ul");
	var goodsInfo = "<li>书籍</li><li>生活</li><li>服装</li><li>运动</li><li>电子</li><li>其他</li>";
	var shopsInfo = "<li>生活向</li><li>吃货向</li><li>服装向</li>";
	$(nav[0]).click(function(){
		$(nav[1]).removeClass("tag");
		$(this).addClass("tag");
		cateInfo.html(goodsInfo);
		});
	$(nav[1]).click(function(){
		$(nav[0]).removeClass("tag");
		$(this).addClass("tag");
		cateInfo.html(shopsInfo);
		});

}); 