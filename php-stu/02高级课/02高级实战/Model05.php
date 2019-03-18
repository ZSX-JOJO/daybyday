<?php
    /**
     * insert into user(name,age,money) values('abc',18,123123);
     * delete from user where id=2;
     * update user set age=20, money=123123123, where id=1;
     * select * from user where id=3 group by ... having ... order by ... limit ...
     * 
     * //连贯操作
     * class Person{
     *      function test(){
     *          return $this;//返回当前对象
     *      }
     *      function demo(){
     *          return $this;
     *      }
     * }
     * $p = new Person();
     * $p->test()->demo();
     * 
     * 增删改查
     *      要结果集(查)    query
     *          返回二维数组
     *      不要结果集(增删改)  exec
     *          增加: mysqli_insert_id()
     *          删除和修改: 返回受影响的行数
     * 
     * 无顺序替换:
     * $p->table('user')->limit()->order()->field()->select();
     * $p->table('user')->order()->limit()->field()->select();
     * 中间的返回都是$this
     * 
     * limit()
     * order()
     * having()
     * group()
     * table()
     * field()
     * where()
     * 
     * options[
     *      'where' => 'where id > 10',
     *      'limit' => 'limit 3,3',
     *      'table' => 'user',
     *      'field' => 'id,name,password',
     *      'order' => '',
     *      ...
     * ]
     * select返回的是结果集
     * $sql = 'select %FIELD% FROM %TABLE% %WHERE% %GROUP% %HAVING% %ORDER% %LIMIT%';
     * 占位符 $sql = str_replace(['%FIELD%,'%TABLE%'],[$this->options['field'],$this->options['table']],$sql);
     */
/**-------------------------------------------------------------------------------------------------------------- */
    $config = include 'config05.php';
    //测试 增删改查 目前已全部通过 还需要优化
    $model = new Model05($config);//asc 升序 desc 降序
    
    var_dump($model->getByName('赵守鑫'));

    // var_dump($model->table('user2')->max('money'));//max函数测试

    // $data = ['name' => '赵守鑫','password' => '123456','money' => '6666'];
    // $insertId = $model->table('user2')->insert($data);//insert测试
    // var_dump($insertId);

    // var_dump($model->table('user2')->where('id=33')->delete());//delete测试
    
    // $data2 = ['name' => '努力努力再努力','password' => '010101','money' => '4444'];
    // var_dump($model->table('user2')->where('id=33')->update($data2));//update测试

    // var_dump($model->field('name')->table('user2')->limit('5, 10')->where('id>0')->order('age asc')->select());
    // var_dump($model->sql);//select测试 $sql虽然是受保护的成员变量 但是使用了魔术方法__get;可以读取
    class Model05{
        //主机名
        protected $host;
        //用户名
        protected $user;
        //密码
        protected $pwd;
        //数据库名字
        protected $dbname;
        // 字符集
        protected $charset;
        //数据表前缀
        protected $prefix;

        //数据库连接资源
        protected $link;
        //数据表名
        protected $tableName;
        
        //sql语句
        protected $sql;
        
        //操作数组 存放查询所有的查询条件
        protected $options;

        //构造方法
        public function __construct($config){//将主机名。。。数据表前缀存为数组
            //对成员变量一一初始化
            $this->host = $config['DB_HOST'];
            $this->user = $config['DB_USER'];
            $this->pwd = $config['DB_PWD'];
            $this->dbname = $config['DB_NAME'];
            $this->charset = $config['DB_CHARSET'];
            $this->prefix = $config['DB_PREFIX'];

            //连接数据库
            $this->link = $this->connect();
            //得到数据表名 一个表对应一个类(例如user表对应UserModel类)
            $this->tableName = $this->getTableName();
            //初始化options数组
            $this->initOptions();
        }

        //连接数据库的 方法
        protected function connect(){
            $link = mysqli_connect($this->host,$this->user,$this->pwd);
            if(!$link){
                die('数据库连接失败');
            }else{
                //选择数据库
                mysqli_select_db($link,$this->dbname);
                //设置字符集
                mysqli_set_charset($link,$this->charset);
                //返回连接成功的资源
                return $link;
            }
        }

        //得到表名
        protected function getTableName(){
            //如果设置了成员变量 通过成员变量来得到表名
            if(!empty($this->tableName)){
                return $this->prefix.$this->tableName;
            }
            //没有设置成员变量 通过类名来得到表名
            //得到当前类名字符串
            $className = get_class($this);//get_class返回对象的类名
            //例如 user UserModel goods GoodsModel
            $table = strtolower(substr($className,0,-5));//从第0个截取到 从后数第5个
            return $this->prefix.$table;
        }

        //options数组
        protected function initOptions(){
            $arr = ['where','table','field','order','group','having','limit'];
            foreach ($arr as $value) {
                $this->options[$value] = '';//将options数组中这些键所对应的值全部清空
                // 如果没有调用table方法传递表名 将table默认设置为tableName
                if($value == 'table'){
                    $this->options[$value] = $this->tableName;
                }else if($value == 'field'){
                    $this->options[$value] = '*';
                }
            }
        }
        //field方法
        function field($field){
            // 如果不为空 则进行处理
            if(!empty($field)){
                if(is_string($field)){
                    $this->options['field'] = $field;
                }else if(is_array($field)){
                    $this->options['field'] = join(',',$field);
                }
            }
            //为了连贯操作
            return $this;
        }
        //table方法
        function table($table){
            if(!empty($table)){
                $this->options['table'] = $table;
            }
            return $this;
        }
        //where方法  
        function where($where){
            if(!empty($where)){
                $this->options['where'] = 'where '.$where;
            }
            return $this;
        }
        //group方法
        function group($group){
            if(!empty($group)){
                $this->options['group'] = 'group by '.$group;
            }
            return $this;
        }
        //having方法
        function having($having){
            if(!empty($having)){
                $this->options['having'] = 'having '.$having;
            }
            return $this;
        }
        //order方法
        function order($order){
            if(!empty($order)){
                $this->options['order'] = 'order by '.$order;
            }
            return $this;
        }
        //limit方法
        function limit($limit){
            if(!empty($limit)){
                if(is_string($limit)){
                    $this->options['limit'] = 'limit '.$limit;
                }else if(is_array($limit)){
                    $this->options['limit'] = 'limit '.join(',',$limit);
                }
            }
            return $this;
        }
        //select方法
        function select(){
            //预写一个带有占位符的sql语句
            $sql = 'select %FIELD% from %TABLE% %WHERE% %GROUP% %HAVING% %ORDER% %LIMIT%';
            //将options中对应的值依次替换上面的占位符
            $sql = str_replace(
                ['%FIELD%','%TABLE%',
                    '%WHERE%','%GROUP%',
                    '%HAVING%','%ORDER%','%LIMIT%'],
                [$this->options['field'],$this->options['table'],
                    $this->options['where'],$this->options['group'],
                    $this->options['having'],$this->options['order'],$this->options['limit']],
                $sql);
            //保存一份sql语句
            $this->sql = $sql;
            //执行sql语句
            return $this->query($sql);
        }
        //query 执行 查
        function query($sql){
            //每次执行完查询后options数组中还存放着上一次的信息 所以需要清空
            $this->initOptions();
            var_dump($sql);
            // die();
            // 执行sql语句
            $result = mysqli_query($this->link,$sql);
            // 提取结果集 存放到组中
            if($result && mysqli_affected_rows($this->link)){//mysqli_affected_rows取得前一次 MySQL 操作所影响的记录行数
                while($data = mysqli_fetch_assoc($result)){//mysqli_fetch_assoc从结果集中取得一行作为关联数组
                    $newData[] = $data;
                }
            }
            //返回结果集
            // var_dump($newData);
            return $newData;
        }
        //exec 执行 增删改
        function exec($sql,$isInsert = false){
            //清空options数组
            $this->initOptions();
            $result = mysqli_query($this->link,$sql);
            if($result && mysqli_affected_rows($this->link)){
                //判断是否是插入语句 根据不同的语句返回不同的结果
                if($isInsert){
                    return mysqli_insert_id($this->link);
                }else{
                    return mysqli_affected_rows($this->link);
                }
            }
            return false;
        }
        //获取sql语句
        function __get($name){
            if($name == 'sql'){
                return $this->sql;
            }
            return false;
        }

        //insert函数 
        //$data 关联数组 键 字段名 值 字段值
        //insert into 表名(字段) value(值)
        function insert($data){
            //处理值是字符串问题 两边需要添加单引号或者双引号
            $data = $this->parseValue($data);
            //提取所有的键 就是所有的字段
            $keys = array_keys($data);//array_keys()返回数组中部分的或所有的键名
            //提取所有的值
            $values = array_values($data);//array_values()返回数组中所有的值
            //增加数据的sql语句
            $sql = 'insert into %TABLE%(%FIELD%) values(%VALUES%)';
            $sql = str_replace(
                ['%TABLE%','%FIELD%','%VALUES%'],
                [$this->options['table'],join(',',$keys),join(',',$values)],
                $sql);
            $this->sql = $sql;
            return $this->exec($sql,true);//exec执行时 需要判断是 插入 删除 还是修改
        }

        //传递进来一个数组 将数组中值为字符串的两边加上引号
        protected function parseValue($data){
            //遍历数组 判断是否为字符串 若是字符串 将其两边添加引号
            foreach ($data as $key => $value) {
                if(is_string($value)){
                    $value = '"'.$value.'"';
                }
                $newData[$key] = $value;
            }
            //返回处理后的数组
            return $newData;
        }

        //删除函数
        function delete(){
            $sql = 'delete from %TABLE% %WHERE%';
            $sql = str_replace(
                ['%TABLE%','%WHERE%'],
                [$this->options['table'],$this->options['where']],
                $sql);
            $this->sql = $sql;
            return $this->exec($sql);       
        }

        //修改函数 
        // update 表名 set 字段名=字段值, 字段名=字段值 where
        function update($data){
            //处理$data数组中值为字符串加引号的问题
            $data = $this->parseValue($data);
            //将关联数组拼接为固定格式 键=值, 键=值
            $value = $this->parseUpdate($data);
            //准备sql语句
            $sql = 'update %TABLE% set %VALUE% %WHERE%';
            $sql = str_replace(
                ['%TABLE%','%VALUE%','%WHERE%'],
                [$this->options['table'],$value,$this->options['where']],
                $sql);
            $this->sql = $sql;
            return $this->exec($sql);
        }

        protected function parseUpdate($data){
            foreach($data as $key => $value){
                $newData[] = $key.'='.$value;
            }
            return join(',',$newData);
        }

        //max函数
        function max($field){
            $result = $this->field('max('.$field.') as max')
                ->select();
            //select方法返回的是一个二维数组
            return $result[0]['max'];
        }

        // 析构方法
        function __destruct(){
            mysqli_close($this->link);
        }

        // 例如getByName getByAge
        function __call($name,$args){
            //获取前5个字符
            $str = substr($name,0,5);
            //获取后面的字段名
            $field = strtolower(substr($name,5));
            //判断前五个字符是否是getBy
            if($str == 'getBy'){
                return $this->where($field.'="'.$args[0].'"')->select();
            }
            return false;
        }
    }
?>