<?php

namespace ColissimoHomeDelivery\Model\Map;

use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlices;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlicesQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'colissimo_home_delivery_price_slices' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ColissimoHomeDeliveryPriceSlicesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'ColissimoHomeDelivery.Model.Map.ColissimoHomeDeliveryPriceSlicesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'colissimo_home_delivery_price_slices';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ColissimoHomeDelivery\\Model\\ColissimoHomeDeliveryPriceSlices';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ColissimoHomeDelivery.Model.ColissimoHomeDeliveryPriceSlices';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the ID field
     */
    const ID = 'colissimo_home_delivery_price_slices.ID';

    /**
     * the column name for the AREA_ID field
     */
    const AREA_ID = 'colissimo_home_delivery_price_slices.AREA_ID';

    /**
     * the column name for the MAX_WEIGHT field
     */
    const MAX_WEIGHT = 'colissimo_home_delivery_price_slices.MAX_WEIGHT';

    /**
     * the column name for the MAX_PRICE field
     */
    const MAX_PRICE = 'colissimo_home_delivery_price_slices.MAX_PRICE';

    /**
     * the column name for the SHIPPING field
     */
    const SHIPPING = 'colissimo_home_delivery_price_slices.SHIPPING';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'AreaId', 'MaxWeight', 'MaxPrice', 'Shipping', ),
        self::TYPE_STUDLYPHPNAME => array('id', 'areaId', 'maxWeight', 'maxPrice', 'shipping', ),
        self::TYPE_COLNAME       => array(ColissimoHomeDeliveryPriceSlicesTableMap::ID, ColissimoHomeDeliveryPriceSlicesTableMap::AREA_ID, ColissimoHomeDeliveryPriceSlicesTableMap::MAX_WEIGHT, ColissimoHomeDeliveryPriceSlicesTableMap::MAX_PRICE, ColissimoHomeDeliveryPriceSlicesTableMap::SHIPPING, ),
        self::TYPE_RAW_COLNAME   => array('ID', 'AREA_ID', 'MAX_WEIGHT', 'MAX_PRICE', 'SHIPPING', ),
        self::TYPE_FIELDNAME     => array('id', 'area_id', 'max_weight', 'max_price', 'shipping', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'AreaId' => 1, 'MaxWeight' => 2, 'MaxPrice' => 3, 'Shipping' => 4, ),
        self::TYPE_STUDLYPHPNAME => array('id' => 0, 'areaId' => 1, 'maxWeight' => 2, 'maxPrice' => 3, 'shipping' => 4, ),
        self::TYPE_COLNAME       => array(ColissimoHomeDeliveryPriceSlicesTableMap::ID => 0, ColissimoHomeDeliveryPriceSlicesTableMap::AREA_ID => 1, ColissimoHomeDeliveryPriceSlicesTableMap::MAX_WEIGHT => 2, ColissimoHomeDeliveryPriceSlicesTableMap::MAX_PRICE => 3, ColissimoHomeDeliveryPriceSlicesTableMap::SHIPPING => 4, ),
        self::TYPE_RAW_COLNAME   => array('ID' => 0, 'AREA_ID' => 1, 'MAX_WEIGHT' => 2, 'MAX_PRICE' => 3, 'SHIPPING' => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'area_id' => 1, 'max_weight' => 2, 'max_price' => 3, 'shipping' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('colissimo_home_delivery_price_slices');
        $this->setPhpName('ColissimoHomeDeliveryPriceSlices');
        $this->setClassName('\\ColissimoHomeDelivery\\Model\\ColissimoHomeDeliveryPriceSlices');
        $this->setPackage('ColissimoHomeDelivery.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('AREA_ID', 'AreaId', 'INTEGER', 'area', 'ID', true, null, null);
        $this->addColumn('MAX_WEIGHT', 'MaxWeight', 'FLOAT', false, null, null);
        $this->addColumn('MAX_PRICE', 'MaxPrice', 'FLOAT', false, null, null);
        $this->addColumn('SHIPPING', 'Shipping', 'FLOAT', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Area', '\\Thelia\\Model\\Area', RelationMap::MANY_TO_ONE, array('area_id' => 'id', ), 'RESTRICT', 'RESTRICT');
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {

            return (int) $row[
                            $indexType == TableMap::TYPE_NUM
                            ? 0 + $offset
                            : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
                        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ColissimoHomeDeliveryPriceSlicesTableMap::CLASS_DEFAULT : ColissimoHomeDeliveryPriceSlicesTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     * @return array (ColissimoHomeDeliveryPriceSlices object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ColissimoHomeDeliveryPriceSlicesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ColissimoHomeDeliveryPriceSlicesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ColissimoHomeDeliveryPriceSlicesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ColissimoHomeDeliveryPriceSlicesTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ColissimoHomeDeliveryPriceSlicesTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ColissimoHomeDeliveryPriceSlicesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ColissimoHomeDeliveryPriceSlicesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ColissimoHomeDeliveryPriceSlicesTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ColissimoHomeDeliveryPriceSlicesTableMap::ID);
            $criteria->addSelectColumn(ColissimoHomeDeliveryPriceSlicesTableMap::AREA_ID);
            $criteria->addSelectColumn(ColissimoHomeDeliveryPriceSlicesTableMap::MAX_WEIGHT);
            $criteria->addSelectColumn(ColissimoHomeDeliveryPriceSlicesTableMap::MAX_PRICE);
            $criteria->addSelectColumn(ColissimoHomeDeliveryPriceSlicesTableMap::SHIPPING);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.AREA_ID');
            $criteria->addSelectColumn($alias . '.MAX_WEIGHT');
            $criteria->addSelectColumn($alias . '.MAX_PRICE');
            $criteria->addSelectColumn($alias . '.SHIPPING');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ColissimoHomeDeliveryPriceSlicesTableMap::DATABASE_NAME)->getTable(ColissimoHomeDeliveryPriceSlicesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(ColissimoHomeDeliveryPriceSlicesTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(ColissimoHomeDeliveryPriceSlicesTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new ColissimoHomeDeliveryPriceSlicesTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a ColissimoHomeDeliveryPriceSlices or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ColissimoHomeDeliveryPriceSlices object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ColissimoHomeDeliveryPriceSlicesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlices) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ColissimoHomeDeliveryPriceSlicesTableMap::DATABASE_NAME);
            $criteria->add(ColissimoHomeDeliveryPriceSlicesTableMap::ID, (array) $values, Criteria::IN);
        }

        $query = ColissimoHomeDeliveryPriceSlicesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { ColissimoHomeDeliveryPriceSlicesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { ColissimoHomeDeliveryPriceSlicesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the colissimo_home_delivery_price_slices table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ColissimoHomeDeliveryPriceSlicesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ColissimoHomeDeliveryPriceSlices or Criteria object.
     *
     * @param mixed               $criteria Criteria or ColissimoHomeDeliveryPriceSlices object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ColissimoHomeDeliveryPriceSlicesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ColissimoHomeDeliveryPriceSlices object
        }

        if ($criteria->containsKey(ColissimoHomeDeliveryPriceSlicesTableMap::ID) && $criteria->keyContainsValue(ColissimoHomeDeliveryPriceSlicesTableMap::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ColissimoHomeDeliveryPriceSlicesTableMap::ID.')');
        }


        // Set the correct dbName
        $query = ColissimoHomeDeliveryPriceSlicesQuery::create()->mergeWith($criteria);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = $query->doInsert($con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

} // ColissimoHomeDeliveryPriceSlicesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ColissimoHomeDeliveryPriceSlicesTableMap::buildTableMap();
