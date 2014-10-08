<?php

class IndexAction extends Action {
    public function index(){

	if(!empty($_GET['target'])){
		system("/home/gateway/swiftclientC/swiftclientc -p ".$_GET['fpath']);//此处插入操作. zl
		//$this->target=$_GET['target'];
	}
    //实例化tranlog表，转存日志
    $log = M('translog')->order('tdate desc')->select();
    $this->assign('log',$log);
    
       //实例化policy表，转存策略
       //$this->assign('policy',M('policy')->select());  //读取policy表对象
        $data = M('policy')->find('0');
//        print_r($data);
//        die;
//        $data1 = M('fileinfo')->find('0');
//        print_r($data1);
//        die;
        //$this->pconf = $data;
        
        $this->fileSize0 = $data['fileSizeth'];
        $this->expires0 = $data['expires'];
        $this->fileType0 = $data['fileType'];
        $this->freq0 = $data['freq'];
        $this->ipaddr0 = $data['ipaddr'];
        $this->user0 = $data['user'];
        $this->passwd0 = $data['passwd'];
        $this->flagsize0 = $data['flagsize'];
        $this->flagexpires0 = $data['flagexpires'];
        $this->flagtype0 = $data['flagtype'];
        $this->flagfreq0 = $data['flagfreq']; 
        $this->dayofWeek0 = $data['dayofWeek'];
        $time = $data['timeofDay']%12;
        $this->time0 = $time;
        if($data['timeofDay']<12)
        {$this->ampm0 = 0;}
        else{$this->ampm0 = 1;}
        
        //提示窗口参数
        $this->pconfAlert0=$_GET['pconfAlert'];
            
    //主显示模块
	$IDGET = $_GET['fid'];//获取所点击文件夹的id，搜索fpid=$_GET['fid']的文件以显示
	$map['fpid'] = $IDGET;//查询条件语句，
	if (!$IDGET){         //判断是否根目录
		$this->assign('fileinfo',M('fileinfo')->where('fpid=1')->select())->display();
        }else{
		$this->assign('fileinfo',M('fileinfo')->where($map)->select())->display();
	}        
}

//修改转存策略函数
    public function confModify(){
        $policy = M('policy');  //实例化policy表

//转存策略标签        
        if ($_POST['policyfsize']){$data['flagsize'] = 1;}else{$data['flagsize'] = 0;}
//        if ($_POST['policyftype']){$data['flagtype'] = 1;}else{$data['flagtype'] = 0;}
        if ($_POST['policyexpires']){$data['flagexpires'] = 1;}else{$data['flagexpires'] = 0;}
        if ($_POST['policyfreq']){$data['flagfreq'] = 1;}else{$data['flagfreq'] = 0;}      

//读取表单提交的数据
        $data['fileSizeth'] = $_POST['pconfsize'];
        $data['expires'] = $_POST['pconexpires'];  
//        $data['fileType'] = $_POST['pconftype'];
        $data['freq'] = $_POST['pconfreq'];
        $data['dayofWeek'] = $_POST['selectTag1'];
        $data['timeofDay'] = $_POST['selectTag2']*12+$_POST['selectTag3'];
        
        $map['id'] = array('eq','0');       //数据查询语句，固定格式
        $policy->where($map)->data($data)->save();  //更新数据库相应项
        
//        print($_POST['selectTag1']);
//        die;
//        $this->pconfAlert = $_GET['pconfAlert'];   
        $this->redirect(U('Index/index?pconfAlert=2'));      
//        $this->success('转存方式修改成功',U('Index/index'));

    }
//	public function f1(){
//		echo xx;
//		exec("ls /tmp");
//	}
}
?>