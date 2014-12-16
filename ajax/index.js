$(document).ready(function(){
	var xmlDoc= checkXMLDocObj("/indexdata.xml");

	var i=0;
	
	var url = $(".gradePic a");
	var goodName = $(".goodName");
	var pic = $(".gradePic a img");
	var price = $(".price");
	var x = xmlDoc.getElementsByTagName("item");
	for(i=0;i<=9;i++){
		var n = x[i].childNodes;
		var temp=0;
		while(n[temp].nodeName=="#text")
			temp++;
		//alert(getNodeText(n[temp+1]));
		url.eq(i).attr("href","core/show_smallgenre.php?sgenid="+getNodeText(n[temp]));
		while(n[temp+1].nodeName=="#text")
			temp++;
		goodName.eq(i).html(getNodeText(n[temp+1]));
		while(n[temp+2].nodeName=="#text")
			temp++;
		pic.eq(i).attr("src","img/"+getNodeText(n[temp+2])+".jpg");
		while(n[temp+3].nodeName=="#text")
			temp++;
		price.eq(i).html("<b>￥2"+getNodeText(n[temp+3])+"</b>");
		
}
})
loadXML    = function(xmlFile)
{
    var xmlDoc;
    if(window.ActiveXObject)
    {
        xmlDoc    = new ActiveXObject('Microsoft.XMLDOM');
        xmlDoc.async    = false;
			  try 
			  {
			  xmlDoc.load(xmlFile);
			  return(xmlDoc);
			  }
				catch(e) {alert(e.message)}
				return(null);
        
    }
    else if (document.implementation&&document.implementation.createDocument)
    {
        xmlDoc    = document.implementation.createDocument('', '', null);
			  try 
			  {
				  xmlDoc.async=false;
				  xmlDoc.load(xmlFile);
				  return(xmlDoc);
			  }
				catch(e) {alert(e.message)}
				return(null);
    }
    else
    {
        return null;
    }
    
    return xmlDoc;
}
checkXMLDocObj    = function(xmlFile)
{	
    var xmlDoc    = loadXML(xmlFile);
    if(xmlDoc==null)
    {
        alert('您的浏览器不支持xml文件读取,于是本页面禁止您的操作,推荐使用IE5.0以上可以解决此问题!');
        window.location.href='/Index.aspx';
    }
    
    return xmlDoc;
}
function getNodeText(obj)
{
    if(!obj)
    {
        return "";
    }
    if(obj.textContent)
    {
        return obj.textContent;
    }
   
    if(obj.firstChild)
    {
        obj=obj.firstChild;   
    }
    if(obj.nodeValue)
    {
        return obj.nodeValue;
    }
    if(obj.data)
    {
        return obj.data;
    }
    return "";
   
}