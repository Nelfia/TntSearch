<?php

namespace TntSearch\Service\Support;

use Propel\Runtime\Connection\PdoConnection;
use TeamTNT\TNTSearch\Indexer\TNTIndexer as BaseTNTIndexer;
use TntSearch\Connector\PropelConnector;

class TntIndexer extends BaseTNTIndexer
{
    /**
     * Override tu use propel instance instead of dsn.
     *
     * @param array $config
     * @return PropelConnector
     */
    public function createConnector(array $config): PropelConnector
    {
        return new PropelConnector();
    }

    /**
     * Allow to handle PDOConnection from propel.
     *
     * @param PdoConnection $dbh
     */
    public function setDatabasePropelConnector($dbh): void
    {
        $this->dbh = $dbh;
        if ($this->dbh->getAttribute(\PDO::ATTR_DRIVER_NAME) == 'mysql') {
            $this->dbh->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        }
    }
}