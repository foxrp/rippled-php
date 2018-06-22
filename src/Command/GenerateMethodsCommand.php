<?php

namespace XRPHP\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use XRPHP\Util;

class GenerateMethodsCommand extends Command
{
    /** @var array */
    private $data;

    protected function configure(): void
    {
        $this
            ->setName('methods')
            ->setDescription('Generates and updates method classes and fields.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->data = json_decode(file_get_contents(__DIR__.'/../../rippled-spec/api.json'), true);
        $this->updateMethods();
    }

    private function updateMethods(): void
    {
        $dir = __DIR__.'/../Api/Method/';
        $skel = $dir . 'Skeleton.php';
        $fs = new Filesystem();

        foreach ($this->data['methods'] as $item) {
            $item['nameCased'] = Util::CaseFromSnake($item['name']);
            $file = $dir . $item['nameCased'] .'.php';

            // Create class file if it doesn't exist.
            if (!$fs->exists($file)) {

                $content = file_get_contents($skel);

                // Replace Skeleton class strings with values from this transaction type.
                $search = ['Skeleton'];
                $replace = [$item['nameCased']];
                $newContent = str_replace($search, $replace, $content);

                // Write the file.
                file_put_contents($file, $newContent, LOCK_EX);
            }

            // Update headers.
            $this->replaceClassComment($item, $file);

            // Update fields.
            $this->generateFields($item['fields'], $file);
        }
    }

    private function replaceClassComment(array $item, string $file): void
    {
        $desc = wordwrap($item['description'], 117);
        $lines = explode("\n", $desc);
        $desc = '';
        foreach ($lines as $line) {
            $desc .= "\n * " . $line;
        }

        $content = file_get_contents($file);
        $search = "/\/\*\*.*?\s\*\//s";
        $replace = <<<EOF
/**
 * {$item['nameCased']} Method Class
 *{$desc}
 *
 * @link {$item['reference']} {$item['nameCased']} method documentation.
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

            $code .= '        $this->addField(new Field([
            \'name\' => \'' . $type . '\',
            \'required\' => ' . $req . '
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
