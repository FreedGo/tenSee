<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<?php
$public_diyr['pagetitle']='通讯录';
require(ECMS_PATH.'e/template/incfile/header.php');
?>

<?
//$getuserid=(int)getcvar('mluserid');//当前登陆会员ID
$userid   =getcvar('mluserid');
$groupid  =getcvar('mlgroupid');
$getusername =getcvar('mlusername');//当前登陆会员名
if($userid==0 || empty($userid)){
	echo "获取用户ip失败,跳转登录页面";
	exit;
}	

/*******  偶像列表  *******/
$feedid=$empire->fetch1("select feeduserid from {$dbtbpre}enewsmemberadd where userid='$userid'"); 
	
 	$feed = str_replace("::::::",",",$feedid[feeduserid]);
	$feeduid=substr($feed, 0, -1);  //我关注的所有用户

/*******  知音列表  *******/
$feeduserid=$empire->fetch1("select feeduserid from {$dbtbpre}enewsmemberadd where userid='$userid'");
$feeduser_result=explode("::::::",$feeduserid['feeduserid']);
$guan=array();
if($feeduser_result && !empty($feeduser_result)){
	unset($feeduser_result[count($feeduser_result)-1]);
	foreach($feeduser_result as $key=>$val){
		$sql="SELECT feeduserid FROM {$dbtbpre}enewsmemberadd WHERE userid=".$val;
		$result=$empire->fetch1($sql);
		if(!empty($result)){
			$friend_userid=explode("::::::",$result['feeduserid']);
			if(!empty($friend_userid)){
				unset($friend_userid[count($friend_userid)-1]);
				if(!empty($friend_userid)){
					 foreach($friend_userid as $k=>$v){
					 	if($v==$tmgetuserid){
							array_push($guan,$val);
							
						}
					 }
				}
			}
		}
	}
}

$zhiyin=join(",",$guan);	//所有知音
/******* 我的粉丝 like直接循环********/

/************ 学生&老师&教室 *************/	
$stu=$empire->fetch1("select new_student,new_teacher,new_classroom from {$dbtbpre}enewsmemberadd where userid='$userid'");
	if(!empty($stu[new_student])){
		$student=substr($stu[new_student], 0, -1);
	}
	if(!empty($stu[new_teacher])){
		$teacher=substr($stu[new_teacher], 0, -1);
	}
	if(!empty($stu[new_classroom])){
		$classroom=substr($stu[new_classroom], 0, -1);
	}
/******* 品牌 ******/

?>
<div class="singleMiddle">
	<script src="http://greattone.oss-cn-shanghai.aliyuncs.com/js/jquery.charfirst.pinyin.js"></script>
	<script src="http://greattone.oss-cn-shanghai.aliyuncs.com/js/sortLists.js"></script>
	<script type="text/javascript">
		/**
		 * //5.4 调用提示框
		 * @param {string} str,提示框显示的内容,必须
		 * @param {string} title,提示框标题,默认为空
		 * @param {number} time ,提示框消失时间,默认500毫秒
		 */
		function gtAleryt(str,title,time) {
			var bgDom = $('.common-bg'),
			    msgWarp = $('.common-msg-warp'),
			    msgTitle = $('.common-msg-title'),
			    msgCon = $('.common-msg-con');
			bgDom.stop(true).show();
			msgWarp.stop(true).fadeIn(100);
			msgCon.html(str);
			msgTitle.html(title||"");
			setTimeout(function () {
				bgDom.stop(true).fadeOut(100);
				msgWarp.stop(true).fadeOut(100);
				window.location.reload();//提示之后重新加载页面
			},time||1500);
		}
		//5.5 每个人的旁边都要加关注
		/**
		 * 关注
		 * @param userid,{string}
		 * @constructor
		 */

		function GuanZhu(userid){
			$.post("/e/extend/feed/index.php",
				{
					followid:userid
				},
				function(data,status){
					switch(data){
						case"DelSuccess":gtAleryt("<img src='/yecha/error.png'><span style='color: red'>取消关注成功!</span>");
							$('.guanzhu'+userid).html('关注');
							break;
						case"unknowerror":gtAleryt("发生未知错误,请联系管理员!");
							break;
						case"nofollowme":gtAleryt("不能关注自己哦!");
							break;
						case"AddSuccess":gtAleryt("<img src='/yecha/success.png'>关注成功!");
							break;
						case"Pleaselogin":$('#loginBtn').trigger('click');
							break;
					}
				}
			);
		}
		/**
		 * 邀请
		 * @param userid,{string}
		 * @constructor
		 */
		function YaoQing(userid){
			$.post("/e/extend/yaoqing/index.php",
				{
					followid:userid
				},
				function(data,status){
					switch(data){
						case"DelSuccess":gtAleryt("<img src='/yecha/error.png'><span style='color: red'>删除成功!</span>");
							$('.guanzhu'+userid).html('关注');
							break;
						case"unknowerror":gtAleryt("发生未知错误,请联系管理员!");
							break;
						case"nofollowme":gtAleryt("不能关注自己哦!");
							break;
						case"AddSuccess":gtAleryt("<img src='/yecha/success.png'>邀请成功!");
							break;
						case"Pleaselogin":$('#loginBtn').trigger('click');
							break;
					}
				}
			);
		}

		$(function() {
			// 让暂时不显示的通讯录全部隐藏
			// 点击切换通讯录类别
			var iTong;
			$('.header span').click(function(event) {
				$(this).addClass('selected').siblings('span').removeClass('selected');
				iTong=$(this).index();
				// 控制通讯录列表的显示与隐藏
				$('.sort-item-list').eq(iTong).addClass('on').siblings().removeClass('on');

			});

			$('.header>span').on('click', function(event) {
				$(this).children('.codeMsg').fadeOut(400);
			});
		});
	</script>
		<div class="fixed">
		<div class="header clearfix">
			<span class="selected">偶像</span><?$titi=$empire->fetch1("select * from {$dbtbpre}enewsmember where userid=$userid");?>
			<span>知音<? if($titi[ti_zhiyinfeed]!=0){?><b class="codeMsg listMsg"><?=$titi[ti_zhiyinfeed]?></b><? }?></span>
			<span>声粉<? if($titi[ti_guanzhu]!=0){?><b class="codeMsg listMsg"><?=$titi[ti_guanzhu]?></b><? }?></span>
            <?php if($groupid!=1 || $groupid!=2){?><span>学生</span><?php }?>
			<?php if($groupid!=3){?><span>老师<? if($titi[ti_guanzhu]!=0){?><b class="codeMsg listMsg"><?=$titi[ti_guanzhu]?></b><? }?></span><?php }?>
			<?php if($groupid!=4){?><span>琴行<? if($titi[ti_guanzhu]!=0){?><b class="codeMsg listMsg"><?=$titi[ti_guanzhu]?></b><? }?></span><?php }?>
			<span>品牌<? if($titi[ti_guanzhu]!=0){?><b class="codeMsg listMsg"><?=$titi[ti_guanzhu]?></b><? }?></span>
		</div>
	</div>

	<div id="letter" ></div>
	<div class="sort-lists">
		<!-- 偶像,原我的关注····························· -->
		<div class="sort-item-list on">
			<div class="guanzhu1 biaoji sort_box ">
				<?
				if(empty($feeduid)){
					echo "您还没有关注好友";
				}else{
					$friend_sql="select * from {$dbtbpre}enewsmember a left join {$dbtbpre}enewsmemberadd b on a.userid=b.userid WHERE a.userid IN ($feeduid) and b.userid not in($zhiyin) order by a.userid desc";
					$list=$empire->query($friend_sql);
					while($r=$empire->fetch($list))
					{
						?>
						<div class=" xiaoBiaoji sort_list sort_list">
							<div class="num_logo">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<img src="<?=$r[userpic]?>">
								</a>
							</div>
							<div class="num_name"><a href="/e/space/?userid=<?=$r[userid]?>"><?=$r[username]?></a>
                            	<?php
                                	if($r[cked]==1){
										echo '<i class="newRenZheng"></i>';
									}
								?>
                            </div>
							<div class="name2">
								<span>身份：&nbsp;&nbsp;
                                <?php
                                if($r[groupid]==1){
									echo $r[putong_shenfen];//普通会员默认爱乐人
								}elseif($r[groupid]==2){
									echo $r[music_star];//音乐之星
								}elseif($r[groupid]==3){
									echo $r[teacher_type];//音乐老师
								}elseif($r[groupid]==4){
									echo "音乐教室";
								}
								?>
                                </span>&nbsp;&nbsp;&nbsp;&nbsp;
								<span>等级&nbsp;&nbsp;
                                <?php
								if($r[userfen]<=100){
									echo "一级";
								}elseif($r[userfen]<=300){
									 echo "二级";
								}elseif($r[userfen]<=800){
									 echo "三级";
								}elseif($r[userfen]<=2000){
									 echo "四级";
								}elseif($r[userfen]<=5000){
									 echo "五级";
								}elseif($r[userfen]<=15000){
									 echo "六级";
								}elseif($r[userfen]<=50000){
									 echo "七级";
								}elseif($r[userfen]>100000){
									 echo "八级";
								}else{
									echo "八级";
								}
							?>
                                </span>
							</div>
							<div class="codeWrap">
								<div class="beizhu1"><a href="javscript:;"></a></div>
								<div class="sixin">
									<a href="/e/member/msg/AddMsg/?username=<?=$r[username]?>" class="sixin1">私信</a>
									<a class="btn-huise" onclick="GuanZhu(<?=$r[userid]?>)">取消关注</a>
								</div>
							</div>
						</div>
						<?
					}
				}
				?>



			</div>
			<div class="initials">
				<ul>

				</ul>
			</div>
		</div>
		<!-- 知音·························· -->
		<div class="sort-item-list">
			<div class="zhiyin1 biaoji sort_box">
				<?
				if(empty($zhiyin)){
					echo "您还没有知音";
				}else{
					$friend_sql="select * from {$dbtbpre}enewsmember a left join {$dbtbpre}enewsmemberadd b on a.userid=b.userid WHERE a.userid IN ($zhiyin) order by a.userid desc";
					$list=$empire->query($friend_sql);
					while($r=$empire->fetch($list))
					{
						?>
						<div class=" xiaoBiaoji sort_list">
							<div class="num_logo">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<img src="<?=$r['userpic']?>">
								</a>
							</div>
							<div class="num_name"><a href="/e/space/?userid=<?=$r[userid]?>"><?=$r['username']?></a></div>
							<div class="name1">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<em><?=$r['dengji']?></em>
									<i class="iconfont"><?=$r['renzheng']?></i>
								</a>
							</div>
							<div class="name2">
								<span>身份：&nbsp;&nbsp;
                                <?php
                                if($r[groupid]==1){
									echo $r[putong_shenfen];//普通会员默认爱乐人
								}elseif($r[groupid]==2){
									echo $r[music_star];//音乐之星
								}elseif($r[groupid]==3){
									echo $r[teacher_type];//音乐老师
								}elseif($r[groupid]==4){
									echo "音乐教室";
								}
								?>
                                </span>&nbsp;&nbsp;&nbsp;&nbsp;
								<span>等级&nbsp;&nbsp;
                                <?php
								if($r[userfen]<=100){
									echo "一级";
								}elseif($r[userfen]<=300){
									 echo "二级";
								}elseif($r[userfen]<=800){
									 echo "三级";
								}elseif($r[userfen]<=2000){
									 echo "四级";
								}elseif($r[userfen]<=5000){
									 echo "五级";
								}elseif($r[userfen]<=15000){
									 echo "六级";
								}elseif($r[userfen]<=50000){
									 echo "七级";
								}elseif($r[userfen]>100000){
									 echo "八级";
								}else{
									echo "八级";
								}
							?>
                                </span>
							</div>
							<div class="codeWrap">
								<div class="beizhu1"><a href="javscript:;"></a></div>
								<div class="sixin">

									<a onclick="YaoQing(<?=$r[userid]?>)" alt="邀请他成为你的老师或学生">添加</a>

									<a  class="btn-husie">已添加</a>

									<a href="/e/member/msg/AddMsg/?username=<?=$r[username]?>" class="sixin1">私信</a>
									<a class="btn-huise" onclick="GuanZhu(<?=$r[userid]?>)">取消关注</a>
								</div>
							</div>
						</div>
						<?
					}
				}
				?>
			</div>
			<div class="initials">
				<ul>

				</ul>
			</div>
		</div>
		<!-- 粉丝························ -->
		<div class="sort-item-list">
			<div class="fensi1 biaoji sort_box">
				<?
				$uid=$userid."::::::";
				$friend_sql="select * from {$dbtbpre}enewsmember a left join {$dbtbpre}enewsmemberadd b on a.userid=b.userid WHERE b.feeduserid like '%$uid%' and b.userid not in($zhiyin) order by a.userid desc";
				$list=$empire->query($friend_sql);
				while($r=$empire->fetch($list))
				{
					?>

					<div class=" xiaoBiaoji sort_list">
							<div class="num_logo">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<img src="<?=$r['userpic']?>">
								</a>
							</div>
							<div class="num_name"><a href="/e/space/?userid=<?=$r[userid]?>"><?=$r['username']?></a></div>
							<div class="name1">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<em><?=$r['dengji']?></em>
									<i class="iconfont"><?=$r['renzheng']?></i>
								</a>
							</div>
							<div class="name2">
								<span>身份：&nbsp;&nbsp;
                                <?php
                                if($r[groupid]==1){
									echo $r[putong_shenfen];//普通会员默认爱乐人
								}elseif($r[groupid]==2){
									echo $r[music_star];//音乐之星
								}elseif($r[groupid]==3){
									echo $r[teacher_type];//音乐老师
								}elseif($r[groupid]==4){
									echo "音乐教室";
								}
								?>
                                </span>&nbsp;&nbsp;&nbsp;&nbsp;
								<span>等级&nbsp;&nbsp;
                                <?php
								if($r[userfen]<=100){
									echo "一级";
								}elseif($r[userfen]<=300){
									 echo "二级";
								}elseif($r[userfen]<=800){
									 echo "三级";
								}elseif($r[userfen]<=2000){
									 echo "四级";
								}elseif($r[userfen]<=5000){
									 echo "五级";
								}elseif($r[userfen]<=15000){
									 echo "六级";
								}elseif($r[userfen]<=50000){
									 echo "七级";
								}elseif($r[userfen]>100000){
									 echo "八级";
								}else{
									echo "八级";
								}
							?>
                                </span>
							</div>
							<div class="codeWrap">
								<div class="beizhu1"><a href="javscript:;"></a></div>
								<div class="sixin">
									<a href="/e/member/msg/AddMsg/?username=<?=$r[username]?>" class="sixin1">私信</a>
									<a  onclick="GuanZhu(<?=$r[userid]?>)">关注</a>
								</div>
							</div>


						</div>
					<?
				}
				?>
			</div>
			<div class="initials">
				<ul>

				</ul>
			</div>
		</div>
        <!--- 学生 ---->
        <?php
        	if($groupid!=1 || $groupid!=2){
		?>
			<div class="sort-item-list">
			<div class="zhiyin1 biaoji sort_box">
				<?
				if(empty($student)){
					echo "您还没有学生";
				}else{
					$friend_sql="select * from {$dbtbpre}enewsmember a left join {$dbtbpre}enewsmemberadd b on a.userid=b.userid WHERE a.userid IN ($student) order by a.userid desc";
					$list=$empire->query($friend_sql);
					while($r=$empire->fetch($list))
					{
						?>
						<div class=" xiaoBiaoji sort_list">
							<div class="num_logo">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<img src="<?=$r['userpic']?>">
								</a>
							</div>
							<div class="num_name"><a href="/e/space/?userid=<?=$r[userid]?>"><?=$r['username']?></a></div>
							<div class="name1">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<em><?=$r['dengji']?></em>
									<i class="iconfont"><?=$r['renzheng']?></i>
								</a>
							</div>
							<div class="name2">
								<span>身份：&nbsp;&nbsp;
                                <?php
                                if($r[groupid]==1){
									echo $r[putong_shenfen];//普通会员默认爱乐人
								}elseif($r[groupid]==2){
									echo $r[music_star];//音乐之星
								}elseif($r[groupid]==3){
									echo $r[teacher_type];//音乐老师
								}elseif($r[groupid]==4){
									echo "音乐教室";
								}
								?>
                                </span>&nbsp;&nbsp;&nbsp;&nbsp;
								<span>等级&nbsp;&nbsp;
                                <?php
								if($r[userfen]<=100){
									echo "一级";
								}elseif($r[userfen]<=300){
									 echo "二级";
								}elseif($r[userfen]<=800){
									 echo "三级";
								}elseif($r[userfen]<=2000){
									 echo "四级";
								}elseif($r[userfen]<=5000){
									 echo "五级";
								}elseif($r[userfen]<=15000){
									 echo "六级";
								}elseif($r[userfen]<=50000){
									 echo "七级";
								}elseif($r[userfen]>100000){
									 echo "八级";
								}else{
									echo "八级";
								}
							?>
                                </span>
							</div>
							<div class="codeWrap">
								<div class="beizhu1"><a href="javscript:;"></a></div>
								<div class="sixin">
									<a href="/e/member/msg/AddMsg/?username=<?=$r[username]?>" class="sixin1">私信</a>
									<a class="btn-huise" onclick="YaoQing(<?=$r[userid]?>)" alt="删除">删除</a>
								</div>
							</div>
						</div>
						<?
					}
				}
				?>
			</div>
			<div class="initials">
				<ul>

				</ul>
			</div>
		</div>
		<?
			}
		?>
		<!-- 老师························ -->
		<?php
        	if($groupid!=3){
		?>
			<div class="sort-item-list">
			<div class="zhiyin1 biaoji sort_box">
				<?
				if(empty($teacher)){
					echo "您还没有老师";
				}else{
					$friend_sql="select * from {$dbtbpre}enewsmember a left join {$dbtbpre}enewsmemberadd b on a.userid=b.userid WHERE a.userid IN ($teacher) order by a.userid desc";
					$list=$empire->query($friend_sql);
					while($r=$empire->fetch($list))
					{
						?>
						<div class=" xiaoBiaoji sort_list">
							<div class="num_logo">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<img src="<?=$r['userpic']?>">
								</a>
							</div>
							<div class="num_name"><a href="/e/space/?userid=<?=$r[userid]?>"><?=$r['username']?></a></div>
							<div class="name1">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<em><?=$r['dengji']?></em>
									<i class="iconfont"><?=$r['renzheng']?></i>
								</a>
							</div>
							<div class="name2">
								<span>身份：&nbsp;&nbsp;
                                <?php
                                if($r[groupid]==1){
									echo $r[putong_shenfen];//普通会员默认爱乐人
								}elseif($r[groupid]==2){
									echo $r[music_star];//音乐之星
								}elseif($r[groupid]==3){
									echo $r[teacher_type];//音乐老师
								}elseif($r[groupid]==4){
									echo "音乐教室";
								}
								?>
                                </span>&nbsp;&nbsp;&nbsp;&nbsp;
								<span>等级&nbsp;&nbsp;
                                <?php
								if($r[userfen]<=100){
									echo "一级";
								}elseif($r[userfen]<=300){
									 echo "二级";
								}elseif($r[userfen]<=800){
									 echo "三级";
								}elseif($r[userfen]<=2000){
									 echo "四级";
								}elseif($r[userfen]<=5000){
									 echo "五级";
								}elseif($r[userfen]<=15000){
									 echo "六级";
								}elseif($r[userfen]<=50000){
									 echo "七级";
								}elseif($r[userfen]>100000){
									 echo "八级";
								}else{
									echo "八级";
								}
							?>
                                </span>
							</div>
							<div class="codeWrap">
								<div class="beizhu1"><a href="javscript:;"></a></div>
								<div class="sixin">
									<a href="/e/member/msg/AddMsg/?username=<?=$r[username]?>" class="sixin1">私信</a>
									<?php
							            if($groupid == 4|| $groupid == 5){
									?>
									<a class="btn-huise" onclick="YaoQing(<?=$r[userid]?>)" alt="删除">删除</a>
									<?

									 ?>
								</div>
							</div>
						</div>
						<?
					}
				}
				?>



			</div>
			<div class="initials">
				<ul>

				</ul>
			</div>
		</div>
		<?
			}
		?>
		<!-- 琴行, 教室························ -->
		<?php
        	if($groupid!=4){
			?>
			<div class="sort-item-list">
			<div class="zhiyin1 biaoji sort_box">
				<?
				if(empty($guanwhe)){
					echo "您还没有加入琴行";
				}else{
					$friend_sql="select * from {$dbtbpre}enewsmember a left join {$dbtbpre}enewsmemberadd b on a.userid=b.userid WHERE a.userid IN ($classroom) order by a.userid desc";
					$list=$empire->query($friend_sql);
					while($r=$empire->fetch($list))
					{
						?>
						<div class=" xiaoBiaoji sort_list">
							<div class="num_logo">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<img src="<?=$r['userpic']?>">
								</a>
							</div>
							<div class="num_name"><a href="/e/space/?userid=<?=$r[userid]?>"><?=$r['username']?></a></div>
							<div class="name1">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<em><?=$r['dengji']?></em>
									<i class="iconfont"><?=$r['renzheng']?></i>
								</a>
							</div>
							<div class="name2">
								<span>身份：&nbsp;&nbsp;
                                <?php
                                if($r[groupid]==1){
									echo $r[putong_shenfen];//普通会员默认爱乐人
								}elseif($r[groupid]==2){
									echo $r[music_star];//音乐之星
								}elseif($r[groupid]==3){
									echo $r[teacher_type];//音乐老师
								}elseif($r[groupid]==4){
									echo "音乐教室";
								}
								?>
                                </span>&nbsp;&nbsp;&nbsp;&nbsp;
								<span>等级&nbsp;&nbsp;
                                <?php
								if($r[userfen]<=100){
									echo "一级";
								}elseif($r[userfen]<=300){
									 echo "二级";
								}elseif($r[userfen]<=800){
									 echo "三级";
								}elseif($r[userfen]<=2000){
									 echo "四级";
								}elseif($r[userfen]<=5000){
									 echo "五级";
								}elseif($r[userfen]<=15000){
									 echo "六级";
								}elseif($r[userfen]<=50000){
									 echo "七级";
								}elseif($r[userfen]>100000){
									 echo "八级";
								}else{
									echo "八级";
								}
							?>
                                </span>
							</div>
							<div class="codeWrap">
								<div class="beizhu1"><a href="javscript:;"></a></div>
								<div class="sixin">
									<a href="/e/member/msg/AddMsg/?username=<?=$r[username]?>" class="sixin1">私信</a>
									<a class="btn-huise" onclick="YaoQing(<?=$r[userid]?>)" alt="删除">删除</a>
								</div>
							</div>


						</div>
						<?
					}
				}
				?>



			</div>
			<div class="initials">
				<ul>

				</ul>
			</div>
		</div>
			<?
			}
		?>
		<!-- 品牌, 原教室························ -->
		<div class="sort-item-list">
			<div class="zhiyin1 biaoji sort_box">
				<?
				if(!empty($zhiyin)){
					$friend_sql="select * from {$dbtbpre}enewsmember a left join {$dbtbpre}enewsmemberadd b on a.userid=b.userid WHERE a.userid IN ($zhiyin) and a.groupid=5 order by a.userid desc";
					$list=$empire->query($friend_sql);
					while($r=$empire->fetch($list))
					{
						?>
						<div class=" xiaoBiaoji sort_list">
							<div class="num_logo">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<img src="<?=$r['userpic']?>">
								</a>
							</div>
							<div class="num_name"><a href="/e/space/?userid=<?=$r[userid]?>"><?=$r['username']?></a></div>
							<div class="name1">
								<a href="/e/space/?userid=<?=$r[userid]?>">
									<em><?=$r['dengji']?></em>
									<i class="iconfont"><?=$r['renzheng']?></i>
								</a>
							</div>
							<div class="name2">
								<span>身份：&nbsp;&nbsp;
                                <?php
                                if($r[groupid]==1){
									echo $r[putong_shenfen];//普通会员默认爱乐人
								}elseif($r[groupid]==2){
									echo $r[music_star];//音乐之星
								}elseif($r[groupid]==3){
									echo $r[teacher_type];//音乐老师
								}elseif($r[groupid]==4){
									echo "音乐教室";
								}
								?>
                                </span>&nbsp;&nbsp;&nbsp;&nbsp;
								<span>等级&nbsp;&nbsp;
                                <?php
								if($r[userfen]<=100){
									echo "一级";
								}elseif($r[userfen]<=300){
									 echo "二级";
								}elseif($r[userfen]<=800){
									 echo "三级";
								}elseif($r[userfen]<=2000){
									 echo "四级";
								}elseif($r[userfen]<=5000){
									 echo "五级";
								}elseif($r[userfen]<=15000){
									 echo "六级";
								}elseif($r[userfen]<=50000){
									 echo "七级";
								}elseif($r[userfen]>100000){
									 echo "八级";
								}else{
									echo "八级";
								}
							?>
                                </span>
							</div>
							<div class="codeWrap">
								<div class="beizhu1"><a href="javscript:;"></a></div>
								<div class="sixin">
									<a href="/e/member/msg/AddMsg/?username=<?=$r[username]?>" class="sixin1">私信</a>
									<a href="/e/space/?userid=<?=$r[userid]?>">取消关注</a>
								</div>
							</div>


						</div>
						<?
					}
					}
				?>



			</div>
			<div class="initials">
				<ul>

				</ul>
			</div>
		</div>
	</div>
<?php
//重置关注提醒数
$userid   =getcvar('mluserid');
	$zhi=$empire->fetch1("select ti_guanzhu,ti_zhiyinfeed from {$dbtbpre}enewsmember where userid=$userid"); 
	if($zhi[ti_guanzhu]!=0){
		$empire->query("UPDATE {$dbtbpre}enewsmember SET ti_guanzhu = 0 WHERE userid=$userid");
			}
	if($zhi[ti_zhiyinfeed]!=0){
		$empire->query("UPDATE {$dbtbpre}enewsmember SET ti_zhiyinfeed = 0 WHERE userid=$userid");
	}

require(ECMS_PATH.'e/template/incfile/footer.php');
?>