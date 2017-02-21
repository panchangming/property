<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/2/18
 * Time: 10:49
 */

namespace common\logic;


class NestedMysql implements DbMysqlInt
{

    /**
     * DB connect
     *
     * @access public
     *
     * @return resource connection link
     */
    public function connect()
    {
        // TODO: Implement connect() method.
    }

    /**
     * Disconnect from DB
     *
     * @access public
     *
     * @return viod
     */
    public function disconnect()
    {
        // TODO: Implement disconnect() method.
    }

    /**
     * Free result
     *
     * @access public
     * @param resource $result query resourse
     *
     * @return viod
     */
    public function free($result)
    {
        // TODO: Implement free() method.
    }

    /**
     * Execute simple query
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return resource|bool query result
     */
    public function query($sql, $args = array())
    {
        $args = func_get_args();

        $sql = $this->_buildSql($args);

        return \Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * Insert query method
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return int|false last insert id
     */
    public function insert($sql, $args = array())
    {
        $args = func_get_args();
        $sql = $args[0];
        $tableName = $args[1];
        $params = $args[2];

        \Yii::$app->db->createCommand()->insert($tableName,$params)->execute();
        return \Yii::$app->db->getLastInsertID();
    }

    /**
     * Update query method
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return int|false affected rows
     */
    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
    }

    /**
     * Get all query result rows as associated array
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array (two level array)
     */
    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.
    }

    /**
     * Get all query result rows as associated array with first field as row key
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array (two level array)
     */
    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
    }

    /**
     * Get only first row from query
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array associated data array
     */
    public function getRow($sql, $args = array())
    {
        $args = func_get_args();

        $sql = $this->_buildSql($args);
        return \Yii::$app->db->createCommand($sql)->queryOne();

    }

    private function _buildSql($args){
        $sql = array_shift($args);
        $sqls = preg_split('/\?[FTN]/',$sql);
        array_pop($sqls);
        $sql = '';
        foreach($sqls as $key=>$value){
            $sql .= $value . $args[$key];
        }
        return $sql;
    }

    /**
     * Get first column of query result
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return array one level data array
     */
    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
    }

    /**
     * Get one first field value from query result
     *
     * @access public
     * @param string $sql SQL query
     * @param array $args query arguments
     *
     * @return string field value
     */
    public function getOne($sql, $args = array()) {
        $args = func_get_args();

        $sql = $this->_buildSql($args);
        return \Yii::$app->db->createCommand($sql)->queryScalar();
        // TODO: Implement getOne() method.
    }
}