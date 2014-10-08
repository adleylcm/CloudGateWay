<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		$this->name = 'login'; // 进行模板变量赋值
        $this->message=$_GET['message'];
        $this->display();
    }

    public function loginNext(){
        //$this->success('success',R('APP://Index/index'));
        //$this->redirect(U('APP://Index/index'));
        //R('Index/test');
        if($_POST['username']=='ChinaTel'&&$_POST["password"]=='111111'){
            // $this->success('登陆成功','http://192.168.3.6/wangpan/Index.php');
            //BUG:项目间调用
            redirect('http://192.168.3.6/wangpan/Index.php');
        }else{
            // $this->error('账户名或密码错误');
            // echo"<script type="text/javascript">test</script>";
            // echo "<script type=text/javascript>test();</script>";
            $this->redirect(U('Index/index?message=1'));
        }
    }
    
    public function test()
    {
        print('test');
    }
    
}