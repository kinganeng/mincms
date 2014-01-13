<?php 
 css(theme_url().'/css/fix.css');            		 	
 widget('cycle',array('tag'=>'#cycle','options'=>array(
 	'pager' => '#cycle_pager',
 	 'timeout'=>1000
 	  
 )));
  widget('cycle',array('tag'=>'#cycle2','options'=>array(
 	'pager' => '#cycle_pager2' ,
 	 'timeout'=>0
 	 
 ))); 
 foreach($posts as $p){
 	echo $p->id.'<br>';
 }
 $this->widget('LinkPager',array('pages'=>$pages)); 
 
 exit;
 ?>
 
<div class="middle">
        	<div class="one">
            	<div class="oneleft">
                    <p class="leftxin"><img src="<?php echo theme_url();?>/images/xiang.png" width="337" height="343" /></p>
                	<ul class="onelist">
                    	<li>
                        	<p class="col"><a href="#">10,000 success students</a></p>
                            <p class="colone"><a href="#">word of mouth reputation</a></p>
                        </li>
                        <li>
                        	<p class="col"><a href="#">200 professional Chinese teaching team</a></p>
                            <p class="colone"><a href="#">providing high quality language service</a></p>
                        </li>
                        <li>
                        	<p class="col"><a href="#">10 years experience in teaching Chinese</a></p>
                            <p class="colone"><a href="#">as a second language</a></p>
                        </li>
                    </ul>
                    
                </div>
                <div class="oneright">
                	<form action="" method="get">
                        <dl>
                            <dt>Rregistration Form</dt>
                            <dd><img src="<?php echo theme_url();?>/images/te1.jpg" width="36" height="35" /><input name="" type="text" value="Full Name" /></dd>
                            <dd><img src="<?php echo theme_url();?>/images/te2.jpg" width="36" height="35" /><input name="" type="text" value="Email" /></dd>
                            <dd><img src="<?php echo theme_url();?>/images/te3.jpg" width="36" height="35" /><input name="" type="text" value="Preferred City" /></dd>
                        </dl>
                        <p class="cti"><input name="" type="button" /></p>
                    </form>
                </div>
            </div>
        </div>
        <div class="center">
        	<div class="c_left">
            	<p class="c_name">ANNOUNCEMENT</p>
                <p class="c_niu"><a href="#"><img src="<?php echo theme_url();?>/images/niu.jpg" width="25" height="25" /></a></p>
                <div class="tu">  
						<div id="cycle" class="cycle" > 			  
									<a href="/posts/37" target="_blank" >
										<img class="index_img" src="<?php echo image_url('upload/2.jpg',array('resize'=>array(304,262,true,true)));?>" 
									title="吴式太极拳专场">
										<span>吴式太极拳专场</span>
									</a> 
										<a href="/posts/37" target="_blank" >
											<img class="index_img" 
													src="<?php echo image_url('upload/1.jpg',array('resize'=>array(304,262,true,true)));?>" 
												title="吴式太极拳专场22">
										<span>吴式太极拳专场22</span>
									</a> 
							</div>
					 
						   <div id='cycle_pager' class="cycle_pager"> </div>  
               		  
               		 
               		
                </div>
                
            </div>
            <div class="c_cen">
            	<p class="c_name">FREE TRIAL CLASS</p>
                <p class="c_niu"><a href="#"><img src="<?php echo theme_url();?>/images/niu.jpg" width="25" height="25" /></a></p>
                <div class="tu">
               		<img src="<?php echo theme_url();?>/images/tu2.jpg"  />
                </div>
            </div>
            <div class="c_right">
            	<p class="c_name">SCHOOL VIDEOS</p>
                <p class="c_niu"><a href="#"><img src="<?php echo theme_url();?>/images/niu.jpg" width="25" height="25" /></a></p>
                <div class="tu">
	               		<div id="cycle2" class="cycle" > 			  
									<a href="/posts/37" target="_blank" >
										<img class="index_img" src="<?php echo image_url('upload/2.jpg',array('resize'=>array(304,262,true,true)));?>" 
									title="吴式太极拳专场">
										<span></span>
									</a> 
										<a href="/posts/37" target="_blank" >
											<img class="index_img" 
													src="<?php echo image_url('upload/1.jpg',array('resize'=>array(304,262,true,true)));?>" 
												title="吴式太极拳专场22">
										<span></span>
									</a> 
							</div>
					 
						   <div id='cycle_pager2' class="cycle_pager"> </div>  
                </div>
                <div class="png" id='moreVideo'><img src="<?php echo theme_url();?>/images/png.png" width="107" height="31" /></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="center">
        	<div class="c_left">
            	<p class="c_name">CHINESE PROGRAMS</p>
                <p class="c_niu"><a href="#"><img src="<?php echo theme_url();?>/images/niu.jpg" width="25" height="25" /></a></p>
                <div class="tu">
               		<ul class="tulist">
                    	<li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                        <li><a href="#">Intensive Chinese Courses</a> </li>
                    </ul>
                </div>
                
            </div>
            <div class="c_cen">
            	<p class="c_name">COURSE lEVELS </p>
                <p class="c_niu"><a href="#"><img src="<?php echo theme_url();?>/images/niu.jpg" width="25" height="25" /></a></p>
                <div class="tu">
               		<img src="<?php echo theme_url();?>/images/tu100.jpg" width="321" height="85" />
                    <p class="msg">MM Chinese Language course covers 8 levelshelp you from "<span>ZERO</span>"  to "<span>HERO</span>"</p>
                    <p class="go"><a href="#"><img src="<?php echo theme_url();?>/images/go.jpg" /></a></p>
                </div>
            </div>
            <div class="c_right">
            	<p class="c_name">NEW COURSES </p>
                <p class="c_niu"><a href="#"><img src="<?php echo theme_url();?>/images/niu.jpg" width="25" height="25" /></a></p>
                <div class="clear"></div>
                <div class="tu">
               		<form action="" method="get">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="12%" class="clans">CITY</td>
                            <td width="22%" class="clan">CAMPUS</td>
                            <td width="22%" class="clans">STRATING DATE</td>
                            <td width="15%" class="clan">LEVEL</td>
                            <td width="29%" class="clans">SCHEDUEL </td>
                          </tr>
                          <tr>
                            <td>SH</td>
                            <td>JING'AN </td>
                            <td> oct, 21 </td>
                            <td>101 </td>
                            <td>intensive<img src="<?php echo theme_url();?>/images/qian.jpg" width="20" height="20" /></td>
                          </tr>
                          <tr>
                            <td class="yanse">SH</td>
                            <td>JING'AN </td>
                            <td class="yanse"> oct, 21 </td>
                            <td>101 </td>
                            <td class="yanse">intensive<img src="<?php echo theme_url();?>/images/qian.jpg" width="20" height="20" /></td>
                          </tr>
                          <tr>
                            <td>SH</td>
                            <td>JING'AN </td>
                            <td> oct, 21 </td>
                            <td>101 </td>
                            <td>intensive<img src="<?php echo theme_url();?>/images/qian.jpg" width="20" height="20" /></td>
                          </tr>
                          <tr>
                            <td class="yanse">SH</td>
                            <td>JING'AN </td>
                            <td class="yanse"> oct, 21 </td>
                            <td>101 </td>
                            <td class="yanse">intensive<img src="<?php echo theme_url();?>/images/qian.jpg" width="20" height="20" /></td>
                          </tr>
                          <tr>
                            <td>SH</td>
                            <td>JING'AN </td>
                            <td> oct, 21 </td>
                            <td>101 </td>
                            <td>intensive<img src="<?php echo theme_url();?>/images/qian.jpg" width="20" height="20" /></td>
                          </tr>
                          <tr>
                            <td class="yanse">SH</td>
                            <td>JING'AN </td>
                            <td class="yanse"> oct, 21 </td>
                            <td>101 </td>
                            <td class="yanse">intensive<img src="<?php echo theme_url();?>/images/qian.jpg" width="20" height="20" /></td>
                          </tr>
                        </table>
                        <a href="#"><img src="<?php echo theme_url();?>/images/red.jpg" width="276" height="113" /></a>
                    </form>

                </div>
                
            </div>
            <div class="clear"></div>
        </div>
        <div class="biaozhi">
        	<ul class="b_zong">
            	<li class="b_msg">
                	<p class="b_line"></p>
                    <p class="qiu"><img src="<?php echo theme_url();?>/images/qiu01.jpg" width="58" height="57" /></p>
                    <p class="b_name">Study Chinese at School10  years teaching experience</p>
                    <p class="b_msgz">
                    MM Chinese Language has 5 Campus now, convient location, beautiful invornment.3Campuses in Shanghai 1 Campus  in Beijing1 Branch in Germany<br />
                    <span>无论你是哪个校区的学生，都可以自由转换到其他校区或者online继续学习。我们保证你将学习到完全一样的内容。</span>
                    </p>
                    <p class="d_red"><a href="#">Location Details</a></p>
                    
                </li>
                <li class="xu"></li>
                <li class="b_msg">
                	<p class="b_line"></p>
                    <p class="qiu"><img src="<?php echo theme_url();?>/images/qiu02.jpg" width="58" height="57" /></p>
                    <p class="b_name">Study Chinese Online EASY& CONVENIENT</p>
                    <p class="b_msgz">
                    MM Chinese Language has 2 online systerms.<br />
                    <span>如果你不在中国，或者是上课时任何原因不能来学校，你都可以通过我们的skyroom，在线与我们的老师一起学习。如果你是一个喜欢自己掌握学习进度的人，可以用我们的在线selfstudy 系统。无论哪种方式，你学到的内容都跟在学校里学到的完全一样。</span>
                    </p>
                    <p class="d_red"><a href="#">More Details</a></p>
                    
                </li>
                <li class="xu"></li>
                <li class="b_msg">
                	<p class="b_line"></p>
                    <p class="qiu"><img src="<?php echo theme_url();?>/images/qiu03.jpg" width="58" height="57" /></p>
                    <p class="b_name">Community 10,000+ Students, 200+Teachers</p>
                    <p class="b_msgz">
                    MM
                    <span>所有的学生和老师都可以享受丰富的社区生活，在这里你可以聊天，交朋友，你可以参加中文歌曲比赛，你也可以参加中文视频比赛，还可以跟朋友们一起外出，很多有意思的事情，等着你来参与！</span>
                    </p>
                    <p class="d_red"><a href="#">Jion Now</a></p>
                    
                </li>
            </ul>
            <ul class="b_zong">
            	<li class="b_msg">
                	<p class="b_line"></p>
                    <p class="qiu"><img src="<?php echo theme_url();?>/images/qiu04.jpg" width="58" height="57" /></p>
                    <p class="b_name">Students Visa SurportHSK Test Center</p>
                    <p class="b_msgz">
                    Miracle Mandarin Chinese Language is certified test center and approved by Hanban. You can take exams directly at our school.<br />
                    <span>MM 为在校强化学习的留学生提供学生签证。</span>
                    </p>
                    <p class="d_red"><a href="#">More Services</a></p>
                    
                </li>
                <li class="xu"></li>
                <li class="b_msg">
                	<p class="b_line"></p>
                    <p class="qiu"><img src="<?php echo theme_url();?>/images/qiu05.jpg" width="58" height="57" /></p>
                    <p class="b_name">Mobile APPSYour way to learn Chinese</p>
                    <p class="b_msgz">
                    MM Chinese Language has 2 online systerms.<br />
                    <span>如果你不在中国，或者是上课时任何原因不能来学校，你都可以通过我们的skyroom，在线与我们的老师一起学习。如果你是一个喜欢自己掌握学习进度的人，可以用我们的在线selfstudy 系统。无论哪种方式，你学到的内容都跟在学校里学到的完全一样。</span>
                    </p>
                    <p class="d_red"><a href="#">Download</a></p>
                    
                </li>
                <li class="xu"></li>
                <li class="b_msg">
                	<p class="b_line"></p>
                    <p class="qiu"><img src="<?php echo theme_url();?>/images/qiu06.jpg" width="58" height="57" /></p>
                    <p class="b_name">Student Testimonials</p>
                    <div class="b_msgone">
                    	<p>MM
                    		<span>所有的学生和老师都可以享受丰富的社区生活，在这里你可以聊天，交朋友，等着你来参与！</span>
                    	</p>
                    </div>
                    <p class="d_red"><a href="#">More</a></p>
                    
                </li>
            </ul>
            <p class="yinline"><img src="<?php echo theme_url();?>/images/yinline.jpg" width="830" height="12" /></p>
        </div>
        <div class="day">
        	<img class="day_pic" src="<?php echo theme_url();?>/images/d01.jpg" width="350" height="240" />
			<div class="dayright">
            	<p class="day_name">GET INSPIRED WITH</p>
				<p><img src="<?php echo theme_url();?>/images/d02.jpg" width="341" height="40" /></p>
                <p class="day_msg">Every day we feature a news or picture happen with MM school or student， Want your story featured?Submit your STORY to news@miraclemandarin.comMisterties, a unique online store focused on...</p>
                <p class="d-more"><a href="#"><img src="<?php echo theme_url();?>/images/d03.jpg" width="86" height="21" /></a></p>
            </div>
            <div class="clear"></div>
        </div>
       