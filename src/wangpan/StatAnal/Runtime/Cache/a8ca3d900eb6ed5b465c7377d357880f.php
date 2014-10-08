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
    //视图切换函数
		function divselect(num){
	        switch (num){
		         case 1 : 
                     document.getElementById("contentdiv1").style.display="block";//可见性设置
		             document.getElementById("contentdiv2").style.display="none";
		             //document.getElementById("contentdiv3").style.display="none";
		             document.getElementById("tab1").className="tab cur";//标签亮度设置
		             document.getElementById("tab2").className="tab";
		            // document.getElementById("tab3").className="tab";
	                 document.getElementById("taba1").setAttribute("style","cursor: default;");//移到页面切换标签上时显示鼠标或手指
	                 document.getElementById("taba2").setAttribute("style","cursor: pointer;");
	                 //document.getElementById("taba3").setAttribute("style","cursor: pointer;");
	                 break;
		        case 2 : 
	                 document.getElementById("contentdiv1").style.display="none";
	                 document.getElementById("contentdiv2").style.display="block";
	                 //document.getElementById("contentdiv3").style.display="none";
	                 document.getElementById("tab1").className="tab";
	                 document.getElementById("tab2").className="tab cur";
	                 //document.getElementById("tab3").className="tab";
                     document.getElementById("taba1").setAttribute("style","cursor: pointer;");
                     document.getElementById("taba2").setAttribute("style","cursor: default;");
                     //document.getElementById("taba3").setAttribute("style","cursor: pointer;");
	                 break;
//		        case 3 : 
//	                 // document.getElementById("contentdiv1").style.display="none";
//	                 document.getElementById("contentdiv2").style.display="none";
//	                 document.getElementById("contentdiv3").style.display="block";
//	                 // document.getElementById("tab1").className="tab";
//	                 document.getElementById("tab2").className="tab";
//	                 document.getElementById("tab3").className="tab cur";
//                     // document.getElementById("taba1").setAttribute("style","cursor: pointer;");
//                     document.getElementById("taba2").setAttribute("style","cursor: pointer;");
//                     document.getElementById("taba3").setAttribute("style","cursor: default;");
//	                 break;
		        default : break;
		    }
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
		<li><a data-ca="aside-files" href="./Index.php" class="all-file"><b>存储管理</b></a>
		</li>
        <li><a data-ca="aside-outlink" data-pv="" href="./StatAnal.php" class="link selected"><b>统计分析</b></a>
	    </li>
        <li><a data-ca="aside-apps" data-pv="" href="./SystemConf.php" class="apps"><b>系统设置</b></a>
		</li>
</div>


	
		<div id="mainer" class="noSelect loading2">           
			<div id="filemangebox" class="main dn" style="display: block;">
				<div class="maint" style="display: block;">
					<div class="mainH operatebar">
						<div class="Tab">
							<ul class="tabs">
								<li id="tab1" class="tab cur"><a id="taba1" onclick="divselect(1)" style="cursor: default;">存储容量</a>
								<li id="tab2" class="tab"><a id="taba2" onclick="divselect(2)" style="cursor: pointer;">转存频度</a>
	                  <!--          <li id="tab3" class="tab"><a id="taba3" onclick="divselect(3)" style="cursor: pointer;">转存日志</a>  -->
							</ul>
						</div>
					</div>
				</div>
				<div class="content" style="display: block;">	    	
				  <div id="contentdiv1" style="display: block">
					<!-- 存储容量 -->

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
	google.load("visualization", "1", {packages:["treemap"]});
    google.setOnLoadCallback(cloudDrawChart);
    google.setOnLoadCallback(localDrawChart);
  	google.setOnLoadCallback(volumeDrawChart);
    
    //容量对比图表
    function volumeDrawChart() {
	    // Create and populate the data table.
	    var data = google.visualization.arrayToDataTable([
	        ['Location', 'Parent', 'Market trade volume (size)', 'Market increase/decrease (color)'],
	        ['存储使用总量(<?php echo ($cloudUsed+$localUsed); ?>GB)',	null,		0,	0],
	        ['云存储使用量(<?php echo ($cloudUsed); ?>GB)',		'存储使用总量(<?php echo ($cloudUsed+$localUsed); ?>GB)',	<?php echo ($cloudUsed); ?>,	100],
            ['本地存储使用量(<?php echo ($localUsed); ?>GB)',    '存储使用总量(<?php echo ($cloudUsed+$localUsed); ?>GB)', <?php echo ($localUsed); ?>,   0],            
	    ]);

	    // Create and draw the visualization.
	    var tree = new google.visualization.TreeMap(document.getElementById('volumeChart'));
	    tree.draw(data, {
	        minColor: '#FAC842',
	        midColor: '#FFFFFF',
	        maxColor: '#0B9DEC',
	        headerColor:'#F5F5F5',
	        headerHeight: 20,
	        textStyle: {	color: 'black', 
	          				bold: true,
	          				fontSize: 14},
	        showScale: false
	    });
    }

    //云存储容量图表
    function cloudDrawChart() {
    	//图表数据
        var data = google.visualization.arrayToDataTable([
        	['Task', '比率'],
        	['已使用/GB',    <?php echo ($cloudUsed); ?>],
        	['未使用/GB',    <?php echo ($cloudTotal); ?>-<?php echo ($cloudUsed); ?>]
        ]);
        //图表选项
        var options = {
        	// 标题
          	title: '云存储',
          	titleTextStyle: {	color: 'black', 
	          				bold: true,
	          				fontSize: 14},
	        colors: ['#0B9DEC','#61BFA4'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('cloudPieChart'));
        chart.draw(data, options);
    }

    //本地容量图表
    function localDrawChart() {
    	//图表数据
        var data = google.visualization.arrayToDataTable([
        	['Task', '比率'],
        	['已使用/GB',    <?php echo ($localUsed); ?>],
        	['未使用/GB',    <?php echo ($localTotal); ?>-<?php echo ($localUsed); ?>]
        ]);
        //图表选项
        var options = {
        	// 标题
          	title: '本地存储',
          	titleTextStyle: {	color: 'black', 
	          				bold: true,
	          				fontSize: 14},
	        colors: ['#FAC842','#61BFA4'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('localPieChart'));
        chart.draw(data, options);
    }

</script>

<table style="margin-left: auto; margin-right: auto;" >
<tbody>
    <tr>
        <td>&nbsp;</td>
    </tr>
	<tr>
		<td colspan="2">
			<div id="volumeChart" style="display: block; margin-left: auto; margin-right: auto; width: 800px; height: 65px;"></div>
		</td>
	</tr>
	<tr>
		<td>
			<div id="cloudPieChart" style="display: block; margin-left: auto; margin-right: 0; width: 400px; height: 400px;"></div>
		</td>
		<td>
			<div id="localPieChart" style="display: block; margin-left: 0; margin-right: auto; width: 400px; height: 400px;"></div>
		</td>
	</tr>
</tbody>
</table>
		    	  </div>

				  <div id="contentdiv2" style="display:none">
				  	<!-- 转存频度 -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1', {packages: ['corechart']});
</script>
<script type="text/javascript">
  //转存数量图表
	function dateCntChartDraw() {
    //读取数据库数据
    var freCNTDataDB = [
     ['日期', '转存总数/个',  '上传数量/个', '下载数量/个'],    
     ['<?php echo ($frqData[7]['date']); ?>',  <?php echo ($frqData[7]['uploadCNT']); ?>+<?php echo ($frqData[7]['downloadCNT']); ?>,<?php echo ($frqData[7]['uploadCNT']); ?>, <?php echo ($frqData[7]['downloadCNT']); ?>],
     ['<?php echo ($frqData[6]['date']); ?>',  <?php echo ($frqData[6]['uploadCNT']); ?>+<?php echo ($frqData[6]['downloadCNT']); ?>,<?php echo ($frqData[6]['uploadCNT']); ?>, <?php echo ($frqData[6]['downloadCNT']); ?>],
     ['<?php echo ($frqData[5]['date']); ?>',  <?php echo ($frqData[5]['uploadCNT']); ?>+<?php echo ($frqData[5]['downloadCNT']); ?>,<?php echo ($frqData[5]['uploadCNT']); ?>, <?php echo ($frqData[5]['downloadCNT']); ?>],
     ['<?php echo ($frqData[4]['date']); ?>',  <?php echo ($frqData[4]['uploadCNT']); ?>+<?php echo ($frqData[4]['downloadCNT']); ?>,<?php echo ($frqData[4]['uploadCNT']); ?>, <?php echo ($frqData[4]['downloadCNT']); ?>],  
     ['<?php echo ($frqData[3]['date']); ?>',  <?php echo ($frqData[3]['uploadCNT']); ?>+<?php echo ($frqData[3]['downloadCNT']); ?>,<?php echo ($frqData[3]['uploadCNT']); ?>, <?php echo ($frqData[3]['downloadCNT']); ?>],
     ['<?php echo ($frqData[2]['date']); ?>',  <?php echo ($frqData[2]['uploadCNT']); ?>+<?php echo ($frqData[2]['downloadCNT']); ?>,<?php echo ($frqData[2]['uploadCNT']); ?>, <?php echo ($frqData[2]['downloadCNT']); ?>], 
     ['<?php echo ($frqData[1]['date']); ?>',  <?php echo ($frqData[1]['uploadCNT']); ?>+<?php echo ($frqData[1]['downloadCNT']); ?>,<?php echo ($frqData[1]['uploadCNT']); ?>, <?php echo ($frqData[1]['downloadCNT']); ?>],
     ['<?php echo ($frqData[0]['date']); ?>',  <?php echo ($frqData[0]['uploadCNT']); ?>+<?php echo ($frqData[0]['downloadCNT']); ?>,<?php echo ($frqData[0]['uploadCNT']); ?>, <?php echo ($frqData[0]['downloadCNT']); ?>],  
    ];

    var data = google.visualization.arrayToDataTable(freCNTDataDB);
    
    //图表参数
    var options = {
      title : '转存文件数量分析',
      vAxis: {title: "文件数"},
      hAxis: {
        title: "日期",
        showTextEvery: 2,
        textStyle:{ 
              bold: false,
              italic: false },
      },
      colors:['#D9655D',
              '#0B9DEC',
              '#FADC42'],
      height: 400,
      width:  1200,
      chartArea:{
          width:"50%",
          height:"70%",
      },
      seriesType: "bars",
      series: {
      		// 1: {type: "line"},
      		// 2: {type: "line"}
  		}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('dateCntChart'));
    chart.draw(data, options);
  }

  //转存大小图表
  function dateVolumeChartDraw() {
    //读取数据库数据    
    var freVolumeDataDB = [
    ['日期', '转存总数/字节',  '上传大小/字节', '下载大小/字节'],
    ['<?php echo ($frqData[7]['date']); ?>',<?php echo ($frqData[7]['uploadSize']); ?>+<?php echo ($frqData[7]['downloadSize']); ?>,<?php echo ($frqData[7]['uploadSize']); ?>,<?php echo ($frqData[7]['downloadSize']); ?>],
    ['<?php echo ($frqData[6]['date']); ?>',<?php echo ($frqData[6]['uploadSize']); ?>+<?php echo ($frqData[6]['downloadSize']); ?>,<?php echo ($frqData[6]['uploadSize']); ?>,<?php echo ($frqData[6]['downloadSize']); ?>],
    ['<?php echo ($frqData[5]['date']); ?>',<?php echo ($frqData[5]['uploadSize']); ?>+<?php echo ($frqData[5]['downloadSize']); ?>,<?php echo ($frqData[5]['uploadSize']); ?>,<?php echo ($frqData[5]['downloadSize']); ?>],
    ['<?php echo ($frqData[4]['date']); ?>',<?php echo ($frqData[4]['uploadSize']); ?>+<?php echo ($frqData[4]['downloadSize']); ?>,<?php echo ($frqData[4]['uploadSize']); ?>,<?php echo ($frqData[4]['downloadSize']); ?>],
    ['<?php echo ($frqData[3]['date']); ?>',<?php echo ($frqData[3]['uploadSize']); ?>+<?php echo ($frqData[3]['downloadSize']); ?>,<?php echo ($frqData[3]['uploadSize']); ?>,<?php echo ($frqData[3]['downloadSize']); ?>],  
    ['<?php echo ($frqData[2]['date']); ?>',<?php echo ($frqData[2]['uploadSize']); ?>+<?php echo ($frqData[2]['downloadSize']); ?>,<?php echo ($frqData[2]['uploadSize']); ?>,<?php echo ($frqData[2]['downloadSize']); ?>],
    ['<?php echo ($frqData[1]['date']); ?>',<?php echo ($frqData[1]['uploadSize']); ?>+<?php echo ($frqData[1]['downloadSize']); ?>,<?php echo ($frqData[1]['uploadSize']); ?>,<?php echo ($frqData[1]['downloadSize']); ?>],
    ['<?php echo ($frqData[0]['date']); ?>',<?php echo ($frqData[0]['uploadSize']); ?>+<?php echo ($frqData[0]['downloadSize']); ?>,<?php echo ($frqData[0]['uploadSize']); ?>,<?php echo ($frqData[0]['downloadSize']); ?>]
    ];

    var data = google.visualization.arrayToDataTable(freVolumeDataDB);

    //图表参数
    var options = {
      title : '转存文件大小分析',
      vAxis: {title: "数据大小"},
      hAxis: {
        title: "日期",
        showTextEvery: 2,
        textStyle:{ 
              bold: false,
              italic: false },
      },
      height: 400,
      width:  1200,
      chartArea:{
          width:"50%",
          height:"70%",
      },
      colors:['#D9655D',
              '#0B9DEC',
              '#FADC42'],
      seriesType: "bars",
      series: {
          // 1: {type: "line"},
          // 2: {type: "line"}
      }
    };

    var chart = new google.visualization.ComboChart(document.getElementById('dateVolumeChart'));
    chart.draw(data, options);
  }
  google.setOnLoadCallback(dateCntChartDraw);
  google.setOnLoadCallback(dateVolumeChartDraw);
</script>

<table style="margin-left: auto; margin-right: auto;">
<tbody>
	<tr>
		<div id="dateCntChart" style="display: block; margin-left: auto; margin-right: auto;"></div>
	</tr>

  <tr>&nbsp;</tr>
  <tr>&nbsp;</tr>
  <tr>&nbsp;</tr>

	<tr>
    <div id="dateVolumeChart" style="display: block; margin-left: auto; margin-right: auto;"></div>
  </tr>
</tbody>
</table>
		    	  </div>

<!--				  <div id="contentdiv3" style="display:none">
				  					<div class="list-view" id="file-list">
					<table class="tbl">
						<thead>
							<tr>
								<th class="col_cbox">
								</th><th class="col_fsize_r">文件名
								</th><th class="col_fsize">文件大小
								</th><th class="col_fsize">转存方式
								</th><th class="col_fsize">转存耗时
								</th><th class="col_fsize">转存时间
								</th><th class="col_fsize">转存策略
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
                  -->
	            </div>
			</div>
	    </div>
	</div>
	<script data-main="//j2.s.ksyun.com/pan/v1.1/1378294456726/app/home/main" src="./Public/2.1.8.js" type="text/javascript"></script>

</body>
</html>