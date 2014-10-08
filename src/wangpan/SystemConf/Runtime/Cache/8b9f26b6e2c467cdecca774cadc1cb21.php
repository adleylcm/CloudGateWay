<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN" class="layout-2">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>云存储网关管理系统</title>
<link rel="icon" href="./Public/Images/logo.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./Public/Images/logo.ico" />

<meta name="apple-itunes-app" content="app-id=379844545">
<link href="./Public/g.css" rel="stylesheet" type="text/css">
<link href="./Public/created.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<!-- <link href="./Public/login.css" rel="stylesheet" type="text/css"> -->
	<script type="text/javascript">
 		//处理不同视图切换函数
		function divselect(num){
	        switch (num){
		         case 1 : 
		     //         document.getElementById("contentdiv1").style.display="block";//可见性设置
		             document.getElementById("contentdiv2").style.display="none";
		             document.getElementById("contentdiv3").style.display="none";
		     //        document.getElementById("tab1").className="tab cur";//标签亮度设置
		             document.getElementById("tab2").className="tab";
		             document.getElementById("tab3").className="tab";
	           //      document.getElementById("taba1").setAttribute("style","cursor: default;");//移到页面切换标签上时显示鼠标或手指
	                 document.getElementById("taba2").setAttribute("style","cursor: pointer;");
	                 document.getElementById("taba3").setAttribute("style","cursor: pointer;");
	                 break;
		        case 2 : 
	      //            document.getElementById("contentdiv1").style.display="none";
	                 document.getElementById("contentdiv2").style.display="block";
	                 document.getElementById("contentdiv3").style.display="none";
	      //            document.getElementById("tab1").className="tab";
	                 document.getElementById("tab2").className="tab cur";
	                 document.getElementById("tab3").className="tab";
          //            document.getElementById("taba1").setAttribute("style","cursor: pointer;");
                     document.getElementById("taba2").setAttribute("style","cursor: default;");
                     document.getElementById("taba3").setAttribute("style","cursor: pointer;");
	                 break;
		        case 3 : 
	     //             document.getElementById("contentdiv1").style.display="none";
	                 document.getElementById("contentdiv2").style.display="none";
	                 document.getElementById("contentdiv3").style.display="block";
	     //             document.getElementById("tab1").className="tab";
	                 document.getElementById("tab2").className="tab";
	                 document.getElementById("tab3").className="tab cur";
          //            document.getElementById("taba1").setAttribute("style","cursor: pointer;");
                     document.getElementById("taba2").setAttribute("style","cursor: pointer;");
                     document.getElementById("taba3").setAttribute("style","cursor: default;");
	                 break;
		        default : break;
		    }
		}

		function actionSubmitNfsConf(){
       //      document.getElementById("contentdiv1").style.display="none";
            document.getElementById("contentdiv2").style.display="none";
            document.getElementById("contentdiv3").style.display="block";
      //       document.getElementById("tab1").className="tab";
            document.getElementById("tab2").className="tab";
            document.getElementById("tab3").className="tab cur"; 
    	}

    	//提示窗
		function pAlert(num){
			var msgw,msgh,bordercolor;
			msgw=400;//提示窗口的宽度
			msgh=80;//提示窗口的高度
			titleheight=25 //提示窗口标题高度
			bordercolor="#009000";//提示窗口的边框颜色
			//titlecolor="#c51100";//提示窗口的标题颜色

			var sWidth,sHeight;
			sWidth=screen.width;
			sHeight=screen.height;

			var bgObj=document.createElement("div");
			bgObj.setAttribute('id','bgDiv');
			bgObj.style.position="absolute";
			bgObj.style.top="0";
			bgObj.style.background="#cccccc";
			bgObj.style.filter="progid:DXImageTransform.Microsoft.Alpha(style=3,opacity=25,finishOpacity=75";
			bgObj.style.opacity="0.6";
			bgObj.style.left="0";
			bgObj.style.width=sWidth + "px";
			bgObj.style.height=sHeight + "px";
			bgObj.style.zIndex = "10000";
			document.body.appendChild(bgObj);

			var msgObj=document.createElement("div")
			msgObj.setAttribute("id","msgDiv");
			msgObj.setAttribute("align","center");
			msgObj.style.background="white";
			msgObj.style.border="1px solid " + bordercolor;
			msgObj.style.position = "absolute";
			msgObj.style.left = "50%";
			msgObj.style.top = "50%";
			msgObj.style.font="12px/1.6em Verdana, Geneva, Arial, Helvetica, sans-serif";
			msgObj.style.marginLeft = "-225px" ;
			msgObj.style.marginTop = -75+document.documentElement.scrollTop+"px";
			msgObj.style.width = msgw + "px";
			msgObj.style.height =msgh + "px";
			msgObj.style.textAlign = "center";
			msgObj.style.lineHeight ="25px";
			msgObj.style.zIndex = "10001";

			var title=document.createElement("h4");
			title.setAttribute("id","msgTitle");
			title.setAttribute("align","right");
			title.style.margin="0";
			title.style.padding="3px";
			title.style.background=bordercolor;
			title.style.filter="progid:DXImageTransform.Microsoft.Alpha(startX=20, startY=20, finishX=100, finishY=100,style=1,opacity=75,finishOpacity=100);";
			title.style.opacity="0.75";
			title.style.border="1px solid " + bordercolor;
			title.style.height="18px";
			title.style.font="12px Verdana, Geneva, Arial, Helvetica, sans-serif";
			title.style.color="white";
			title.style.cursor="pointer";
			title.innerHTML="关闭";
			title.onclick=function(){
				document.body.removeChild(bgObj);
				document.getElementById("msgDiv").removeChild(title);
				document.body.removeChild(msgObj);
			}
			document.body.appendChild(msgObj);
			document.getElementById("msgDiv").appendChild(title);
			var txt=document.createElement("p");
			txt.style.margin="1em 0"
			txt.setAttribute("id","msgTxt");
			//txt.innerHTML=obj_fid+"<br />"+obj_atime;
            switch(num)
            {
               case 2 : txt.innerHTML="修改成功!";break;
               case 3 : txt.innerHTML="修改成功!";break;
               case 4 : txt.innerHTML="该云存储账号不存在，请重新输入!";break;
               default :break;
            }
			//txt.innerHTML="修改成功!";

			document.getElementById("msgDiv").appendChild(txt);
            switch(num)
            {
                case 2 : divselect(2);break;
                case 3 : divselect(3);break;
                case 4 : divselect(2);break;
                default : break;
            }
			//divselect(3);
            //$("#form1").submit();
		}
//        function checkBoxLoad()
//        {   
//            if (<?php echo ($flagsize0); ?> == 1)
//            {
//               document.getElementById("policyfsize").checked = true; 
//            }
//            if (<?php echo ($flagtype0); ?> == 1)
//            {
//               document.getElementById("policyftype").checked = true; 
//            }
//            if (<?php echo ($flagexpires0); ?> == 1)
//            {
//               document.getElementById("policyexpires").checked = true; 
//            }
//            if (<?php echo ($flagfreq0); ?> == 1)
//            {
//               document.getElementById("policyfreq").checked = true; 
//            }
//        }
       // function checkBoxSubmit()
//        {
//            
//        }
	</script>
</head>
<body draggable="false">
	<div class="positionheader">
    <img src="./Public/Images/Gateway.png" />
</div>

	<div class="Bdy">
		<div class="aside" id="aside">
	<ul class="nav">
		<li><a data-ca="aside-files" href="./Index.php" class="all-file"><b>存储管理</b></a>
		</li>
		<li><a data-ca="aside-outlink" data-pv="" href="./StatAnal.php" class="link"><b>统计分析</b></a>
	    </li>
        <li><a data-ca="aside-apps" data-pv="" href="./SystemConf.php" class="apps selected"><b>系统设置</b></a>
		</li>
</div>


		
		<div id="mainer" class="noSelect loading2">               
			<div id="filemangebox" class="main dn" style="display: block;">
				<div class="maint" style="display: block;">
					<div class="mainH operatebar">
						<div class="Tab">
							<ul class="tabs">
           						<!-- 处理不同视图切换标签-->
					<!--			<li id="tab1" class="tab cur"><a id="taba1" onclick="divselect(1)" style="cursor: default;">转存策略</a> -->
								<li id="tab2" class="tab cur"><a id="taba2" onclick="divselect(2)" style="cursor: default;">云存储账号</a>
	                            <li id="tab3" class="tab"><a id="taba3" onclick="divselect(3)" style="cursor: pointer;">NFS配置</a>
							</ul>
						</div>
					</div>
				</div>

				<div class="content" style="display: block;">
            	 	    	
 <!--				  <div id="contentdiv1" style="display: block">
				  	<form id="form1" action="<?php echo U('Index/confModify');?>" method="post">
	<table>
		<tr>
			<td style="width:50px;"></td>
			<td><input type="checkbox" name="policyfsize" id="policyfsize"/> 文件大小阈值 &nbsp;&nbsp;&nbsp;<input type="text" name="pconfsize" style="width:40px;" value="<?php echo ($fileSize0); ?>" style="text-align:left; width:180px; height:20px; font-size:10pt;"/>MB</td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(文件大小大于阈值的文件, 列入上传白名单)<br /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
						
		<tr>
			<td></td>
			<td><input type="checkbox" name="policyftype" id="policyftype"/> 特定文件类型 &nbsp;&nbsp;&nbsp;<input type="text" name="pconftype" value="<?php echo ($fileType0); ?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(指定的文件类型, 不列入上传白名单)<br /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
						
		<tr>
			<td></td>
			<td><input type="checkbox" name="policyexpires" id="policyexpires"/> 访问时间阈值 &nbsp;&nbsp;&nbsp;<input type="text" name="pconexpires" style="width:40px;" value="<?php echo ($expires0); ?>" style="text-align:left; width:180px; height:20px; font-size:10pt;"/>天</td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(当上传白名单中文件最后访问时间超过阈值时, 文件从本地上传到云存储)<br /></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
						
		<tr>
			<td></td>
			<td><input type="checkbox" name="policyfreq" id="policyfreq"/> 使用频率阈值 &nbsp;&nbsp;&nbsp;<input type="text" name="pconfreq"  style="width:40px;" value="<?php echo ($freq0); ?>" style="text-align:left; width:180px; height:20px; font-size:10pt;"/>次/周</td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(当上传白名单中文件使用频率少于阈值时, 文件从本地上传到云存储)</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td></td>
			<td style="text-align:center">
				<button type="submit" class="btn_ql btn_ql-primary " style="text-align:center" onclick="sAlert()">保存</button>
	  		</td>
		</tr>

		

	</table>
</form>
		    	  </div> -->

				  <div id="contentdiv2" style="display:block">
				  	<form action="<?php echo U('Index/confModify2');?>" method="POST">
	<table>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width:50px;"></td>
	  		<td style="text-align:left; width:90px;">云存储服务地址</td>
	  		<td style="text-align:left; width:400px;"><input type="text" name="cloudadd" style="text-align:left; width:180px; height:20px; font-size:10pt;" value="<?php echo ($ipaddr0); ?>"></td>
	  		<td></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
						
		<tr>
			<td ></td>
			<td style="text-align:left">用户名</td>
	  		<td style="text-align:left"><input type="text" name="clouduser" style="text-align:left; width:180px; height:20px; font-size:10pt;" value="<?php echo ($user0); ?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td ></td>
	  		<td style="text-align:left">密码</td>
	  		<td><input type="password" name="cloudpswd" style="text-align:left; width:180px; height:20px; font-size:10pt;" value="<?php echo ($passwd0); ?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td></td>
			<td></td>
			<td style="text-align:center">
				<input  class="btn_ql btn_ql-primary" type="submit" name="setup" value="保存">
	  		</td>
	  		<td></td>
		</tr>
	</table>
</form>
<?php if(($pconfAlert0==2)) { ?>
<script type="text/javascript">pAlert(2);</script>
<?php
}?>
<?php if(($pconfAlert0==4)) { ?>
<script type="text/javascript">pAlert(4);</script>
<?php
}?>
		    	  </div>

				  <div id="contentdiv3" style="display:none">
				  	<form action="<?php echo U('Index/confModify3');?>" method="POST">


<table>
<tbody>
<tr>
<td style="width:20px;"></td>
<td style="width:500px;">
	<table >
		<tr>
			<td>&nbsp;</td>
		</tr>
		<!-- <tr >
		  	<td><font color='black'>MySQL数据库管理</font></td>
		</tr>

		<tr>
			<td><a href='http://192.168.3.6/phpmyadmin/' target="_blank"><font color='blue'>PHPMyAdmin</font></a></td>
		</tr> -->
								  
 		<!-- <tr>
 			<td><font color='black'>NFS服务器配置</font></td>
		</tr> -->
							
		<tr>
			<td>
				<textarea name="conf" cols="70" id ="1" rows="10"><?php
 $fileconf=file("/etc/exports"); foreach($fileconf as $line=> $content){ echo $content;} ?></textarea>
				<?php  if(($pconfAlert0) == 3){?>
					<script type="text/javascript">pAlert(3);</script>
				<?php }?>
				<br />
			</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td style="text-align:center;">
				<input class="btn_ql btn_ql-primary " type="submit" name="setupnfs" value="保存"/>	
			</td>		
		</tr>
	</table>
</td>
</tr>
</tbody>
</table>
</form>
				  </div>
                              
	            </div>
			</div>
	    </div>
	</div>
<!--    <script type="text/javascript">checkBoxLoad()</script> -->
	<script data-main="//j2.s.ksyun.com/pan/v1.1/1378294456726/app/home/main" src="./Public/2.1.8.js" type="text/javascript"></script>
	</body>
</html>