<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:53
 */

namespace app\admin\model;


use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use think\Db;
use ZipStream\ZipStream;

class Bookcase extends Common
{

    public $oneToMany = [
        'drawer' => 'pid'
    ];

    public function add($data)
    {
        if (empty($data)) {
            return returnJson(602, 400, '添加参数不能为空');
        }

        if (empty($data['norms'])) {
            return returnJson(602, 400, '抽屉规格不能为空');
        }

        $data['create_user'] = session('id');
        $data['modify_user'] = session('id');
        $data['number'] = 'ttbk'.strtotime('now').$this->create_key(3);

        $this->startTrans();
        try {
            //添加主表
            $result = $this->validate(true)->allowField($this->addallow)->validate(true)->save($data);
            if ($result == false)
                return returnJson(603, 400, $this->getError());
            $drawer = $this->createDrawers(['pid' => $this->getAttr('id')], $data['norms']);
            $this->table('drawer')->insertAll($drawer);
            $this->createQrcodes($data['number'], $drawer);
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            return returnJson(603, 400, $e->getMessage());
        }  catch (\Error $e) {
            $this->rollback();
            return returnJson(603, 400, $e->getMessage());
        }
        return returnJson(702, 200, $this->toArray());
    }

    private function createDrawers($data, $norms)
    {
        $drawer = [];
        $no = 'dra';
        $time = strtotime('now');
        $date = date('Y-m-d H:i:s', $time);
        $norms = explode(',', $norms);
        for ($i = 1; $i <= $norms[0]; $i++) {
            for ($j = 1; $j <= $norms[1]; $j++) {
                $tmp = $data;
                $tmp['row'] = $i;
                $tmp['col'] = $j;
                $tmp['number'] = $no.$time.$this->num2str($i, 3);
                $tmp['create_user'] = session('id');
                $tmp['modify_user'] = session('id');
                $tmp['create_time'] = $date;
                $tmp['modify_time'] = $date;
                array_push($drawer, $tmp);
            }
        }
        return $drawer;
    }

    private function create_key($length)
    {
        $randkey = '';
        for ($i = 0; $i < $length; $i++) {
            $randkey .= chr(mt_rand(48, 57));
        }
        return $randkey;
    }

    private function num2str($num,$length)
    {
        $num_str = (string)$num;
        $num_strlength = count($num_str);
        if ($length > $num_strlength) {
            $num_str=str_pad($num_str,$length,"0",STR_PAD_LEFT);
        }
        return $num_str;
    }

    public function getByArea($data, $page = 1, $limit = 10)
    {
        if (empty($data['search'])) {
            return returnJson(607, 400, '搜索不能为空');
        } else {
            $area = $this->table('area')
                ->where('number',$data['search'])
                ->whereOr('name', $data['search'])
                ->find();
            if (is_null($area)) {
                return returnJson(608, 400, '没有此区域');
            }

            $result = $this->where('area', $area->getAttr('id'))
                ->paginate($limit, false, ['page' => $page]);

            return returnJson(701, 200, $result);
        }
    }

    public function getManage($data, $returnType = 1)
    {
        if (empty($data['id'])) {
            return returnJson(607, 400, '缺少ID');
        }

        $info = [];
        $drawer = new Drawer;
        $info['isnventory'] = $drawer->where('pid', $data['id'])
            ->where('state', 2)->count();

        $info['catalog'] = $drawer->alias('a')
            ->where('a.pid', $data['id'])
            ->join('books bs', 'a.bid=bs.id', 'LEFT')
            ->field('distinct bs.name,bs.author,bs.press')
            ->select();

        $info['kong'] = $drawer->where('pid', $data['id'])
            ->where('state', 1)->count();

        if ($returnType == 1)
            return returnJson(701, 200, $info);
        elseif ($returnType == 2)
            return $info;
    }

    public function getInfo($id, $returnType = 1)
    {
        $info = [];
        $info['books'] = $drawer->alias('a')
            ->where('pid', $id)
            ->field('a.state, a.num')
            ->join('books bs', 'a.bid=bs.id', 'LEFT')
            ->join('book b', 'b.id=bs.id', 'LEFT')
            ->field('b.name, b.isbn')
            ->join('btype bt', 'bt.id=b.type', 'LEFT')
            ->field('bt.name')
            ->select();

        if ($returnType == 1)
            return returnJson(701, 200, $info);
        elseif ($returnType == 2)
            return $info;
    }

    protected function createQrcodes($dirname, $data)
    {
        $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . $dirname;
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
            $this->createQrcode($dirname, $dirname, $path);
            foreach ($data as $item) {
                $this->createQrcode($item['number'], $item['number'], $path);
            }
        } else {
            throw Exception('此二维码文件夹已经存在');
        }
    }

    protected function createQrcode($message, $filename, $path)
    {
        $qrcode = new QrCode($message);
        $qrcode->setLogoPath(ROOT_PATH . 'public' . DS . 'logo.png');
        $qrcode->setLogoWidth(60);
        $qrcode->setErrorCorrectionLevel(ErrorCorrectionLevel::QUARTILE);
        $qrcode->writeFile($path. DS . $filename .'.png');
    }
}