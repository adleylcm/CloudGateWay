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
	<script type="text/javascript">
		function date2str(x,y) {
    		var z ={y:x.getFullYear(),M:x.getMonth()+1,d:x.getDate(),h:x.getHours(),m:x.getMinutes(),s:x.getSeconds()};
    		return y.replace(/(y+|M+|d+|h+|m+|s+)/g,function(v) {return ((v.length>1?"0":"")+eval('z.'+v.slice(-1))).slice(-(v.length>2?v.length:2))});
		}

		function sAlert(obj_fid,obj_fname,obj_fpath,obj_fpid,obj_fstatus,obj_ftype,obj_fdev,obj_fino,obj_fmode,obj_fnlinks,obj_fuid,obj_fgid,obj_frdev,obj_fsize,obj_dsize,obj_faddr,obj_fgen,obj_atime,obj_mtime,obj_ctime){
			var msgw,msgh,bordercolor;
			msgw=600;//提示窗口的宽度
			msgh=400;//提示窗口的高度
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
			msgObj.style.left = "45%";//50%
			msgObj.style.top = "25%";
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
			
			var tmp_status;
			switch(obj_fstatus){
				case 'l':tmp_status='本地';break;
				case 'k':tmp_status='使用中';break;
				case 'c':tmp_status='云存储';break;
				case 'b':tmp_status='本地 & 云存储';break;
			}
			
			var tmp_type;
			if(obj_ftype == 'd'){
				tmp_type='目录';
				tmp_status='本地 | 云存储';
			}else{
				tmp_type='文件';
			}
			var unixATimestamp = new Date(obj_atime * 1000);
			var unixMTimestamp = new Date(obj_mtime * 1000);
			var unixCTimestamp = new Date(obj_ctime * 1000);
			var ATime = date2str(unixATimestamp, "yy/M/d h:m:s");
			var MTime = date2str(unixMTimestamp, "yy/M/d h:m:s");
			var CTime = date2str(unixCTimestamp, "yy/M/d h:m:s");
			//txt.innerHTML="<table><tr><td style='text-align:right'>文件ID</td><td>"+obj_fid+"</td></tr><tr><td style='text-align:right'>父节点ID</td><td>"+obj_fpid+"</td></tr><tr><td style='text-align:right'>文件(夹)名</td><td>"+obj_fname+"</td></tr><tr><td style='text-align:right'>路径</td><td>"+obj_fpath+"</td></tr><tr><td style='text-align:right'>文件位置</td><td>"+tmp_status+"</td></tr><tr><td style='text-align:right'>文件类型</td><td>"+tmp_type+"</td></tr><tr><td style='text-align:right'>链接数</td><td>"+obj_fnlinks+"</td></tr><tr><td style='text-align:right'>文件uid</td><td>"+obj_fuid+"</td></tr><tr><td style='text-align:right'>文件gid</td><td>"+obj_fgid+"</td></tr><tr><td style='text-align:right'>文件大小(字节)</td><td>"+obj_fsize+"</td></tr><tr><td style='text-align:right'>占用磁盘大小(字节)</td><td>"+obj_dsize+"</td></tr><tr><td style='text-align:right'>最后访问时间</td><td>"+ATime+"</td></tr><tr><td style='text-align:right'>最后修改时间</td><td>"+MTime+"</td></tr><tr><td style='text-align:right'>最后改变时间</td><td>"+CTime+"</td></tr></table>";
			txt.innerHTML="<table><tr><td style='text-align:right'>文件(夹)名</td><td>"+obj_fname+"</td></tr><tr><td style='text-align:right'>路径</td><td>"+obj_fpath+"</td></tr><tr><td style='text-align:right'>文件位置</td><td>"+tmp_status+"</td></tr><tr><td style='text-align:right'>文件类型</td><td>"+tmp_type+"</td></tr><tr><td style='text-align:right'>文件大小(字节)</td><td>"+obj_fsize+"</td></tr><tr><td style='text-align:right'>占用磁盘大小(字节)</td><td>"+obj_dsize+"</td></tr><tr><td style='text-align:right'>最后访问时间</td><td>"+ATime+"</td></tr><tr><td style='text-align:right'>最后修改时间</td><td>"+MTime+"</td></tr><tr><td style='text-align:right'>最后改变时间</td><td>"+CTime+"</td></tr></table>";

			document.getElementById("msgDiv").appendChild(txt);
		}

		function showDetail_(obj_fid,obj_fname,obj_fpath,obj_fpid,obj_fstatus,obj_ftype,obj_fdev,obj_fino,obj_fmode,obj_fnlinks,obj_fuid,obj_fgid,obj_frdev,obj_fsize,obj_dsize,obj_faddr,obj_fgen,obj_atime,obj_mtime,obj_ctime){
			alert("xx\n"+obj_mtime);
		}
		
		function backBtn()
		{   
            var es;
            if(document.location.href.indexOf("?")!=-1) es=document.location.href.split("?")[1];
            //if(es==""){alert("Error url.");return;}
			if(es){
              self.history.back();
            }
                        
//			if(!$_GET["fpath"]){
//		        alert('123');
//		        document.getElementById("back").setAttribute("class","btn back btn_disable btnDis");
//		        document.getElementById("back").setAttribute("onclick","");
//		    };
		}
	</script>
    	<script type="text/javascript"> 
    //视图切换函数
		function divselect(num)
		{
		    switch (num)
		    {
		        case 1 :
		                 document.getElementById("contentdiv1").style.display="block";
		                 document.getElementById("contentdiv2").style.display="none";
		                 document.getElementById("contentdiv3").style.display="none";
		                 document.getElementById("tab1").className="tab cur";
			             document.getElementById("tab2").className="tab";
			             document.getElementById("tab3").className="tab";
                     document.getElementById("taba1").setAttribute("style","cursor: default;");//移到页面切换标签上时显示鼠标或手指
                     document.getElementById("taba2").setAttribute("style","cursor: pointer;");
                     document.getElementById("taba3").setAttribute("style","cursor: pointer;");                         
		//                 alert("页面切换正常···1");
		                 break;
		        case 2 : 
		/**
		 *                  alert("DOM 对象处理语句未完全执行···2");
		 */
		                 document.getElementById("contentdiv1").style.display="none";
		                 document.getElementById("contentdiv2").style.display="block";
		                 document.getElementById("contentdiv3").style.display="none";
		                 document.getElementById("tab1").className="tab";
			             document.getElementById("tab2").className="tab cur";
			             document.getElementById("tab3").className="tab";
                     document.getElementById("taba1").setAttribute("style","cursor: pointer;");
                     document.getElementById("taba2").setAttribute("style","cursor: default;");
                     document.getElementById("taba3").setAttribute("style","cursor: pointer;");
		                 break;
		        case 3 : 
		/**
		 *                  alert("DOM 对象处理语句未完全执行···3");
		 */
		                 document.getElementById("contentdiv1").style.display="none";
		                 document.getElementById("contentdiv2").style.display="none";
		                 document.getElementById("contentdiv3").style.display="block";
		                 document.getElementById("tab1").className="tab";
			             document.getElementById("tab2").className="tab";
			             document.getElementById("tab3").className="tab cur";
                     document.getElementById("taba1").setAttribute("style","cursor: pointer;");
                     document.getElementById("taba2").setAttribute("style","cursor: pointer;");
                     document.getElementById("taba3").setAttribute("style","cursor: default;");
		                 break;
		        default : break;
		    }
		}
        function checkBoxLoad()
        {   
            if (<?php echo ($flagsize0); ?> == 1)
            {
               document.getElementById("policyfsize").checked = true; 
            }
            if (<?php echo ($flagtype0); ?> == 1)
            {
               document.getElementById("policyftype").checked = true; 
            }
            if (<?php echo ($flagexpires0); ?> == 1)
            {
               document.getElementById("policyexpires").checked = true; 
            }
            if (<?php echo ($flagfreq0); ?> == 1)
            {
               document.getElementById("policyfreq").checked = true; 
            }
        }
        function selectTagLoad()
        {

            var id1 = document.getElementById("selectTag1");
            var id2 = document.getElementById("selectTag2");
            var id3 = document.getElementById("selectTag3");
            id1.value = <?php echo ($dayofWeek0); ?>;
            id2.value = <?php echo ($ampm0); ?>;
            id3.value = <?php echo ($time0); ?>;
            
//            switch(<?php echo ($dayofWeek0); ?>)
//            {
//                case 1: id1.value = 1;break;
//                case 2: id1.value = 2;break;
//                case 3: id1.value = 3;break;
//                case 4: id1.value = 4;break;
//                case 5: id1.value = 5;break;
//                case 6: id1.value = 6;break;
//                case 7: id1.value = 7;break;
//                default: break;
//            }
            
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
                case 1 : txt.innerHTML="转存成功!";break;
                case 2 : txt.innerHTML="修改成功!";break;
                default : break;
            }
            //txt.innerHTML="修改成功!";

			document.getElementById("msgDiv").appendChild(txt);           
            switch(num)
            {
                case 1 : divselect(1);break;
                case 2 : divselect(2);break;
                default : break;
            }
            
            //$("#form1").submit();
            //alert(<?php echo ($pconfAlert0); ?>);
		}
	</script>
</head>


<body draggable="false">
	<div class="positionheader">
    <img src="./Public/Images/Gateway.png" />
</div>

<div class="Bdy">

	<div class="aside" id="aside">
		<ul class="nav">
			<li><a data-ca="aside-files" href="./Index.php" class="all-file selected"><b>存储管理</b></a>
			</li>
            <li><a data-ca="aside-outlink" href="./StatAnal.php" class="link"><b>统计分析</b></a>
		    </li>     
            <li><a data-ca="aside-apps" href="./SystemConf.php" class="apps"><b>系统设置</b></a>
			</li> 
	</div>
	
	<div id="mainer" class="noSelect loading2">
		<div id="filemangebox" class="main dn" style="display: block;">
			<div class="maint">
				<div class="mainH operatebar" id="file-operatebar">
					<!--
                    <ul class="operate operate-group">
						<li class="operate">
                        <button title="返回" id="back" class="btn back" onclick="self.history.back()" style="cursor: pointer;">
                        <i class="i"></i>
                        </button>
                        </li>                
                    </ul>
                    -->
						<div class="Tab">
							<ul class="tabs">
								<li id="tab1" class="tab cur"><a id="taba1" onclick="divselect(1)" style="cursor: default;">存储内容</a>
								<li id="tab2" class="tab"><a id="taba2" onclick="divselect(2)" style="cursor: pointer;">转存策略</a>
	                            <li id="tab3" class="tab"><a id="taba3" onclick="divselect(3)" style="cursor: pointer;">转存日志</a>
							</ul>
						</div>
				</div>
 
<!--				<div class="mainH2 search-bar" id="file-search-bar">
					<div class="path" id="file-path">
                    <li class="root-dir">当前路径：
                    <?php
 if ($_GET["fpath"]) {echo $_GET["fpath"];} else {echo "/home/gateway/nfsdir";} ?></li>
                    </div>
				</div>
                -->

			</div>

			<div class="content" style="display: block;">
              <div id="contentdiv1" style="display: block">
									<div class="mainH2 search-bar" id="file-search-bar">
                    <ul class="operate operate-group">
						<li class="operate">
                        <button title="返回" id="back" class="btn back" onclick="backBtn()" style="cursor: pointer;">
                        <i class="i"></i>
                        </button>
                        &nbsp;当前路径：
                        <?php
 if ($_GET["fpath"]) {echo $_GET["fpath"];} else {echo "/home/gateway/nfsmail";} ?>
                        </li>                                   
                    </ul>
				</div>
                
				<div class="list-view" id="file-list">
					<table class="tbl">
						<thead>
							<tr>
								<th class="col_cbox">
                                </th><th class="col_date">文件名
								</th><th class="col_date">文件位置
								</th><th class="col_date">大小/字节
								</th><th class="col_date">类型
								</th><th class="col_date">修改时间
								</th><th class="col_date">操作
						</th></tr>
                        </thead>
                        <tbody id="bodycontent" class="list-data-container">
                        
                        <?php if(is_array($fileinfo)): foreach($fileinfo as $key=>$v): ?><script type="text/javascript">
//生成文件夹显示模块js代码，采用Js DOM 对象处理，http://www.w3school.com.cn/htmldom/index.asp
if("<?php echo ($v["ftype"]); ?>" == 'd')
{var paratr=document.createElement("tr"); //生成<tr> </tr>标签
   
    var paratd1=document.createElement("td");
//        var paratd1span=document.createElement("span");//生成<span>标签，用来组合行内元素
//        paratd1span.setAttribute("class","checkbox");//设置<span>标签属性，生成节点
//        paratd1.appendChild(paratd1span);//把属性节点连接到标签节点中
      
    var paratd2=document.createElement("td");
        //paratd2.setAttribute("class","file-name folder-icon");
        //paratd2.setAttribute("class","file-name-folder-diy");
        var paratd2i=document.createElement("i");
//		    if("{$v.ftype}" == 'd'){
//			   paratd2i.setAttribute("class","i ifl i21");//文件图标jpg
//		    }else{
//			   paratd2i.setAttribute("class","i ifl i20");
//		    }
             paratd2i.setAttribute("class","i ifl i21");//文件图标jpg
        var paratd2a=document.createElement("a");
            paratd2a.setAttribute("data-ca","listView-see-folder");
            if("<?php echo ($v["ftype"]); ?>" == 'd'){
				paratd2a.setAttribute("href","http://192.168.3.6/wangpan/Index.php?fid=<?php echo ($v["fid"]); ?>&fpath=<?php echo ($v["fpath"]); ?>");//打开下一级目录标签
			}

            paratd2a.setAttribute("class","name");
            paratd2a.setAttribute("title","<?php echo ($v["fname"]); ?>");//文件名显示
            var paratd2anode=document.createTextNode("<?php echo ($v["fname"]); ?>");
            paratd2a.appendChild(paratd2anode);
            
//        var paratd2input=document.createElement("input");
//            paratd2input.setAttribute("type","text");
//            paratd2input.setAttribute("value","<?php echo ($v["fname"]); ?>");
//            paratd2input.setAttribute("class","txt rename-file-input");
        paratd2.appendChild(paratd2i);
        paratd2.appendChild(paratd2a);
//        paratd2.appendChild(paratd2input);
    
    var paratd3=document.createElement("td");
        var paratd3node;//文件状态
		switch("<?php echo ($v["fstatus"]); ?>"){
			case 'l': paratd3node=document.createTextNode("本地");break;
			case 'c': paratd3node=document.createTextNode("云存储");break;
			case 'b': paratd3node=document.createTextNode("本地 & 云存储");break;
			case 'k': paratd3node=document.createTextNode("使用中");break;
		}
		if("<?php echo ($target); ?>" == "<?php echo ($v["fid"]); ?>" || "<?php echo ($v["fstatus"]); ?>" == 'k')
			paratd3node=document.createTextNode("使用中");
		if("<?php echo ($v["ftype"]); ?>" == "d")
			paratd3node=document.createTextNode("本地 | 云存储");
		paratd3.appendChild(paratd3node);
    
    var paratd4=document.createElement("td");
        var paratd4node;//文件大小
		if("<?php echo ($v["ftype"]); ?>" == 'd'){
			paratd4node=document.createTextNode("");
        }else{
			paratd4node=document.createTextNode("<?php echo ($v["fsize"]); ?>");
		}
		paratd4.appendChild(paratd4node);
    
    var paratd5=document.createElement("td");
		var paratd5node;//文件类型
		if("<?php echo ($v["ftype"]); ?>" == 'd'){
			paratd5node=document.createTextNode("目录");
		}else{
			paratd5node=document.createTextNode("文件");
		}
        paratd5.appendChild(paratd5node);
        
    var paratd6=document.createElement("td");//访问时间
		var unixTimestamp = new Date(<?php echo ($v["atime"]); ?>* 1000);
        var paratd6node=document.createTextNode(date2str(unixTimestamp, "yy/M/d h:m:s"));
        paratd6.appendChild(paratd6node);
        
    var paratd7=document.createElement("td");
		var paratd7b=document.createElement("button");
			if("<?php echo ($target); ?>" == "<?php echo ($v["fid"]); ?>" || "<?php echo ($v["fstatus"]); ?>" == 'k'){
				//alert("hold");
				paratd7b.setAttribute("onclick", "window.location.href='http://192.168.3.6/wangpan/Index.php?fid=<?php echo ($v["fpid"]); ?>'");
			}else{
				paratd7b.setAttribute("onclick", "window.location.href='http://192.168.3.6/wangpan/Index.php?fid=<?php echo ($v["fpid"]); ?>&fpath=<?php echo ($v["fpath"]); ?>&fstatus=<?php echo ($v["fstatus"]); ?>&target=<?php echo ($v["fid"]); ?>'");
			}
			paratd7b.setAttribute("style", "color:blue");
			var paratd7bnode;
			if("<?php echo ($target); ?>" == "<?php echo ($v["fid"]); ?>" || "<?php echo ($v["fstatus"]); ?>" == 'k'){
				paratd7bnode=document.createTextNode("刷新");
			}else{
				paratd7bnode=document.createTextNode("转存");
			}
			paratd7b.appendChild(paratd7bnode);

		var paratd7b2=document.createElement("button");//详细信息
			//var paratd7b2text=<?php echo ($v["fpath"]); ?>;
			paratd7b2.setAttribute("onclick", 'sAlert("<?php echo ($v["fid"]); ?>","<?php echo ($v["fname"]); ?>","<?php echo ($v["fpath"]); ?>","<?php echo ($v["fpid"]); ?>","<?php echo ($v["fstatus"]); ?>","<?php echo ($v["ftype"]); ?>","<?php echo ($v["fdev"]); ?>","<?php echo ($v["fino"]); ?>","<?php echo ($v["fmode"]); ?>","<?php echo ($v["fnlinks"]); ?>","<?php echo ($v["fuid"]); ?>","<?php echo ($v["fgid"]); ?>","<?php echo ($v["frdev"]); ?>","<?php echo ($v["fsize"]); ?>","<?php echo ($v["dsize"]); ?>","<?php echo ($v["faddr"]); ?>","<?php echo ($v["fgen"]); ?>","<?php echo ($v["atime"]); ?>","<?php echo ($v["mtime"]); ?>","<?php echo ($v["ctime"]); ?>")');
			paratd7b2.setAttribute("title", "详细信息");
			paratd7b2.setAttribute("style", "color:blue");
			var paratd7b2node=document.createTextNode("详细信息");
			paratd7b2.appendChild(paratd7b2node);
		if("<?php echo ($v["ftype"]); ?>" != 'd'){
			paratd7.appendChild(paratd7b);
			var paratd7_=document.createTextNode(" | ");
			paratd7.appendChild(paratd7_);
		}
		paratd7.appendChild(paratd7b2);
		
		
		
    paratr.appendChild(paratd1);
    paratr.appendChild(paratd2);
    paratr.appendChild(paratd3);
    paratr.appendChild(paratd4);
    paratr.appendChild(paratd5);
    paratr.appendChild(paratd6);
	paratr.appendChild(paratd7);
    

var element=document.getElementById("bodycontent");
element.appendChild(paratr);}
</script><?php endforeach; endif; ?>      
<?php if(is_array($fileinfo)): foreach($fileinfo as $key=>$v): ?><script type="text/javascript">
//生成文件夹显示模块js代码，采用Js DOM 对象处理，http://www.w3school.com.cn/htmldom/index.asp
if("<?php echo ($v["ftype"]); ?>" != 'd')
{var paratr=document.createElement("tr"); //生成<tr> </tr>标签
   
    var paratd1=document.createElement("td");
//        var paratd1span=document.createElement("span");//生成<span>标签，用来组合行内元素
//        paratd1span.setAttribute("class","checkbox");//设置<span>标签属性，生成节点
//        paratd1.appendChild(paratd1span);//把属性节点连接到标签节点中
      
    var paratd2=document.createElement("td");
        //paratd2.setAttribute("class","file-name folder-icon");
        //paratd2.setAttribute("class","file-name-folder-diy");
        var paratd2i=document.createElement("i");
//		    if("{$v.ftype}" == 'd'){
//			   paratd2i.setAttribute("class","i ifl i21");//文件图标jpg
//		    }else{
//			   paratd2i.setAttribute("class","i ifl i20");
//		    }
               paratd2i.setAttribute("class","i ifl i20");
        var paratd2a=document.createElement("a");
            paratd2a.setAttribute("data-ca","listView-see-folder");
            if("<?php echo ($v["ftype"]); ?>" == 'd'){
				paratd2a.setAttribute("href","http://192.168.3.6/wangpan/Index.php?fid=<?php echo ($v["fid"]); ?>&fpath=<?php echo ($v["fpath"]); ?>");//打开下一级目录标签
			}

            paratd2a.setAttribute("class","name");
            paratd2a.setAttribute("title","<?php echo ($v["fname"]); ?>");//文件名显示
            var paratd2anode=document.createTextNode("<?php echo ($v["fname"]); ?>");
            paratd2a.appendChild(paratd2anode);
            
//        var paratd2input=document.createElement("input");
//            paratd2input.setAttribute("type","text");
//            paratd2input.setAttribute("value","<?php echo ($v["fname"]); ?>");
//            paratd2input.setAttribute("class","txt rename-file-input");
        paratd2.appendChild(paratd2i);
        paratd2.appendChild(paratd2a);
//        paratd2.appendChild(paratd2input);
    
    var paratd3=document.createElement("td");
        var paratd3node;//文件状态
		switch("<?php echo ($v["fstatus"]); ?>"){
			case 'l': paratd3node=document.createTextNode("本地");break;
			case 'c': paratd3node=document.createTextNode("云存储");break;
			case 'b': paratd3node=document.createTextNode("本地 & 云存储");break;
			case 'k': paratd3node=document.createTextNode("使用中");break;
		}
		if("<?php echo ($target); ?>" == "<?php echo ($v["fid"]); ?>" || "<?php echo ($v["fstatus"]); ?>" == 'k')
			paratd3node=document.createTextNode("使用中");
		if("<?php echo ($v["ftype"]); ?>" == "d")
			paratd3node=document.createTextNode("本地 | 云存储");
		paratd3.appendChild(paratd3node);
    
    var paratd4=document.createElement("td");
        var paratd4node;//文件大小
		if("<?php echo ($v["ftype"]); ?>" == 'd'){
			paratd4node=document.createTextNode("");
        }else{
			paratd4node=document.createTextNode("<?php echo ($v["fsize"]); ?>");
		}
		paratd4.appendChild(paratd4node);
    
    var paratd5=document.createElement("td");
		var paratd5node;//文件类型
		if("<?php echo ($v["ftype"]); ?>" == 'd'){
			paratd5node=document.createTextNode("目录");
		}else{
			paratd5node=document.createTextNode("文件");
		}
        if ("<?php echo ($v["curl"]); ?>" != "NULL") {
			paratd5node=document.createTextNode("硬链接");
		}
		paratd5.appendChild(paratd5node);
        
    var paratd6=document.createElement("td");//访问时间
		var unixTimestamp = new Date(<?php echo ($v["atime"]); ?>* 1000);
        var paratd6node=document.createTextNode(date2str(unixTimestamp, "yy/M/d h:m:s"));
        paratd6.appendChild(paratd6node);
        
    var paratd7=document.createElement("td");
		var paratd7b=document.createElement("button");
			if("<?php echo ($target); ?>" == "<?php echo ($v["fid"]); ?>" || "<?php echo ($v["fstatus"]); ?>" == 'k'){
				//alert("hold");
				paratd7b.setAttribute("onclick", "window.location.href='http://192.168.3.6/wangpan/Index.php?fid=<?php echo ($v["fpid"]); ?>'");
			}else{
				paratd7b.setAttribute("onclick", "window.location.href='http://192.168.3.6/wangpan/Index.php?fid=<?php echo ($v["fpid"]); ?>&fpath=<?php echo ($v["fpath"]); ?>&fstatus=<?php echo ($v["fstatus"]); ?>&target=<?php echo ($v["fid"]); ?>&zhuancunFlag=1'");
			}
			paratd7b.setAttribute("style", "color:blue");
			var paratd7bnode;
			if("<?php echo ($target); ?>" == "<?php echo ($v["fid"]); ?>" || "<?php echo ($v["fstatus"]); ?>" == 'k'){
				paratd7bnode=document.createTextNode("刷新");
			}else{
				paratd7bnode=document.createTextNode("转存");
			}
			paratd7b.appendChild(paratd7bnode);

		var paratd7b2=document.createElement("button");//详细信息
			//var paratd7b2text=<?php echo ($v["fpath"]); ?>;
			paratd7b2.setAttribute("onclick", 'sAlert("<?php echo ($v["fid"]); ?>","<?php echo ($v["fname"]); ?>","<?php echo ($v["fpath"]); ?>","<?php echo ($v["fpid"]); ?>","<?php echo ($v["fstatus"]); ?>","<?php echo ($v["ftype"]); ?>","<?php echo ($v["fdev"]); ?>","<?php echo ($v["fino"]); ?>","<?php echo ($v["fmode"]); ?>","<?php echo ($v["fnlinks"]); ?>","<?php echo ($v["fuid"]); ?>","<?php echo ($v["fgid"]); ?>","<?php echo ($v["frdev"]); ?>","<?php echo ($v["fsize"]); ?>","<?php echo ($v["dsize"]); ?>","<?php echo ($v["faddr"]); ?>","<?php echo ($v["fgen"]); ?>","<?php echo ($v["atime"]); ?>","<?php echo ($v["mtime"]); ?>","<?php echo ($v["ctime"]); ?>")');
			paratd7b2.setAttribute("title", "详细信息");
			paratd7b2.setAttribute("style", "color:blue");
			var paratd7b2node=document.createTextNode("详细信息");
			paratd7b2.appendChild(paratd7b2node);
		if("<?php echo ($v["ftype"]); ?>" != 'd'){
			if ("<?php echo ($v["curl"]); ?>" == "NULL") {
				paratd7.appendChild(paratd7b);
				var paratd7_=document.createTextNode(" | ");
				paratd7.appendChild(paratd7_);
			}
		}
		paratd7.appendChild(paratd7b2);
		
		
		
    paratr.appendChild(paratd1);
    paratr.appendChild(paratd2);
    paratr.appendChild(paratd3);
    paratr.appendChild(paratd4);
    paratr.appendChild(paratd5);
    paratr.appendChild(paratd6);
	paratr.appendChild(paratd7);
    

var element=document.getElementById("bodycontent");
element.appendChild(paratr);}
</script><?php endforeach; endif; ?>                       
                        </tr>
                            </tbody>                            
                     </table>
				</div>
              </div>
              <div id="contentdiv2" style="display: none">
					<form action="<?php echo U('Index/confModify');?>" method="post">
	<table>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
            <td></td>
            <td class="width:20px">
             自动转存执行时间：星期
             <select name="selectTag1" id="selectTag1">
              <option value="1">一</option>
              <option value="2">二</option>
              <option value="3">三</option>
              <option value="4">四</option>
              <option value="5">五</option>
              <option value="6">六</option>
              <option value="0">日</option>           
             </select> 
             <select name="selectTag2" id="selectTag2">
              <option value="0">上午</option>
              <option value="1">下午</option>
             </select>
             <select name="selectTag3" id="selectTag3">
              <option value="0">0:00</option>             
              <option value="1">1:00</option>
              <option value="2">2:00</option>
              <option value="3">3:00</option>
              <option value="4">4:00</option>
              <option value="5">5:00</option>
              <option value="6">6:00</option>
              <option value="7">7:00</option>
              <option value="8">8:00</option>
              <option value="9">9:00</option>
              <option value="10">10:00</option>
              <option value="11">11:00</option>              
             </select>  
            </td>            
            <td></td>
        </tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width:50px;"></td>
			<td><input type="checkbox" name="policyfsize" id="policyfsize"/> 文件大小阈值 &nbsp;&nbsp;&nbsp;<input type="text" name="pconfsize" style="width:40px;" value="<?php echo ($fileSize0); ?>" style="text-align:left; width:180px; height:20px; font-size:10pt;"/> MB </td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(大小大于阈值的本地文件, 将被转存至云存储)<br /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
						
		<!-- <tr>
			<td></td>
			<td><input type="checkbox" name="policyftype" id="policyftype"/> 特定文件类型 &nbsp;&nbsp;&nbsp;<input type="text" name="pconftype" value="<?php echo ($fileType0); ?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(指定的文件类型, 不列入上传白名单)<br /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr> -->
						
		<tr>
			<td></td>
			<td><input type="checkbox" name="policyexpires" id="policyexpires"/> 访问时间阈值 &nbsp;&nbsp;&nbsp;<input type="text" name="pconexpires" style="width:40px;" value="<?php echo ($expires0); ?>" style="text-align:left; width:180px; height:20px; font-size:10pt;"/>天</td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(最后访问时间超过阈值的本地文件, 将被转存至云存储)<br /></td>
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
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(使用频率少于阈值的本地文件, 将被转存至云存储)</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
        
        
		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td></td>
			<td style="text-align:center">
				<button type="submit" class="btn_ql btn_ql-primary " style="text-align:center">保存</button>
	  		</td>
		</tr>
	</table>
</form>
              </div>
              <div id="contentdiv3" style="display: none">
									<div class="list-view" id="file-list">
					<table class="tbl">
						<thead>
							<tr>
								<th class="col_cbox">
								</th><th class="col_fsize_r">文件名
								</th><th class="col_fsize">文件大小/字节
								</th><th class="col_fsize">转存方向
								</th><th class="col_fsize">转存耗时
								</th><th class="col_fsize">转存时间
								</th><th class="col_fsize">转存方式
                                </th><th class="col_fsize">文件路径
						</th></tr>
                        </thead>
                        <tbody id="bodycontent" class="list-data-container">
                        <?php if(is_array($log)): $i = 0; $__LIST__ = $log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                              <td></td>
                              <td><?php echo ($vo["tfname"]); ?></td>
                              <td><?php echo ($vo["tfsize"]); ?></td>
                              <td><?php echo(($vo["tmethod"]) == 'u'? '本地->云端' : '云端->本地')?></td>
                              <td><?php echo ($vo["time"]); ?></td>
                              <td><?php echo ($vo["tdate"]); ?></td>
                              <td><?php echo($vo["tstrategy"]) == 's'? '手动' : '自动'?></td>
                              <td><?php echo ($vo["tpath"]); ?></td>
                          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                 
                        </tr>
                            </tbody>                            
                     </table>
				</div>

              </div>              
	    	</div>
		</div>
    </div>
</div>
<script type="text/javascript">checkBoxLoad()</script>
<script type="text/javascript">selectTagLoad()</script>
<?php if ($_GET['zhuancunFlag'] == 1){?>
<script type="text/javascript">pAlert(1);</script>
<?php } ?>
<?php if (($pconfAlert0) == 2){?>
<script type="text/javascript">pAlert(2);</script>
<?php } ?>

<!--<script type="text/javascript">backBtn()</script> -->
<!--
<script data-main="//j2.s.ksyun.com/pan/v1.1/1378294456726/app/home/main" src="./Public/2.1.8.js" type="text/javascript"></script>
-->

</body>
</html>