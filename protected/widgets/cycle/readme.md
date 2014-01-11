<script>
$(function(){   
		$('.cycle').cycle({
	        fx:      'fadeZoom', 
	        pager:   '#cycle_pager' 
	    });  
	    
	    $('#slideshow').cycle({ 
		    fx:     'scrollHorz', 
		    prev:   '#prev', 
		    next:   '#next',  
		    timeout: 1000
		});

}); 
</script>
<style>
#cycle_pager a{float:left;width: 18px;height: 20px;line-height: 20px;background: #666;text-align: center;cursor: pointer;color: white;margin-right: 2px;}
#cycle_pager a.activeSlide{background:#F70}
#cycle_pager {position: relative;z-index:9000;top:205px;float:right;margin-right: 9px;margin-top: 3px;}
.cycle{position: absolute;} 
.cycle_title{position: relative;top: 231px;	left: 0;filter: alpha(opacity=40);opacity: 0.4;	background: black;	height: 25px;	line-height:25px;	width:300px;color:#fff;z-index:1000;}
.cycle span{position: absolute;	bottom: 6px;left: 20px;	font-size: 14px;color: white;}
.cycle span,#cycle_pager{overflow:hidden; }
</style>
<div  style="width: 300px; height: 258px;  ">
	<div class="cycle" style="width: 300px; height: 258px; overflow:hidden;"> 			  
			<a href="/posts/37" target="_blank" >
				<img class="index_img" src="http://img.553300.com:88/img/allimg/1106/110601215642-0.jpg" title="吴式太极拳专场">
				<span>吴式太极拳专场</span>
			</a> 
				<a href="/posts/37" target="_blank" >
				<img class="index_img" src="http://hiphotos.baidu.com/layuedemei/pic/item/eec3852a1438785cd52af169.jpg" title="吴式太极拳专场">
				<span>吴式太极拳专场22</span>
			</a> 
	</div>
	<div class="cycle_title"></div>
	<div id="cycle_pager"> </div> 
</div>


<div class="nav"><a id="prev" href="#" style="display: inline; ">Prev</a> <a id="next" href="#" style="display: inline; ">Next</a></div>
<div id="slideshow" class="pics"> 
   <span>吴式太极拳专场</span>
   <span>吴式太极拳专场22</span>
</div> 