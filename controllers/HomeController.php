<?php


class HomeController extends BaseController
{
    public function index()
    {
        $lavelones = new LevelOne();
        $datas = $lavelones->all()->get();
        View::render('home', $datas);
    }

    public function createLavelOne()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['levelname']) && !empty($_POST['levelname'])) {
                $name = $_POST['levelname'];
                if(isset($_POST['status']) && $_POST['status'] == 1) {
                    $status = 1;
                } else {
                    $status = 0;
                }

                $data = ['name' => $name, 'status' => $status];
                $levelone = new LevelOne();
                $levelone->save($data);
            }

            $this->back();
        }
    }

    public function createLavelTwo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['levelname'];
            $parent_level_id = $_POST['id'];
            $status = $_POST['status'];

            $levelone = new LevelOne();
            $data = $levelone->getById($parent_level_id);

            if($data['status'] != 1) {
                $data = ['level_one_id' => $parent_level_id, 'name' => $name, 'status' => $status];
                $leveltwo = new LevelTwo();
                if($leveltwo->save($data)) {
                    echo  json_encode(['status' => '1']);
                } else {
                    echo  json_encode(['status' => '0']);
                }
            }  else {
                echo  json_encode(['status' => '0']);
            }
        } else {
            echo  json_encode(['status' => '0']);
        }
    }

    public function createLavelThree()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['levelname'];
            $parent_level_id = $_POST['id'];
            $status = $_POST['status'];

            $leveltwo = new LevelTwo();
            $data = $leveltwo->getById($parent_level_id);

            if($data['status'] != 1) {
                $data = ['level_two_id' => $parent_level_id, 'name' => $name, 'status' => $status];
                $levelthree = new LevelThree();
                if($levelthree->save($data)) {
                    echo  json_encode(['status' => '1']);
                } else {
                    echo  json_encode(['status' => '0']);
                }
            }  else {
                echo  json_encode(['status' => '0']);
            }
        } else {
            echo  json_encode(['status' => '0']);
        }
    }

    public function createLavelFour()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['levelname'];
            $parent_level_id = $_POST['id'];

            $levelthree = new LevelThree();
            $data = $levelthree->getById($parent_level_id);

            if($data['status'] != 1) {
                $data = ['level_three_id' => $parent_level_id, 'name' => $name];
                $levelfour = new LevelFour();
                if($levelfour->save($data)) {
                    echo  json_encode(['status' => '1']);
                } else {
                    echo  json_encode(['status' => '0']);
                }
            }  else {
                echo  json_encode(['status' => '0']);
            }
        } else {
            echo  json_encode(['status' => '0']);
        }
    }

    public function getChildDirectory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $parent_level_id = $_POST['id'];
            $level_type = $_POST['level'];

             switch ($level_type) {
                 case  'level_two':
                     $level_name = 'LevelTwo';
                     $parent_level_id_name = 'level_one_id';
                     break;
                 case  'level_three':
                     $level_name = 'LevelThree';
                     $parent_level_id_name = 'level_two_id';
                     break;
                 case  'level_four':
                     $level_name = 'LevelFour';
                     $parent_level_id_name = 'level_three_id';
                     break;
             }

            $levels = new $level_name;
            $data = $levels->where($parent_level_id_name, '=', $parent_level_id)->get();
            echo  json_encode($data);
        }
    }

    public function getDirectoryByName(array $arr=[])
    {
        if(isset($arr[3])) {
            $name = $arr[3];
            $level_name = 'LevelFour';
            $level_class_name = 'level_four';
        } elseif (isset($arr[2])) {
            $name = $arr[2];
            $level_name = 'LevelThree';
            $level_class_name = 'level_three';
        } elseif (isset($arr[1])) {
            $name = $arr[1];
            $level_name = 'LevelTwo';
            $level_class_name = 'level_two';
        } elseif (isset($arr[0])) {
            $name = $arr[0];
            $level_name = 'LevelOne';
            $level_class_name = 'level_one';
        } else {
            $level_name = '';
        }

        if($level_name) {
            $level = new $level_name();
            $datas[] = $level->where('name', '=', $name)->get();
            $datas[]['level_class_name'] = $level_class_name;

            View::render('filter_directories', $datas);
        } else {
            echo '<h1>Data note found</h1>';
        }

    }
}