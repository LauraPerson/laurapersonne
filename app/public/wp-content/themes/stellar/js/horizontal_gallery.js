var isIE11 = !!navigator.userAgent.match(/Trident.*rv[ :]*11\./)

jQuery("html, body, *").mousewheel(function(event) {
    if(navigator.userAgent.search("MSIE") >= 0 || isIE11)
    {
    	this.scrollLeft -= (event.deltaY * 40);
    }
    else
    {
    	this.scrollLeft -= (event.deltaY * 3);
    }
    event.preventDefault();
});