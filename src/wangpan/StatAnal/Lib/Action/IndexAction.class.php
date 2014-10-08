<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){

        //容量统计
    	$data = M('analyse')->find('1');
	    $this->cloudUsed = number_format($data['cloudUsed']/1073741824,2);
	    $this->cloudTotal = number_format($data['cloudTotal']/1073741824,2);
	    $this->localUsed = number_format($data['localUsed']/1073741824,2);
	    $this->localTotal = number_format($data['localTotal']/1073741824,2);
        $log = M('translog')->select();
        $this->assign('log',$log);
        
        //转存频度统计
        $frqModle = M('frequency');
        $this->frqData = M('frequency')->query('select * from frequency order by date desc limit 0,8');
    
        //显示模板
		$this->display();


    }
}
?>