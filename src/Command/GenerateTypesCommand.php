<?php declare(strict_types=1);

namespace XRPHP\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class GenerateTypesCommand extends Command
{
    /** @var array */
    private $data;

    protected function configure(): void
    {
        $this
            ->setName('types')
            ->setDescription('Creates transaction types and common fields.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->data = json_decode(file_get_contents(__DIR__.'/../../rippled-spec/transactions.json'), true);
        $this->updateAbstract();
        $this->updateTypes();
    }

    private function updateTypes(): void
    {
        $dir = __DIR__.'/../Api/TransactionType/';
        $skel = $dir . 'Skeleton.php';
        $fs = new Filesystem();

        foreach ($this->data['types'] as $type) {
            $file = $dir . $type['name'] .'.php';

            // Create class file if it doesn't exist.
            if (!$fs->exists($file)) {
                $content = file_get_contents($skel);

                // Replace Skeleton class strings with values from this transaction type.
                $search = ['Skeleton'];
                $replace = [$type['name']];
                $newContent = str_replace($search, $replace, $content);

                // Write the file.
                file_put_contents($file, $newContent, LOCK_EX);
            }

            // Update headers.
            $this->replaceClassComment($type, $file);

            // Update fields.
            $this->generateFields($type['fields'], $file);
        }
    }

    private function updateAbstract(): void
    {
        $this->generateFields($this->data['common_fields']['fields'], __DIR__.'/../Api/TransactionType/AbstractTransactionType.php');
    }

    private function replaceClassComment(array $type, string $file): void
    {
        $desc = wordwrap($type['description'], 117);
        $lines = explode("\n", $desc);
        $desc = '';
        foreach ($lines as $line) {
            $desc .= "\n * " . $line;
        }

        $content = file_get_contents($file);
        $search = "/\/\*\*.*?\s\*\//s";
        $replace = <<<EOF
/**
 * {$type['name']} Transaction Type Class
 *{$desc}
 *
 * @link {$type['reference']} {$type['name']} transaction type documentation.
 */
EOF;

        $newContent = preg_replace($search, $replace, $content, 1);
        file_put_contents($file, $newContent);
    }

    private function generateFields(array $fields, string $file)
    {
        $code = '';
        foreach ($fields as $field) {
            $type = $field['name'];
            $req = isset($field['required']) && $field['required'] === true ? 'true' : 'false';
            $af = isset($field['auto_fillable']) && $field['auto_fillable'] === true ? 'true' : 'false';

            $code .= '        $this->addField(new Field([
            \'name\' => \'' . $type . '\',
            \'required\' => ' . $req . ',
            \'autoFillable\' => ' . $af . '
        ]));

';
        }
        $this->replaceCode($code, $file);
    }

    private function replaceCode($code, $file): void
    {
        $content = file_get_contents($file);
        $search = "/\/\/\sBEGIN\sGENERATED(.*)END\sGENERATED/s";
        $replace = "// BEGIN GENERATED\n{$code}        // END GENERATED";

        $newContent = preg_replace($search, $replace, $content);
        file_put_contents($file, $newContent);
    }
}
