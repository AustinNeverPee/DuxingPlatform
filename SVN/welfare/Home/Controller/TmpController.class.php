<?php
namespace Home\Controller;
use Think\Controller;
require_once "User.php";
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");

class TmpController extends Controller {
	
	/**
	 *����ģ��
	 *�޲���
	 */
	public function index() {
		$this->display();
	}
	
	/**
	 *�û������õص�ʱ�����ڷ��ظû��Ӧ�ĵص�
	 *@param @acid : string �ò�����ǰ��post��Ϣ�л��
	 *@param @uid : string �ò�����session�л��
	 *�����ԣ��ýӿڹ�������
	 */
	public function getLocation() {
		//��post��session�л�ò���
		$aid = I('post.acid');
		$uid = session('uid');

		//ʵ������Ҫ��ѯ�����ݿ�
		$allTargetLocDB = M('targetloc');
		$allSiteDB = M('site');

		//�����ݿ��ѯ�ص�id�͵ص�����
		$siteNames = array();

		//��Զ�Ӧ���ݿ����ݿ���в�ѯ
		if (!($siteIds = $allTargetLocDB->where('aid='.$aid )->getField('siteid', true))) {
			$response['status'] = 0;
			$response['msg'] = "���ݿ��ѯʧ�ܻ����ݿ�Ϊ��";
			$this->ajaxReturn($response, 'ajax');
			die();
		}

		while (list($subScipty, $siteid) = each($siteIds)) {
			array_push($siteNames, $allSiteDB->where('siteid='.$siteid)->getField('sitename'));
		}

		//��װ���ص�����
		$response['siteid'] = $siteIds;
		$response['sitename'] = $siteNames;
		$response['status'] = 1;

		//ajax����
		$this->ajaxReturn($response, 'json');
	}

	/**
	 *�û����������ʱ�����ڷ����û��ڸû�´����������
	 *@param @acid : string �ò�����ǰ��post��Ϣ�л��
	 *@param @uid : string �ò�����session�л��
	 *�����ԣ��ýӿڹ�������
	 */
	public function getAlbum() {
		//��post��session�л�ò���
		$aid = I('post.acid');
		$uid = session('uid');
		
		//ʵ������Ҫ�õ������ݿ�
		$allAlbumDB = M('album');
		
		//��Զ�Ӧ���ݿ���в�ѯ
		if (!($albumInfo = $allAlbumDB->where('uid = '.$uid." and relaid=".$aid)->field('albumid, albumname')->select())) {
			$response['status'] = 0;
			$response['msg'] = "���ݿ��ѯʧ�ܻ����ݿ�Ϊ��";
			$this->ajaxReturn($response, 'ajax');
			die();
		}
		
		//������Ҫ���ص�����
		$albumids = array();
		$albumnames = array();
		
		while(list($subScript, $entry) = each($albumInfo)) {
			array_push($albumids, $entry['albumid']);
			array_push($albumnames, $entry['albumname']);
		}
		
		//��װ��������
		$response = array();
		$response['albumid'] = $albumids;
		$response['albumname'] = $albumnames;
		$response['status'] = 1;
		
		//ajax����
		$this->ajaxReturn($response, 'json');
	}
	
	/**
	 *�û�����½���ᣬ����ִ���û��½���������
	 *@param @acid : string ��ǰ��post�����л��
	 *@param @uid : string  ��session�л��
	 *@param @siteid : string ��ǰ��post�����л��
	 *@param @albumname : string ��ǰ��post�����л��
	 *@param @description : string ��ǰ��post�����л��
	 *�ýӿڻ���������һ��д������ʱ�����ݿ�����������⣡
	 */
	public function addAlbum() {
		
		//��ǰ�˺�session��ȡ���û�id
		$uId	= session('uid');
		$acId	= I('post.acid');
		$siteId = I('post.siteid');
		$album	= I('post.albumname');
		$descr	= I('post.description');
		/*$acId = 1;
		$siteId = 1;
		$album = "Ħ�Ĵ��ڿ�";
		$descr = "����һ���ò�";*/
		
		//ʵ������Ҫ�õ����ݿ�
		$allAlbumDB = M('album');
		
		//����д�����ݿ������
		$data['uid']		= $uId;
		$data['createdt']	= date("Y-m-d H:i:s", time());
		$data['albumname']	= $album;
		$data['albumdescrp']= $descr;
		$data['relaid']		= $acId;
		$data['relsiteid']	= $siteId;
		
		//д�����ݿ⣡
		if (!($allAlbumDB->data($data)->add())) {
			$response = array();
			$response['status'] = 0;
			$response['msg'] = '�½����ʧ�ܣ�';
			$this->ajaxReturn($response, 'json');
			die();
		}
		
		//��װ�������ݣ�
		$response = array();
		$response['status'] = 1;
		
		//ajax��������
		$this->ajaxReturn($response, 'json');
		
	}

	/**
	 *�û�����ϴ�ͼƬ�󣬽�ͼƬ��Ϣд�뵽���ݣ�������Ӧ�ļ��ŵ�ָ���û�Ŀ¼
	 *@param @uId : string �ò�����session�л��
	 *@param @acid : string �ò�����ǰ��post��Ϣ���ݹ���
	 *@param @siteid : string �ò�����ǰ��post��Ϣ���ݹ���
	 *@param @albumid : string �ò�����ǰ��post��Ϣ���ݹ���
	 *�����ԣ��ýӿڹ�������
	 */
	public function upload() {
		
		//�궨��ͷ�����ͣ�
		define('ICON', 1);
		
		//������Ҫ�õ����ݿ�
		$allImageDB		= M('image');
		$allUserDB 		= M('user');
		$allSiteRelImgDB = M('siterelimg');
		$allActRelImgDB = M('actrelimg');
		
		//��ǰ�˻�ȡ�û�id���id���ص�id�����id
		$uId		= session('uid');
		$acId		= I('post.acid');
		$siteId 	= I('post.siteid');
		$albumId	= I('post.albumid');

		//�����û��ϴ�ͼƬ��Ŀ���ļ���
		$userName = $allUserDB->where('uid='.$uId)->getField('uname');
		$targetFolder = '/welfare/Common/Static/resources/'.$userName.'/';

		if (!empty($_FILES)) {
			//�ڷ�������Ŀ¼��ָ���ļ��ϴ���·��
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].$targetFolder;

			//���ú��뼶���ʱ���������ϴ����ļ�
			//�и�� microtime()�����������ݸ�ʽ 0.25139300 1138197510�еĵ�
			$nodot = explode(".", microtime());
			$namestr = str_replace(' ', '', $nodot[1]);
			$uptype = explode(".", $_FILES["Filedata"]["name"]);
			$newname = $namestr.".".$uptype[1];
			$_FILES["Filedata"]["name"] = $newname;

			//��λĿ���ļ�welfare/Common/Static/resources/$userName/xxxxx.jpg
			$targetFile = $targetPath.$_FILES['Filedata']['name'];

			//��֤�ļ���׺���Ƿ��ǹ涨������
			$fileTypes = array('jpg', 'jpeg', 'pjpeg', 'gif', 'png');
			$fileParts = pathinfo($_FILES['Filedata']['name']);

			//��ͼƬ���������Ϣд�뵽���ݿ�
			if (in_array($fileParts['extension'],$fileTypes)) {
				
				//������Ҫд�����ݿ��ͼƬ��Ϣ
				$dataForImg['uid'] = $uId;
				$dataForImg['imgpath'] = $userName.'/'.$_FILES["Filedata"]["name"];
				$dataForImg['imgdt'] = date('Y-m-d H:i:s', time());
				$dataForImg['albumid'] = $albumId;
				$dataForImg['imgtype'] = ICON;
				
				//��ͼƬ��Ϣ���뵽���ݿ⣬ʧ�������ò����쳣
				if (!($allImageDB->data($dataForImg)->add())) {
					die();
				} else {
					
					//ˢ�����ݿ⣬��ѯ�ոճ������ݿ��ͼƬ����
					$allImageDB		= M('image');
					$iid = $allImageDB->where($dataForImg)->getField('iid');

					//������Ҫд�����ݿ��ͼƬ�ͻ��������Ϣ
					$dataForAct['actrelimgid'] = $iid;
					$dataForAct['aid'] = $uId;

					//��ͼƬ�ͻ������Ϣд�����ݿ⣬ʧ�������ò����쳣
					if (!($allActRelImgDB->data($dataForAct)->add())) {
						
						//ɾ����ǰд�����ݿ��ͼƬ��Ϣ��ʧ�������ò����쳣
						if (!($allImageDB->where($dataForImg)->delete())) {
							die();
						}

						die();
					} else {

						//ˢ�����ݿ�
						$allImageDB		= M('image');
						$allActRelImgDB = M('actrelimg');

						//������Ҫд�����ݿ��ͼƬ�͵ص��������Ϣ
						$dataForSite['siterelimgid'] = $iid;
						$dataForSite['siteid'] = $siteId;

						//��ͼƬ�͵ص��������Ϣд�����ݿ⣬ʧ�������ò����쳣
						if (!($allSiteRelImgDB->data($dataForSite)->add())) {
							
							//ɾ����ǰд�����ݿ��ͼƬ��Ϣ��ʧ�������ò����쳣
							if (!($allImageDB->where($dataForImg)->delete())) {
								die();
							}
							
							//ɾ����ǰд�����ݿ��ͼƬ�ͻ�Ĺ�����Ϣ��ʧ�������ò����쳣
							if (!($allActRelImgDB->where($dataForAct)->delete())) {
								die();
							}

							die();
						} else {
							//д���ݿ�ɹ�����ͼƬ������ָ��Ŀ¼��
							move_uploaded_file($tempFile,$targetFile);
							echo '1';
						}
					}
				}
			} else {
				echo 'Invalid file type.';
			}
		}
	}

	/**
	 *������˽�й��ߺ�������̨�쳣ʱ����ǰ�˷����쳣��Ϣ
	 *@param $error : $string�������ô�����ʾ��Ϣmsg
	 *�����ԣ��ú�����������
	 */
	private function setException($error) {
		$response = array();
		$response['status'] = 0;
		$response['msg'] = $error;
		$this-ajaxReturn($response, 'ajax');
	}

	/**
	 *������˽�й��ߺ��������ں�̨����ʱд����־
	 *@param $record : $string�������ô�����ʾ��Ϣmsg
	 *�����ԣ��ú�����������
	 */
	private function myLog($record) {
        $handle = fopen("log.txt", 'a');
        fwrite($handle, $record);
        fwrite($handle, "\n");
        fclose($handle);
    }
}