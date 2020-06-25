<?php

namespace ColissimoHomeDelivery\Model\Base;

use \Exception;
use \PDO;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlices as ChildColissimoHomeDeliveryPriceSlices;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlicesQuery as ChildColissimoHomeDeliveryPriceSlicesQuery;
use ColissimoHomeDelivery\Model\Map\ColissimoHomeDeliveryPriceSlicesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Thelia\Model\Area;

/**
 * Base class that represents a query for the 'colissimo_home_delivery_price_slices' table.
 *
 *
 *
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery orderByAreaId($order = Criteria::ASC) Order by the area_id column
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery orderByMaxWeight($order = Criteria::ASC) Order by the max_weight column
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery orderByMaxPrice($order = Criteria::ASC) Order by the max_price column
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery orderByShipping($order = Criteria::ASC) Order by the shipping column
 *
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery groupById() Group by the id column
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery groupByAreaId() Group by the area_id column
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery groupByMaxWeight() Group by the max_weight column
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery groupByMaxPrice() Group by the max_price column
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery groupByShipping() Group by the shipping column
 *
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery leftJoinArea($relationAlias = null) Adds a LEFT JOIN clause to the query using the Area relation
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery rightJoinArea($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Area relation
 * @method     ChildColissimoHomeDeliveryPriceSlicesQuery innerJoinArea($relationAlias = null) Adds a INNER JOIN clause to the query using the Area relation
 *
 * @method     ChildColissimoHomeDeliveryPriceSlices findOne(ConnectionInterface $con = null) Return the first ChildColissimoHomeDeliveryPriceSlices matching the query
 * @method     ChildColissimoHomeDeliveryPriceSlices findOneOrCreate(ConnectionInterface $con = null) Return the first ChildColissimoHomeDeliveryPriceSlices matching the query, or a new ChildColissimoHomeDeliveryPriceSlices object populated from the query conditions when no match is found
 *
 * @method     ChildColissimoHomeDeliveryPriceSlices findOneById(int $id) Return the first ChildColissimoHomeDeliveryPriceSlices filtered by the id column
 * @method     ChildColissimoHomeDeliveryPriceSlices findOneByAreaId(int $area_id) Return the first ChildColissimoHomeDeliveryPriceSlices filtered by the area_id column
 * @method     ChildColissimoHomeDeliveryPriceSlices findOneByMaxWeight(double $max_weight) Return the first ChildColissimoHomeDeliveryPriceSlices filtered by the max_weight column
 * @method     ChildColissimoHomeDeliveryPriceSlices findOneByMaxPrice(double $max_price) Return the first ChildColissimoHomeDeliveryPriceSlices filtered by the max_price column
 * @method     ChildColissimoHomeDeliveryPriceSlices findOneByShipping(double $shipping) Return the first ChildColissimoHomeDeliveryPriceSlices filtered by the shipping column
 *
 * @method     array findById(int $id) Return ChildColissimoHomeDeliveryPriceSlices objects filtered by the id column
 * @method     array findByAreaId(int $area_id) Return ChildColissimoHomeDeliveryPriceSlices objects filtered by the area_id column
 * @method     array findByMaxWeight(double $max_weight) Return ChildColissimoHomeDeliveryPriceSlices objects filtered by the max_weight column
 * @method     array findByMaxPrice(double $max_price) Return ChildColissimoHomeDeliveryPriceSlices objects filtered by the max_price column
 * @method     array findByShipping(double $shipping) Return ChildColissimoHomeDeliveryPriceSlices objects filtered by the shipping column
 *
 */
abstract class ColissimoHomeDeliveryPriceSlicesQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \ColissimoHomeDelivery\Model\Base\ColissimoHomeDeliveryPriceSlicesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\ColissimoHomeDelivery\\Model\\ColissimoHomeDeliveryPriceSlices', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildColissimoHomeDeliveryPriceSlicesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlicesQuery) {
            return $criteria;
        }
        $query = new \ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlicesQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildColissimoHomeDeliveryPriceSlices|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ColissimoHomeDeliveryPriceSlicesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ColissimoHomeDeliveryPriceSlicesTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildColissimoHomeDeliveryPriceSlices A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, AREA_ID, MAX_WEIGHT, MAX_PRICE, SHIPPING FROM colissimo_home_delivery_price_slices WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildColissimoHomeDeliveryPriceSlices();
            $obj->hydrate($row);
            ColissimoHomeDeliveryPriceSlicesTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildColissimoHomeDeliveryPriceSlices|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the area_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAreaId(1234); // WHERE area_id = 1234
     * $query->filterByAreaId(array(12, 34)); // WHERE area_id IN (12, 34)
     * $query->filterByAreaId(array('min' => 12)); // WHERE area_id > 12
     * </code>
     *
     * @see       filterByArea()
     *
     * @param     mixed $areaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery The current query, for fluid interface
     */
    public function filterByAreaId($areaId = null, $comparison = null)
    {
        if (is_array($areaId)) {
            $useMinMax = false;
            if (isset($areaId['min'])) {
                $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::AREA_ID, $areaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($areaId['max'])) {
                $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::AREA_ID, $areaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::AREA_ID, $areaId, $comparison);
    }

    /**
     * Filter the query on the max_weight column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxWeight(1234); // WHERE max_weight = 1234
     * $query->filterByMaxWeight(array(12, 34)); // WHERE max_weight IN (12, 34)
     * $query->filterByMaxWeight(array('min' => 12)); // WHERE max_weight > 12
     * </code>
     *
     * @param     mixed $maxWeight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery The current query, for fluid interface
     */
    public function filterByMaxWeight($maxWeight = null, $comparison = null)
    {
        if (is_array($maxWeight)) {
            $useMinMax = false;
            if (isset($maxWeight['min'])) {
                $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::MAX_WEIGHT, $maxWeight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxWeight['max'])) {
                $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::MAX_WEIGHT, $maxWeight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::MAX_WEIGHT, $maxWeight, $comparison);
    }

    /**
     * Filter the query on the max_price column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxPrice(1234); // WHERE max_price = 1234
     * $query->filterByMaxPrice(array(12, 34)); // WHERE max_price IN (12, 34)
     * $query->filterByMaxPrice(array('min' => 12)); // WHERE max_price > 12
     * </code>
     *
     * @param     mixed $maxPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery The current query, for fluid interface
     */
    public function filterByMaxPrice($maxPrice = null, $comparison = null)
    {
        if (is_array($maxPrice)) {
            $useMinMax = false;
            if (isset($maxPrice['min'])) {
                $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::MAX_PRICE, $maxPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxPrice['max'])) {
                $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::MAX_PRICE, $maxPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::MAX_PRICE, $maxPrice, $comparison);
    }

    /**
     * Filter the query on the shipping column
     *
     * Example usage:
     * <code>
     * $query->filterByShipping(1234); // WHERE shipping = 1234
     * $query->filterByShipping(array(12, 34)); // WHERE shipping IN (12, 34)
     * $query->filterByShipping(array('min' => 12)); // WHERE shipping > 12
     * </code>
     *
     * @param     mixed $shipping The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery The current query, for fluid interface
     */
    public function filterByShipping($shipping = null, $comparison = null)
    {
        if (is_array($shipping)) {
            $useMinMax = false;
            if (isset($shipping['min'])) {
                $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::SHIPPING, $shipping['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shipping['max'])) {
                $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::SHIPPING, $shipping['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::SHIPPING, $shipping, $comparison);
    }

    /**
     * Filter the query by a related \Thelia\Model\Area object
     *
     * @param \Thelia\Model\Area|ObjectCollection $area The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery The current query, for fluid interface
     */
    public function filterByArea($area, $comparison = null)
    {
        if ($area instanceof \Thelia\Model\Area) {
            return $this
                ->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::AREA_ID, $area->getId(), $comparison);
        } elseif ($area instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::AREA_ID, $area->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByArea() only accepts arguments of type \Thelia\Model\Area or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Area relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery The current query, for fluid interface
     */
    public function joinArea($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Area');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Area');
        }

        return $this;
    }

    /**
     * Use the Area relation Area object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\AreaQuery A secondary query class using the current class as primary query
     */
    public function useAreaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinArea($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Area', '\Thelia\Model\AreaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildColissimoHomeDeliveryPriceSlices $colissimoHomeDeliveryPriceSlices Object to remove from the list of results
     *
     * @return ChildColissimoHomeDeliveryPriceSlicesQuery The current query, for fluid interface
     */
    public function prune($colissimoHomeDeliveryPriceSlices = null)
    {
        if ($colissimoHomeDeliveryPriceSlices) {
            $this->addUsingAlias(ColissimoHomeDeliveryPriceSlicesTableMap::ID, $colissimoHomeDeliveryPriceSlices->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the colissimo_home_delivery_price_slices table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ColissimoHomeDeliveryPriceSlicesTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ColissimoHomeDeliveryPriceSlicesTableMap::clearInstancePool();
            ColissimoHomeDeliveryPriceSlicesTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildColissimoHomeDeliveryPriceSlices or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildColissimoHomeDeliveryPriceSlices object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ColissimoHomeDeliveryPriceSlicesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ColissimoHomeDeliveryPriceSlicesTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        ColissimoHomeDeliveryPriceSlicesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ColissimoHomeDeliveryPriceSlicesTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // ColissimoHomeDeliveryPriceSlicesQuery
