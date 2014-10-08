<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
      //$this->assign('policy',M('policy')->select());  //读取policy表对象
        $data = M('policy')->find('0');
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
        
        //提示窗口参数
        $this->pconfAlert0= $_GET['pconfAlert'];              
        $this->display();                               //显示页面模板
        }
        
//  系统配置修改函数        
//    public function confModify(){
//        $policy = M('policy');  //实例化policy表
//        
//        //print($_POST['policyfsize']);
//        if ($_POST['policyfsize']){$data['flagsize'] = 1;}else{$data['flagsize'] = 0;}
//        if ($_POST['policyftype']){$data['flagtype'] = 1;}else{$data['flagtype'] = 0;}
//        if ($_POST['policyexpires']){$data['flagexpires'] = 1;}else{$data['flagexpires'] = 0;}
//        if ($_POST['policyfreq']){$data['flagfreq'] = 1;}else{$data['flagfreq'] = 0;}        
//        
//
//
////读取表单提交的数据
//        $data['fileSizeth'] = $_POST['pconfsize'];
//        $data['expires'] = $_POST['pconexpires'];  
//        $data['fileType'] = $_POST['pconftype'];
//        $data['freq'] = $_POST['pconfreq'];
//        
//        $map['id'] = array('eq','0');       //数据查询语句
//        $policy->where($map)->data($data)->save();  //更新数据库相应项
//        
//        for($i=1; $i<=10000000; $i++){};
//        $this->redirect(U('Index/index'));
//    }
    public function confModify2(){
        $policy = M('policy');  //实例化policy表
        $data['ipaddr'] = $_POST['cloudadd'];
        $data['user'] = $_POST['clouduser'];
        $data['passwd'] = $_POST['cloudpswd'];
        $map['id'] = array('eq','0'); 
        
        if($data['ipaddr']=='192.168.3.9:5000/v2.0'&&$data['user']=='swift'&&$data['passwd']=='111111')
        {
        $policy->where($map)->data($data)->save();  //更新数据库相应项
        $this->redirect(U('Index/index?pconfAlert=2'));
        }                        
        else
        {
        $this->redirect(U('Index/index?pconfAlert=4'));    
        }
        //$this->success('云存储账号修改成功',U('Index/index'));
    }
    public function confModify3(){
                
//        			$res = 0;
//					if(empty($_POST['setupnfs'])){
//						$fileconf=file("/etc/exports");
//						foreach($fileconf as $line=> $content){
//							echo $content;		
//						}
//					}else{
						$this->res = file_put_contents('/etc/exports', $_POST['conf']);
//						$fileconf=file("/etc/exports");
//						foreach($fileconf as $line=> $content){
//							echo $content;		
//						}
//					}
        
        //$this->success('NFS配置修改成功',U('Index/index'));
        $this->redirect(U('Index/index?pconfAlert=3'));
    }
}
?>