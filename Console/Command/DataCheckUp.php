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
    private $resourceConnection;

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
        $data = $this->fetchData();
        if (empty($data)) {
            $output->writeln('No data found.');
            return 0;
        }
        $output->writeln('Data found.');
        $output->writeln('Data check up is in progress...');
        $output->writeln('---------------------------------' . PHP_EOL);
        $this->displayData($output, $data) . PHP_EOL;
        $output->writeln('---------------------------------');
        $output->writeln('Data check up has been done.');

        return 0;
    }

    /**
     * @return array
     */
    private function fetchData(): array
    {
        $connection = $this->resourceConnection->getConnection();
        $tableName = $connection->getTableName('imagine');
        $sql = "SELECT * FROM $tableName";

        return $connection->fetchAll($sql);
    }

    /**
     * @param OutputInterface $output
     * @param array $data
     * @return void
     */
    private function displayData(OutputInterface $output, array $data): void
    {
        foreach ($data as $row) {
            $output->writeln('ID: ' . $row['imagine_id']);
            $output->writeln('Product ID: ' . $row['product_id']);
            $output->writeln('Image URL: ' . $row['url']);
            $output->writeln('Created At: ' . $row['created_at']);
            $output->writeln('---------------------------------');
        }
    }
}
