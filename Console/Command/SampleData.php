<?php declare(strict_types=1);

namespace Gundo\Imagine\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ResourceConnection;
use Gundo\Imagine\Logger\Logger;

class SampleData extends Command
{
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * @param ResourceConnection $resourceConnection
     * @param Logger $logger
     */
    public function __construct(
        ResourceConnection $resourceConnection,
        Logger $logger
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->logger = $logger;
        parent::__construct();
    }

    /**
     * Initialization of the command.
     */
    protected function configure(): void
    {
        $this->setName('imagine:sampledata');
        $this->setDescription('Generate sample data.');
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
        $output->writeln('Generating sample data...');
        $this->logger->info('Generating sample data...');
        $connection = $this->resourceConnection->getConnection();
        $tableName = $connection->getTableName('imagine');
        $progress = new ProgressBar($output, 1000000);
        $progress->start();
        for ($i = 0; $i < 1000000; $i++) {
            $sql = "INSERT INTO $tableName (product_id, url, created_at) VALUES (:product_id, :url, NOW())";
            $binds = [
                'product_id' => $i,
                'url' => 'https://example.com/image-' . $i . '.jpg'
            ];

            $connection->query($sql, $binds);
            $this->logger->info('Sample data generated for product ID: ' . $i);
            $this->logger->info('Image URL: ' . $binds['url']);
            $this->logger->info('-----------------------------------');
            $progress->setProgress($i);
            $progress->advance();
//            usleep(100000);
        }
        $progress->finish();
        $output->writeln('Sample data has been generated.');
        return 0;
    }
}
