<?php declare(strict_types=1);

namespace Gundo\Imagine\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ResourceConnection;

class DataCheckUp extends Command
{
    /**
     * @var ResourceConnection
     */
    private ResourceConnection $resourceConnection;

    /**
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(ResourceConnection $resourceConnection)
    {
        $this->resourceConnection = $resourceConnection;
        parent::__construct();
    }

    /**
     * Initialization of the command.
     */
    protected function configure(): void
    {
        $this->setName('imagine:checkup');
        $this->setDescription('Check up the data.');
        parent::configure();
    }

    /**
     * CLI command description.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $connection = $this->resourceConnection->getConnection();
        $tableName = $connection->getTableName('imagine');
        $sql = "SELECT * FROM $tableName";
        $result = $connection->fetchAll($sql);
        if (empty($result)) {
            $output->writeln('No data found.');
            return 0;
        }
        $output->writeln('Data found.');
        $output->writeln('Data check up is in progress...');
        //Table data view
        foreach ($result as $row) {
            $output->writeln('ID: ' . $row['id']);
            $output->writeln('Product ID: ' . $row['product_id']);
            $output->writeln('Image URL: ' . $row['image_url']);
            $output->writeln('Created At: ' . $row['created_at']);
            $output->writeln('Updated At: ' . $row['updated_at']);
            $output->writeln('---------------------------------');
        }
        $output->writeln('Data check up has been done.');

        return 0;
    }
}
