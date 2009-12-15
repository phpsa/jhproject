/*****************************************/
// Name: Javascript Textarea BBCode Markup Editor
// Version: 1.3
// Author: Balakrishnan
// Last Modified Date: 25/jan/2009
// License: Free
// URL: http://www.corpocrat.com
/******************************************/

var textarea;
var content;
//document.write("<link href=\"bbeditor/styles.css\" rel=\"stylesheet\" type=\"text/css\">");


function edToolbar(obj,path) {
   
	var editblock = document.getElementById("optional");
	var imgpath = path+"plugins/jhprojectwiki/bbeditor/images/";
	editblock.innerHTML = "<img class=\"bb_button\" src=\""+imgpath+"head1.gif\" name=\"btnBold\" onClick=\"doAddTags('[h1]','[/h1]','" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"head2.gif\" name=\"btnBold\" onClick=\"doAddTags('[h2]','[/h2]','" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"head3.gif\" name=\"btnBold\" onClick=\"doAddTags('[h3]','[/h3]','" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"bold.gif\" name=\"btnBold\" onClick=\"doAddTags('[b]','[/b]','" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"italic.gif\" name=\"btnItalic\" onClick=\"doAddTags('[i]','[/i]','" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"underline.gif\" name=\"btnUnderline\" onClick=\"doAddTags('[u]','[/u]','" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"link.gif\" name=\"btnLink\" onClick=\"doURL('" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"picture.gif\" name=\"btnPicture\" onClick=\"doImage('" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"ordered.gif\" name=\"btnList\" onClick=\"doList('# ','" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"unordered.gif\" name=\"btnList\" onClick=\"doList('* ','" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"quote.gif\" name=\"btnQuote\" onClick=\"doAddTags('[quote]','[/quote]','" + obj + "')\"><img class=\"bb_button\" src=\""+imgpath+"code.gif\" name=\"btnCode\" onClick=\"doAddTags('[code]','[/code]','" + obj + "')\">";
	//document.write("<textarea id=\""+ obj +"\" name = \"" + obj + "\" cols=\"" + width + "\" rows=\"" + height + "\"></textarea>");
				}

function doImage(obj)
{
textarea = document.getElementById(obj);
var url = prompt('Enter the Image URL:','http://');
var scrollTop = textarea.scrollTop;
var scrollLeft = textarea.scrollLeft;

	if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				sel.text = '[img]' + url + '[/img]';
			}
   else 
    {
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
        var sel = textarea.value.substring(start, end);
	    //alert(sel);
		var rep = '[img]' + url + '[/img]';
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
			
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
	}

}

function doURL(obj)
{
textarea = document.getElementById(obj);
	var url = prompt('Enter the URL / Title / WikiPage:','');
var scrollTop = textarea.scrollTop;
var scrollLeft = textarea.scrollLeft;

	if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				
			if(sel.text==""){
					sel.text = '[url]'  + url + '[/url]';
					} else {
						sel.text = '[url='+url+']' + sel.text + '[/url]';
					}			

				//alert(sel.text);
				
			}
   else 
    {
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
        var sel = textarea.value.substring(start, end);
		
		if(sel==""){
				var rep = '[url]' + url + '[/url]';
				} else
				{
					var rep = '[url=' + url + ']' + sel + '[/url]';
				}
	    //alert(sel);
		
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
			
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
	}
}

function doAddTags(tag1,tag2,obj)
{
textarea = document.getElementById(obj);
	// Code for IE
		if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				//alert(sel.text);
				sel.text = tag1 + sel.text + tag2;
			}
   else 
    {  // Code for Mozilla Firefox
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
		
		var scrollTop = textarea.scrollTop;
		var scrollLeft = textarea.scrollLeft;

		
        var sel = textarea.value.substring(start, end);
	    //alert(sel);
		var rep = tag1 + sel + tag2;
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
		
		
	}
}

function doList(tag,obj){
textarea = document.getElementById(obj);
// Code for IE
		if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				var list = sel.text.split('\n');
		
				for(i=0;i<list.length;i++) 
				{
				list[i] = tag + list[i];
				}
				//alert(list.join("\n"));
				sel.text =  list.join("\n") + '\n';
			} else
			// Code for Firefox
			{

		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		var i;
		
		var scrollTop = textarea.scrollTop;
		var scrollLeft = textarea.scrollLeft;

		
        var sel = textarea.value.substring(start, end);
	    //alert(sel);
		
		var list = sel.split('\n');
		
		for(i=0;i<list.length;i++) 
		{
		list[i] = tag + list[i];
		}
		//alert(list.join("<br>"));
        
		
		var rep =  list.join("\n") + '\n';
		textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
 }
}